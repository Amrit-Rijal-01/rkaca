<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Post::with(['author', 'category'])->published()->orderBy('published_at', 'desc')->get();
        $jumbotrons = DB::table('jumbotrons')->where('page_slug', 'blogs')->where('is_active', 1)->orderBy('sort_order', 'asc')->get();

        return view('new.blogs', compact('blogs', 'jumbotrons'));
    }

    public function show($slug)
    {
        $blog = Post::with(['author', 'category', 'tags'])
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Get related posts (same category or recent)
        $relatedBlogs = Post::with(['author', 'category'])
            ->published()
            ->where('category_id', $blog->category_id)
            ->where('id', '!=', $blog->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('new.blog-detail', compact('blog', 'relatedBlogs'));
    }
}
