<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        return view('blogs');
    }

    public function show($slug)
    {
        $post = Post::with(['author', 'category', 'tags'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Get related posts
        $relatedPosts = Post::with(['author', 'category'])
            ->published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->limit(3)
            ->get();

        return view('blog-detail', compact('post', 'relatedPosts'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = Post::with(['author', 'category', 'tags'])
            ->published()
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->paginate(9);

        return view('blogs', compact('posts', 'category'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $posts = Post::with(['author', 'category', 'tags'])
            ->published()
            ->whereHas('tags', function ($query) use ($tag) {
                $query->where('tags.id', $tag->id);
            })
            ->latest('published_at')
            ->paginate(9);

        return view('blogs', compact('posts', 'tag'));
    }

    public function loadMore(Request $request)
    {
        $page = $request->get('page', 2);
        $query = Post::with(['author', 'category', 'tags'])->published();

        // Apply filters if provided
        if ($request->has('category')) {
            $query->byCategory($request->category);
        }

        if ($request->has('tag')) {
            $query->byTag($request->tag);
        }

        $posts = $query->latest('published_at')->paginate(9, ['*'], 'page', $page);

        if ($posts->isEmpty()) {
            return response()->json(['html' => '', 'hasMore' => false]);
        }

        $html = view('partials.blog-cards', compact('posts'))->render();

        return response()->json([
            'html' => $html,
            'hasMore' => $posts->hasMorePages(),
        ]);
    }
}
