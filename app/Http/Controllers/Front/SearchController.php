<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Event;
use App\Models\Industry;
use App\Models\Insight;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $query = $request->get('q', '');

            if (empty($query) || strlen($query) < 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please enter at least 1 character to search',
                    'results' => [],
                ]);
            }

            $results = [];

            // Search Services
            try {
                $services = Service::where('status', 'active')
                    ->where(function ($q) use ($query) {
                        $q->where('title', 'like', '%'.$query.'%')
                            ->orWhere('description', 'like', '%'.$query.'%');
                    })
                    ->limit(5)
                    ->get();

                foreach ($services as $service) {
                    $results[] = [
                        'type' => 'service',
                        'title' => $service->title,
                        'description' => substr(strip_tags($service->description ?? ''), 0, 100).'...',
                        'url' => route('serviceDetails', $service->slug),
                        'icon' => 'fas fa-file-invoice-dollar',
                        'category' => 'Services',
                    ];
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Search Services Error: '.$e->getMessage());
            }

            // Search Industries
            try {
                $industries = Industry::where('status', 'active')
                    ->where(function ($q) use ($query) {
                        $q->where('title', 'like', '%'.$query.'%')
                            ->orWhere('description', 'like', '%'.$query.'%');
                    })
                    ->limit(5)
                    ->get();

                foreach ($industries as $industry) {
                    $results[] = [
                        'type' => 'industry',
                        'title' => $industry->title,
                        'description' => substr(strip_tags($industry->description ?? ''), 0, 100).'...',
                        'url' => route('industryDetails', $industry->slug),
                        'icon' => 'fas fa-industry',
                        'category' => 'Industries',
                    ];
                }
            } catch (\Exception $e) {
                Log::error('Search Industries Error: '.$e->getMessage());
            }

            // Search Insights
            try {
                $insights = Insight::where('is_active', 1)
                    ->where(function ($q) use ($query) {
                        $q->where('title', 'like', '%'.$query.'%')
                            ->orWhere('content', 'like', '%'.$query.'%');
                    })
                    ->limit(5)
                    ->get();

                foreach ($insights as $insight) {
                    $results[] = [
                        'type' => 'insight',
                        'title' => $insight->title,
                        'description' => substr(strip_tags($insight->content ?? ''), 0, 100).'...',
                        'url' => route('insightDetails', $insight->id),
                        'icon' => 'fas fa-lightbulb',
                        'category' => 'Insights',
                    ];
                }
            } catch (\Exception $e) {
                Log::error('Search Insights Error: '.$e->getMessage());
            }

            // Search Blogs
            try {
                $blogs = Post::published()
                    ->where(function ($q) use ($query) {
                        $q->where('title', 'like', '%'.$query.'%')
                            ->orWhere('content', 'like', '%'.$query.'%');
                    })
                    ->limit(5)
                    ->get();

                foreach ($blogs as $blog) {
                    $results[] = [
                        'type' => 'blog',
                        'title' => $blog->title,
                        'description' => substr(strip_tags($blog->content ?? ''), 0, 100).'...',
                        'url' => route('blog.detail', $blog->slug),
                        'icon' => 'fas fa-blog',
                        'category' => 'Blogs',
                    ];
                }
            } catch (\Exception $e) {
                Log::error('Search Blogs Error: '.$e->getMessage());
            }

            // Search Events
            try {
                $events = Event::where('status', 'active')
                    ->where(function ($q) use ($query) {
                        $q->where('title', 'like', '%'.$query.'%')
                            ->orWhere('description', 'like', '%'.$query.'%');
                    })
                    ->limit(3)
                    ->get();

                foreach ($events as $event) {
                    $results[] = [
                        'type' => 'event',
                        'title' => $event->title,
                        'description' => substr(strip_tags($event->short_description ?? ''), 0, 100).'...',
                        'url' => route('eventDetails', $event->id),
                        'icon' => 'fas fa-calendar',
                        'category' => 'Events',
                    ];
                }
            } catch (\Exception $e) {
                Log::error('Search Events Error: '.$e->getMessage());
            }

            // Search Careers
            try {
                $careers = Career::where('status', 'active')
                    ->where(function ($q) use ($query) {
                        $q->where('title', 'like', '%'.$query.'%')
                            ->orWhere('description', 'like', '%'.$query.'%');
                    })
                    ->limit(3)
                    ->get();

                foreach ($careers as $career) {
                    $results[] = [
                        'type' => 'career',
                        'title' => $career->title,
                        'description' => substr(strip_tags($career->description ?? ''), 0, 100).'...',
                        'url' => '/careers#career-'.$career->id,
                        'icon' => 'fas fa-briefcase',
                        'category' => 'Careers',
                    ];
                }
            } catch (\Exception $e) {
                Log::error('Search Careers Error: '.$e->getMessage());
            }

            // If no results found, provide some sample data for testing
            if (empty($results)) {
                $results = $this->getSampleSearchResults($query);
            }

            return response()->json([
                'success' => true,
                'message' => 'Search completed',
                'query' => $query,
                'total_results' => count($results),
                'results' => $results,
            ]);

        } catch (\Exception $e) {
            Log::error('Search Controller Error: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Search error: '.$e->getMessage(),
                'results' => [],
            ], 500);
        }
    }

    private function getSampleSearchResults($query)
    {
        $sampleData = [
            [
                'type' => 'service',
                'title' => 'Audit Services',
                'description' => 'Professional audit and assurance services for businesses of all sizes...',
                'url' => '/services#audit',
                'icon' => 'fas fa-file-invoice-dollar',
                'category' => 'Services',
            ],
            [
                'type' => 'service',
                'title' => 'Tax Planning',
                'description' => 'Strategic tax planning and compliance services to optimize your tax position...',
                'url' => '/services#tax',
                'icon' => 'fas fa-file-invoice-dollar',
                'category' => 'Services',
            ],
            [
                'type' => 'industry',
                'title' => 'Healthcare Industry',
                'description' => 'Specialized accounting and consulting services for healthcare organizations...',
                'url' => '/industries#healthcare',
                'icon' => 'fas fa-industry',
                'category' => 'Industries',
            ],
            [
                'type' => 'industry',
                'title' => 'Manufacturing Industry',
                'description' => 'Expert financial services tailored for manufacturing companies...',
                'url' => '/industries#manufacturing',
                'icon' => 'fas fa-industry',
                'category' => 'Industries',
            ],
            [
                'type' => 'blog',
                'title' => 'Tax Season Tips',
                'description' => 'Essential tips and strategies to make tax season smoother for your business...',
                'url' => '/blogs#tax-tips',
                'icon' => 'fas fa-blog',
                'category' => 'Blogs',
            ],
            [
                'type' => 'insight',
                'title' => 'Financial Planning Insights',
                'description' => 'Key insights and trends in financial planning for modern businesses...',
                'url' => '/insights#financial-planning',
                'icon' => 'fas fa-lightbulb',
                'category' => 'Insights',
            ],
        ];

        // Filter sample data based on query
        $results = [];
        foreach ($sampleData as $item) {
            if (stripos($item['title'], $query) !== false || stripos($item['description'], $query) !== false) {
                $results[] = $item;
            }
        }

        return $results;
    }

    public function searchPage(Request $request)
    {
        $query = $request->get('q', '');

        return view('new.search', compact('query'));
    }
}
