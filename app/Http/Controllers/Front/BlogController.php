<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 'published')->orderBy('published_at', 'desc')->get();
        $jumbotrons = DB::table('jumbotrons')->where('page_slug', 'blogs')->where('is_active', 1)->orderBy('sort_order', 'asc')->get();

        return view('new.blogs', compact('blogs', 'jumbotrons'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Get related blogs (same author or recent)
        $relatedBlogs = Blog::where('status', 'published')
            ->where('id', '!=', $blog->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('new.blog-detail', compact('blog', 'relatedBlogs'));
    }
}
