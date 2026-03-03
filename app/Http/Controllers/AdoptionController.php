<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function index()
    {
        //swap to once data is implemented:
        // $animals = \App\Models\Animal::latest()->get();

        // Demo data so the page stops crashing
        $animals = collect([
            (object)[
                'id' => 1,
                'name' => 'Pickles',
                'type' => 'Cat',
                'age' => 2,
                'energy_level' => 'Medium',
                'bio' => 'A mysterious loaf who loves sunny windows.',
                'zodiac_match' => 'Cozy Homebody',
            ],
            (object)[
                'id' => 2,
                'name' => 'Rocket',
                'type' => 'Dog',
                'age' => 3,
                'energy_level' => 'High',
                'bio' => 'Zoomies enthusiast. Professional stick finder.',
                'zodiac_match' => 'Chaos Gremlin',
            ],
            (object)[
                'id' => 3,
                'name' => 'Sage',
                'type' => 'Lizard',
                'age' => 4,
                'energy_level' => 'Low',
                'bio' => 'Chill little dinosaur that loves heat lamps.',
                'zodiac_match' => 'Zen Minimalist',
            ],
        ]);

        return view('adoption', compact('animals'));
    }
}
