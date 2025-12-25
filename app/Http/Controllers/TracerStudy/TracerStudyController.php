<?php

namespace App\Http\Controllers\TracerStudy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TracerStudyController extends Controller
{
    public function index()
    {
        return view('pages.tracer-study.tracer-study-index');
    }

    public function update()
    {
        return view('pages.tracer-study.tracer-study-update');
    }
}
