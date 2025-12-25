<?php

namespace App\Http\Controllers\Apprenticeship;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApprenticeshipController extends Controller
{
    public function index()
    {
        return view('pages.apprenticeship.apprenticeship-index');
    }

    public function create()
    {
        return view('pages.apprenticeship.apprenticeship-create');
    }

    public function update()
    {
        return view('pages.apprenticeship.apprenticeship-update');
    }
}
