<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.profile-index');
    }

    public function update()
    {
        return view('pages.profile.profile-update');
    }
}
