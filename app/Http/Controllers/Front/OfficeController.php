<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OfficeController extends Controller
{
    public function index()
    {
        $services = DB::table('services')->where('status', 'active')->orderBy('sort_order', 'asc')->paginate(6);
        $offices = DB::table('offices')->where('status', 'active')->get();
        $jumbotrons = DB::table('jumbotrons')->where('page_slug', 'offices')->where('is_active', 1)->orderBy('sort_order', 'asc')->get();

        return view('new.offices', compact('offices', 'services', 'jumbotrons'));

    }
}
