<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PetSitter;

class PetSitterSeeder extends Seeder
{
    public function run(): void
    {
        PetSitter::create([
            'name' => 'Jamie Rivera',
            'experience' => '3 years pet sitting dogs and cats',
            'availability' => 'Weekends + evenings',
            'preferred_animals' => 'Dogs, cats'
        ]);

        PetSitter::create([
            'name' => 'Taylor Kim',
            'experience' => 'Volunteered at local animal shelter',
            'availability' => 'Flexible',
            'preferred_animals' => 'Small animals, reptiles'
        ]);
    }
}
