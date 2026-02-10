<?php

use Illuminate\Support\Facades\Route;
use App\Models\Horoscope;

//RUN npm run dev ON START!!

Route::get('/', function () {
    return view('home');
});

Route::get('/horoscopes', function () {
    $horoscopes = \App\Models\Horoscope::paginate(12);

    return view('horoscopes', [
        'horoscopes' => $horoscopes
    ]);
});

Route::get('/horoscopes/{id}', function ($id) {
    $horoscope = Horoscope::findOrFail($id);

    return view('horoscope', [
        'horoscope' => $horoscope
    ]);
});

Route::get('/contact', function () {
    return view('contact');
});
