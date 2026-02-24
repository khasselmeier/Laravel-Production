<?php

use Illuminate\Support\Facades\Route;
use App\Models\Animal;

// RUN npm run dev ON START!!

Route::get('/', function () {
    return view('home');
});

Route::get('/adoption', function () {
    $animals = Animal::latest()->get();

    return view('adoption', [
        'animals' => $animals
    ]);
});

Route::get('/adoption/{animal}', function (Animal $animal) {
    return view('animal', ['animal' => $animal]);
});


Route::get('/pet-sitting', function () {
    return view('pet-sitting');
});

Route::get('/match', function () {
    $matchSigns = [
        ['id' => 1, 'sign_name' => 'Calm'],
        ['id' => 2, 'sign_name' => 'Chaotic'],
        ['id' => 3, 'sign_name' => 'Energetic'],
        ['id' => 4, 'sign_name' => 'Playful'],
        ['id' => 5, 'sign_name' => 'Lazy'],
        ['id' => 6, 'sign_name' => 'Gentle'],
        ['id' => 7, 'sign_name' => 'Loyal'],
        ['id' => 8, 'sign_name' => 'Curious'],
        ['id' => 9, 'sign_name' => 'Shy'],
        ['id' => 10, 'sign_name' => 'Brave'],
        ['id' => 11, 'sign_name' => 'Affectionate'],
        ['id' => 12, 'sign_name' => 'Independent'],
    ];

    return view('match', ['matchSigns' => $matchSigns]);
})->name('match.wheel');

Route::get('/match/{id}', function ($id) {
    $energyLevels = [
        1=>'Calm',2=>'Chaotic',3=>'Energetic',4=>'Playful',5=>'Lazy',6=>'Gentle',
        7=>'Loyal',8=>'Curious',9=>'Shy',10=>'Brave',11=>'Affectionate',12=>'Independent'
    ];

    $id = (int) $id;
    if (!isset($energyLevels[$id])) abort(404);

    $selectedVibe = $energyLevels[$id];

    $animals = \App\Models\Animal::where('energy_level', $selectedVibe)
        ->inRandomOrder()
        ->take(9)
        ->get();

    return view('match-animals', [
        'selectedVibe' => $selectedVibe,
        'vibeId' => $id,
        'animals' => $animals,
    ]);
})->name('match.animals');

Route::get('/match/{id}/animal/{animal}', function ($id, \App\Models\Animal $animal) {
    $energyLevels = [
        1=>'Calm',2=>'Chaotic',3=>'Energetic',4=>'Playful',5=>'Lazy',6=>'Gentle',
        7=>'Loyal',8=>'Curious',9=>'Shy',10=>'Brave',11=>'Affectionate',12=>'Independent'
    ];

    $id = (int) $id;
    if (!isset($energyLevels[$id])) abort(404);

    return view('match-result', [
        'selectedVibe' => $energyLevels[$id],
        'animal' => $animal,
    ]);
})->name('match.result');

Route::get('/contact', function () {
    return view('contact');
});
