<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Animal;

class AnimalSeeder extends Seeder
{
    public function run(): void
    {
        // wipe old data
        Animal::truncate();

        $names = [
            'Mochi','Biscuit','Noodle','Pickles','Waffle','Sprite','Bean','Orbit','Zuzu','Crouton',
            'Juniper','Chai','Pebble','Pumpkin','Toast','Sushi','Miso','Wiggles','Clover','Boba',
            'Dumpling','Ketchup','Tater','Nimbus','Pudding','Socks','Marble','Truffle','Daisy','Bagel'
        ];

        $types = ['Dog','Cat','Rabbit','Parrot','Guinea Pig','Ferret','Turtle','Hamster','Lizard','Bearded Dragon'];

        $energyLevels = [
            'Calm','Chaotic','Energetic','Playful','Lazy','Gentle','Loyal','Curious','Shy','Brave','Affectionate','Independent',
        ];

        $vibes = [
            'Snack Seeker',
            '#1 Napper',
            'Little Gremlin',
            'Gentle',
            'Drama Lover',
            '24/7 Zoomies',
            'Constant Side-Eye',
            'Soft Baby',
            'Parkour Enthusiast',
            'Cuddler',
            'Loyal',
            'Mysterious',
        ];

        $bios = [
            'Sleeps like it’s a full-time job.',
            'Believes every human is their best friend.',
            'Has the attention span of a goldfish.',
            'Tiny chaos engine powered by vibes.',
            'Loves cuddles.',
            'Stares into your soul and judges your choices.',
            'Parkour enthusiast.',
            'Gentle sweetheart.',
            'Professional napper.',
            'Loves long walks.',
        ];

        // Image pools by animal type
        $imagesByType = [
            'Cat' => [
                'https://images.unsplash.com/photo-1543852786-1cf6624b9987?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1518791841217-8f162f1e1131?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?q=80&w=1200&auto=format&fit=crop',
            ],
            'Dog' => [
                'https://images.unsplash.com/photo-1517849845537-4d257902454a?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1507149833265-60c372daea22?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1517423440428-a5a00ad493e8?q=80&w=1200&auto=format&fit=crop',
            ],
            'Rabbit' => [
                'https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1556838803-cc94986e5b53?q=80&w=1200&auto=format&fit=crop',
            ],
            'Parrot' => [
                'https://images.unsplash.com/photo-1552728089-57bdde30beb3?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1544923408-75c5cef46f14?q=80&w=1200&auto=format&fit=crop',
            ],
            'Guinea Pig' => [
                'https://images.unsplash.com/photo-1558818498-28c1e002b655?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1622445275576-721325763afe?q=80&w=1200&auto=format&fit=crop',
            ],
            'Ferret' => [
                'https://images.unsplash.com/photo-1615485737457-f07082b32c66?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1615486364524-3f12e08a3b04?q=80&w=1200&auto=format&fit=crop',
            ],
            'Turtle' => [
                'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1526336024174-e58f5cdd8e13?q=80&w=1200&auto=format&fit=crop',
            ],
            'Hamster' => [
                'https://images.unsplash.com/photo-1548767797-d8c844163c4c?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1615485737651-9a1b48f73b29?q=80&w=1200&auto=format&fit=crop',
            ],
            'Lizard' => [
                'https://images.unsplash.com/photo-1501706362039-c6e8094b3d20?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1526336024174-e58f5cdd8e13?q=80&w=1200&auto=format&fit=crop',
            ],
            'Bearded Dragon' => [
                'https://images.unsplash.com/photo-1598387993441-a364f854c3e1?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1619983081563-430f636027fd?q=80&w=1200&auto=format&fit=crop',
            ],
        ];

        // fallback pool (in case a type is missing)
        $fallbackImages = [
            'https://images.unsplash.com/photo-1543852786-1cf6624b9987?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1517849845537-4d257902454a?q=80&w=1200&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1552728089-57bdde30beb3?q=80&w=1200&auto=format&fit=crop',
        ];

        // how many animals total
        $count = 60;

        for ($i = 0; $i < $count; $i++) {
            $name = $names[array_rand($names)] . (rand(0, 1) ? '' : ' ' . rand(1, 10));
            $type = $types[array_rand($types)];
            $age = rand(1, 16);
            $bio = $bios[array_rand($bios)];
            $energy = $energyLevels[array_rand($energyLevels)];
            $vibe = $vibes[array_rand($vibes)];

            // pick an image that matches the type
            $pool = $imagesByType[$type] ?? $fallbackImages;
            $image = $pool[array_rand($pool)];

            Animal::create([
                'name' => $name,
                'type' => $type,
                'age' => $age,
                'bio' => $bio,
                'energy_level' => $energy,
                'zodiac_match' => $vibe,
                'image_url' => $image,
            ]);
        }
    }
}
