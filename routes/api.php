<?php

use Illuminate\Support\Facades\Route;

// AJAX Kabupaten/Kota untuk Register dan Edit Profile
Route::get('/regencies/{province_id}', function ($province_id) {
    return \App\Models\Regency::where('province_id', $province_id)
        ->orderBy('name')
        ->get(['id', 'name']);
})->name('api.regencies');
