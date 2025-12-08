<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Package;

class LandingController extends Controller
{
    public function index()
    {

        return view('front.landing');
    }
}
