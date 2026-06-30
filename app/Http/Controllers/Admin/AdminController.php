<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Industry;
use App\Models\Insight;
use App\Models\Office;
use App\Models\Page;
use App\Models\Post;
use App\Models\Service;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'pages' => Page::count(),
            'blogs' => Post::count(),
            'events' => Event::count(),
            'careers' => Career::count(),
            'contacts' => Contact::count(),
            'services' => Service::count(),
            'industries' => Industry::count(),
            'offices' => Office::count(),
            'insights' => Insight::count(),
        ];

        $recentContacts = Contact::latest()->take(5)->get();
        $recentBlogs = Post::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentContacts', 'recentBlogs'));
    }
}
