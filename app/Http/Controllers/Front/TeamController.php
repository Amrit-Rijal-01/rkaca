<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    /**
     * Display the team page
     */
    public function index()
    {
        $teams = DB::table('about_team_members')->where('is_active', '1')->orderBy('sort_order', 'asc')->get();

        return view('new.ourteam', compact('teams'));
    }
}
