<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Package;

class LandingController extends Controller
{
    public function index()
    {

        return view('public.landing');
    }
}
