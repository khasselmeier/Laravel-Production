<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index()
    {
        // Demo data (you can later move this into a DB table)
        $matchSigns = collect([
            ['id' => 1, 'sign_name' => 'Cozy Homebody'],
            ['id' => 2, 'sign_name' => 'Chaos Gremlin'],
            ['id' => 3, 'sign_name' => 'Sunshine Optimist'],
            ['id' => 4, 'sign_name' => 'Night Owl'],
            ['id' => 5, 'sign_name' => 'Nature Explorer'],
            ['id' => 6, 'sign_name' => 'Quiet Observer'],
            ['id' => 7, 'sign_name' => 'Social Butterfly'],
            ['id' => 8, 'sign_name' => 'Snack Enthusiast'],
            ['id' => 9, 'sign_name' => 'Drama Queen'],
            ['id' => 10, 'sign_name' => 'Zen Minimalist'],
            ['id' => 11, 'sign_name' => 'Overachiever'],
            ['id' => 12, 'sign_name' => 'Wholesome Healer'],
        ]);

        return view('match', compact('matchSigns'));
    }
}
