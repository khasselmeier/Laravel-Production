<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SitterProfile;
use App\Models\PetSittingRequest;
use Illuminate\Support\Facades\DB;

class MatchingTestSeeder extends Seeder
{
    public function run(): void
    {
        // Create fake users
        $sitterUser = User::create([
            'name' => 'Test Sitter',
            'email' => 'sitter@test.com',
            'password' => bcrypt('password'),
        ]);

        $ownerUser = User::create([
            'name' => 'Pet Owner',
            'email' => 'owner@test.com',
            'password' => bcrypt('password'),
        ]);

        // Create sitter profile
        $sitter = SitterProfile::create([
            'user_id' => $sitterUser->id,
            'experience' => 'Loves animals, especially calm reptiles and birds.',
            'allowed_species' => ['reptile','bird'],
            'vibes' => ['calm','gentle'],
            'cannot_handle' => ['chaotic'],
            'status' => 'approved',
            'moderated_at' => now(),
        ]);

        // Create pet sitting request
        $request = PetSittingRequest::create([
            'user_id' => $ownerUser->id,
            'pet_name' => 'Molly',
            'species' => 'reptile',
            'pet_traits' => ['calm'],
            'start_date' => now(),
            'end_date' => now()->addDays(3),
            'notes' => 'Very relaxed lizard.',
            'status' => 'approved',
        ]);

        // Create fake match
        DB::table('match_results')->insert([
            'sitter_profile_id' => $sitter->id,
            'pet_sitting_request_id' => $request->id,
            'score' => 95,
            'reasons' => json_encode(['Species match', 'Energy match']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
