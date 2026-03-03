<?php

use Illuminate\Support\Facades\Route;
use App\Models\Animal;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitterProfileController;
use App\Http\Controllers\PetSittingRequestController;
use App\Http\Controllers\AccountController;

//RUN npm run dev ON START!
//TO GET QUEUE TO WORK RUN php artisan queue:work


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/adoption', function () {
    $animals = Animal::latest()->get();

    return view('adoption', [
        'animals' => $animals
    ]);
})->name('adoption');

Route::get('/adoption/{animal}', function (Animal $animal) {
    return view('animal', ['animal' => $animal]);
})->name('animal.show');

Route::get('/pet-sitting', function () {
    return view('pet-sitting.index');
})->name('pet-sitting.index');

Route::get('/match', function () {

    // ORIGINAL match signs — unchanged
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
})->name('match');

Route::get('/match/{id}', function ($id) {

    $energyLevels = [
        1=>'Calm',
        2=>'Chaotic',
        3=>'Energetic',
        4=>'Playful',
        5=>'Lazy',
        6=>'Gentle',
        7=>'Loyal',
        8=>'Curious',
        9=>'Shy',
        10=>'Brave',
        11=>'Affectionate',
        12=>'Independent'
    ];

    $id = (int) $id;
    if (!isset($energyLevels[$id])) abort(404);

    $selectedVibe = $energyLevels[$id];

    $animals = Animal::where('energy_level', $selectedVibe)
        ->inRandomOrder()
        ->take(9)
        ->get();

    return view('match-animals', [
        'selectedVibe' => $selectedVibe,
        'vibeId' => $id,
        'animals' => $animals,
    ]);
})->name('match.animals');


Route::get('/match/{id}/animal/{animal}', function ($id, Animal $animal) {

    $energyLevels = [
        1=>'Calm',
        2=>'Chaotic',
        3=>'Energetic',
        4=>'Playful',
        5=>'Lazy',
        6=>'Gentle',
        7=>'Loyal',
        8=>'Curious',
        9=>'Shy',
        10=>'Brave',
        11=>'Affectionate',
        12=>'Independent'
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
})->name('contact');

Route::get('/dashboard', function () {
    return redirect()->route('pet-sitting.index'); // or route('home')
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // sitter application
    Route::get('/pet-sitting/sitter/apply', [SitterProfileController::class, 'create'])->name('sitter.apply');
    Route::post('/pet-sitting/sitter/apply', [SitterProfileController::class, 'store'])->name('sitter.store');

    // owner request
    Route::get('/pet-sitting/request/create', [PetSittingRequestController::class, 'create'])->name('request.create');
    Route::post('/pet-sitting/request/create', [PetSittingRequestController::class, 'store'])->name('request.store');

    // account pages
    Route::get('/account/sitter-profile', [AccountController::class, 'sitterProfile'])->name('account.sitter-profile');
    Route::get('/account/requests', [AccountController::class, 'requests'])->name('account.requests');
    Route::get('/account/matches', [AccountController::class, 'matches'])->name('account.matches');
});

require __DIR__.'/auth.php';
