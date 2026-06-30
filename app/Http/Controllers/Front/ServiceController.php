<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 'active')->orderBy('sort_order', 'asc')->get();
        $industries = DB::table('industries')->select('name', 'svg_icon')->where('status', 'active')->orderBy('sort_order', 'asc')->paginate(6);
        $jumbotrons = DB::table('jumbotrons')->where('page_slug', 'services')->where('is_active', 1)->orderBy('sort_order', 'asc')->get();

        return view('new.services', compact('services', 'industries', 'jumbotrons'));
    }

    public function getAll(Request $request)
    {
        if ($request->ajax()) {
            // Get all services
            $services = Service::where('status', 'active')->orderBy('sort_order', 'asc')->get();

            // Generate services grid HTML
            $servicesHtml = '';
            foreach ($services as $index => $service) {
                $delay = $index * 0.2;
                $servicesHtml .= "
            
                <div class='col-md-6 col-lg-4 gsap-animate' data-delay='{$delay}'>
                    <div class='service-card'>
                        <h3>{$service->title}</h3>
                        <p>{$service->description}</p>
                        <a href='#service-{$service->id}' class='learn-more'>Learn More <i class='fas fa-arrow-right'></i></a>
                    </div>
                </div>";
            }

            // Generate service details HTML
            $detailsHtml = '';
            foreach ($services as $index => $service) {
                $delay = $index * 0.1;
                $detailsHtml .= "
                <div class='col-12 gsap-animate' id='service-{$service->id}' data-delay='{$delay}'>
                    <div class='detail-card'>
                        <div class='row align-items-center'>
                            <div class='col-lg-6 detail-content'>
                                <h3>{$service->title}</h3>
                                <p>{$service->content}</p>";

                // Handle sub-services if they exist
                if (is_array($service->sub_services)) {
                    foreach ($service->sub_services as $sub => $items) {
                        $detailsHtml .= "<h4>{$sub}</h4><ul>";
                        foreach ($items as $item) {
                            $detailsHtml .= "<li>{$item}</li>";
                        }
                        $detailsHtml .= '</ul>';
                    }
                }

                $detailsHtml .= "
                            </div>
                            <div class='col-lg-6'>
                                <img src='".Storage::url($service->featured_image)."' alt='{$service->title}'>
                            </div>
                        </div>
                    </div>
                </div>";
            }

            return response()->json([
                'success' => true,
                'services_html' => $servicesHtml,
                'details_html' => $detailsHtml,
                'total_count' => $services->count(),
            ]);
        }

        return response()->json(['success' => false], 400);
    }

    // temp route for service details page
    public function show($id)
    {
        $service = Service::findOrFail($id);

        // dd($service);
        return view('new.serviceDetails', compact('service'));
    }
}
