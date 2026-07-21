<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\Insight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = DB::table('industries')->where('status', 'active')->orderBy('sort_order', 'asc')->get();
        $industryExperties = DB::table('industry_expertises')->where('status', 'active')->orderBy('sort_order', 'asc')->paginate(4);
        $jumbotrons = DB::table('jumbotrons')->where('page_slug', 'industries')->where('is_active', 1)->orderBy('sort_order', 'asc')->get();
        $insights = Insight::where('status', 'published')->orderBy('published_at', 'desc')->where('is_active', true)->limit(3)->get();

        return view('new.industries', compact('industries', 'industryExperties', 'jumbotrons', 'insights'));
    }

    public function getAll(Request $request)
    {
        if ($request->ajax()) {
            $industries = DB::table('industries')->where('status', 'active')->orderBy('sort_order', 'asc')->get();
            $industriesHtml = '';
            foreach ($industries as $index => $industry) {
                $delay = $index * 0.1;
                $imageUrl = $industry->featured_image ? asset('storage/'.$industry->featured_image) : '';
                $bgStyle = $imageUrl ? ' style="background-image: url(\''.htmlspecialchars($imageUrl).'\'); background-size: cover; background-position: center;"' : '';

                $industriesHtml .= '<div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="'.$delay.'">';
                $industriesHtml .= '<a href="'.route('industryDetails', $industry->slug).'" class="industry-card-link" style="text-decoration: none; color: inherit; display: block;">';
                $industriesHtml .= '<div class="industry-card"'.$bgStyle.'>';

                if ($imageUrl) {
                    $industriesHtml .= '<div class="card-img-overlay"></div>';
                }

                $industriesHtml .= '<span class="category-badge-normal">'.htmlspecialchars($industry->category).'</span>';

                $industriesHtml .= '<div class="default-title">';
                $industriesHtml .= '<h3>'.htmlspecialchars($industry->title ?: $industry->name).'</h3>';
                $industriesHtml .= '</div>';

                $industriesHtml .= '<div class="content-overlay">';
                $industriesHtml .= '<div class="content-details">';
                $industriesHtml .= '<h3>'.htmlspecialchars($industry->title ?: $industry->name).'</h3>';
                $industriesHtml .= '<p>'.htmlspecialchars($industry->description).'</p>';
                $industriesHtml .= '</div>';
                $industriesHtml .= '</div>';

                $industriesHtml .= '</div>';
                $industriesHtml .= '</a>';
                $industriesHtml .= '</div>';
            }

            return response()->json([
                'success' => true,
                'industries_html' => $industriesHtml]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid request']);
    }

    public function show($slug)
    {
        $industry = Industry::where('slug', $slug)->firstOrFail();
        $nextindustry = Industry::where('id', '>', $industry->id)->orderBy('id', 'asc')->take(3)->get();

        return view('new.industryDetails', compact('industry', 'nextindustry'));
    }
}
