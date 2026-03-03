<?php

namespace App\Http\Controllers;

use App\Jobs\ModeratePetSittingApplication;
use App\Models\PetSittingApplication;
use Illuminate\Http\Request;

class PetSittingApplicationController extends Controller
{
    public function create()
    {
        return view('pet-sitting.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => ['required','string','max:255'],
            'experience' => ['required','string','max:5000'],
            'availability' => ['nullable','string','max:255'],
            'preferred_animals' => ['nullable','string','max:255'],
        ]);

        $app = PetSittingApplication::create([
            ...$data,
            'status' => 'pending',
        ]);

        ModeratePetSittingApplication::dispatch($app->id);

        return back()->with('success', 'Application submitted! It is pending review.');
    }
}
