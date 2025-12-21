<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Course;

class LandingController extends Controller
{
    public function index()
    {

        return view('front.landing');
    }
}
