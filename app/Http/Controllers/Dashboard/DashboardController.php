<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.dashboard-index');
    }

    public function careerInfo()
    {
        return view('pages.dashboard.dashboard-career-info');
    }
}
