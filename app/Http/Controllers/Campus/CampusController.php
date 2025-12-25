<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    public function index()
    {
        return view('pages.campus.campus-index');
    }
}
