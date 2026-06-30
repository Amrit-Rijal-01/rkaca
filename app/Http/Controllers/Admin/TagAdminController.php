<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Tag::withCount('posts');

        // Search
        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $tags = $query->orderBy('name')->paginate(20);

        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags',
            'slug' => 'nullable|string|max:255|unique:tags',
            'description' => 'nullable|string|max:500',
        ]);

        $data = $request->all();

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        Tag::create($data);
        $this->render();

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag created successfully!');
    }

    public function show(Tag $tag)
    {
        $tag->load(['posts.author', 'posts.category']);
        $tag->loadCount('posts');

        return view('admin.tags.show', compact('tag'));
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,'.$tag->id,
            'slug' => 'nullable|string|max:255|unique:tags,slug,'.$tag->id,
            'description' => 'nullable|string|max:500',
        ]);

        $data = $request->all();

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        $tag->update($data);
        $this->render();

        return redirect()->route('admin.tags.show', $tag)
            ->with('success', 'Tag updated successfully!');
    }

    public function destroy(Tag $tag)
    {
        // Check if tag has posts
        if ($tag->posts()->count() > 0) {
            return redirect()->route('admin.tags.index')
                ->with('error', 'Cannot delete tag that is used in posts. Please remove it from posts first.');
        }

        $tag->delete();
        $this->render();

        return redirect()->route('admin.tags.index')
            ->with('success', 'Tag deleted successfully!');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'tags' => 'required|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $deletedCount = 0;
        $skippedCount = 0;

        foreach ($request->tags as $tagId) {
            $tag = Tag::find($tagId);
            if ($tag && $tag->posts()->count() == 0) {
                $tag->delete();
                $deletedCount++;
            } else {
                $skippedCount++;
            }
        }

        $message = "Deleted {$deletedCount} tag(s)";
        if ($skippedCount > 0) {
            $message .= " and skipped {$skippedCount} tag(s) that have posts";
        }
        $message .= '.';
        $this->render();

        return redirect()->route('admin.tags.index')->with('success', $message);
    }

    public function render()
    {
        $popularTags = Tag::withCount('publishedPosts')
            ->whereHas('publishedPosts')
            ->orderBy('published_posts_count', 'desc')
            ->limit(10)
            ->get();
        Helper::putCache('blog.tags', view('admin.template.blog.tags', compact('popularTags')));
    }
}
