<?php

namespace App\Http\Controllers\Admin;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['author', 'category', 'tags']);

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->has('category_id') && $request->category_id !== '') {
            $query->where('category_id', $request->category_id);
        }

        // Search
        if ($request->has('search') && $request->search !== '') {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('content', 'like', '%'.$request->search.'%');
            });
        }

        $posts = $query->latest()->paginate(15);
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $authors = User::orderBy('name')->get();

        return view('admin.posts.create', compact('categories', 'tags', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
            'author_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle boolean values
        $data['is_featured'] = $request->has('is_featured');

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        // Create post
        $post = Post::create($data);

        // Attach tags if provided
        if ($request->has('tags')) {
            $post->tags()->attach($request->tags);
        }
        $this->render();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        $post->load(['author', 'category', 'tags']);

        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $authors = User::orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'authors'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:posts,slug,'.$post->id,
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
            'author_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Handle boolean values
        $data['is_featured'] = $request->has('is_featured');

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('posts', 'public');
        }

        // Update post
        $post->update($data);

        // Sync tags
        $post->tags()->sync($request->tags ?? []);
        $this->render();

        return redirect()->route('admin.posts.show', $post)
            ->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        // Delete thumbnail if exists
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        // Detach tags
        $post->tags()->detach();

        // Delete post
        $post->delete();
        $this->render();

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully!');
    }

    public function render()
    {
        $query = Post::with(['author', 'category', 'tags'])->published();
        $posts = $query->latest('published_at')->paginate(9);
        $featuredPost = Post::with(['author', 'category', 'tags'])
            ->published()
            ->featured()
            ->latest('published_at')
            ->first();
        $recentPosts = Post::with(['author', 'category'])
            ->published()
            ->latest('published_at')
            ->limit(5)
            ->get();
        Helper::putCache('blog.featured', view('admin.template.blog.featured', compact('featuredPost')));
        Helper::putCache('blog.recent', view('admin.template.blog.recent', compact('recentPosts', 'posts')));
    }
}
