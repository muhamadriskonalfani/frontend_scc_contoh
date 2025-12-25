<?php

namespace App\Http\Controllers\JobVacancy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JobVacancyController extends Controller
{
    public function index()
    {
        return view('pages.job-vacancy.job-vacancy-index');
    }

    public function create()
    {
        return view('pages.job-vacancy.job-vacancy-create');
    }

    public function update()
    {
        return view('pages.job-vacancy.job-vacancy-update');
    }
}
