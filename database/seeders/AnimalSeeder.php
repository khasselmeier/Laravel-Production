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
                'https://plus.unsplash.com/premium_photo-1677545183884-421157b2da02?q=80&w=1744&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'https://images.unsplash.com/photo-1472491235688-bdc81a63246e?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            'Dog' => [
                'https://images.unsplash.com/photo-1517849845537-4d257902454a?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1561037404-61cd46aa615b?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'https://images.unsplash.com/photo-1543466835-00a7907e9de1?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8ZG9nfGVufDB8fDB8fHww'
            ],
            'Rabbit' => [
                'https://images.unsplash.com/photo-1585110396000-c9ffd4e4b308?q=80&w=1200&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1591561582301-7ce6588cc286?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cmFiYml0fGVufDB8fDB8fHww',
                'https://images.unsplash.com/photo-1452857297128-d9c29adba80b?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8cmFiYml0fGVufDB8fDB8fHww'
            ],
            'Parrot' => [
                'https://images.unsplash.com/photo-1504579264001-833438f93df2?q=80&w=1738&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'https://images.unsplash.com/photo-1586768045025-f7cacc295831?q=80&w=1313&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'https://images.unsplash.com/photo-1538440367084-0a21cb983cee?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MzZ8fHBhcnJvdHxlbnwwfHwwfHx8MA%3D%3D'
            ],
            'Guinea Pig' => [
                'https://images.unsplash.com/photo-1512087499053-023f060e2cea?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'https://images.unsplash.com/photo-1512483652399-7a1f99aa0dd3?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Nnx8Z3VpbmVhJTIwcGlnfGVufDB8fDB8fHww',
                'https://images.unsplash.com/photo-1609309252136-62e4044389ab?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGd1aW5lYSUyMHBpZ3xlbnwwfHwwfHx8MA%3D%3D'
            ],
            'Ferret' => [
                'https://images.unsplash.com/photo-1615087240969-eeff2fa558f2?q=80&w=1160&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'https://images.unsplash.com/photo-1647045965738-94ce0fc81325?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'https://plus.unsplash.com/premium_photo-1710751040695-d673cec55e6a?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            'Turtle' => [
                'https://plus.unsplash.com/premium_photo-1724311824020-d5aa35632c81?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'https://plus.unsplash.com/premium_photo-1664303431418-96daeee80139?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OXx8dHVydGxlfGVufDB8fDB8fHww',
                'https://images.unsplash.com/photo-1585696862208-ca12defa3a78?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fHR1cnRsZXxlbnwwfHwwfHx8MA%3D%3D'
            ],
            'Hamster' => [
                'https://images.unsplash.com/photo-1425082661705-1834bfd09dca?q=80&w=1752&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'https://images.unsplash.com/photo-1584553421349-3557471bed79?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8aGFtc3RlcnxlbnwwfHwwfHx8MA%3D%3D',
                'https://images.unsplash.com/photo-1676918555382-fcd06a483e25?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8aGFtc3RlcnxlbnwwfHwwfHx8MA%3D%3D'
            ],
            'Lizard' => [
                'https://images.unsplash.com/photo-1610629651605-0b181ad69aab?q=80&w=687&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'https://images.unsplash.com/photo-1492963892107-740cd39d9ff3?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8bGl6YXJkfGVufDB8fDB8fHww',
                'https://images.unsplash.com/photo-1615798763618-183906cd14b2?q=80&w=1931&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
            ],
            'Bearded Dragon' => [
                'https://images.unsplash.com/photo-1674484783245-4c065b84daa8?q=80&w=1740&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'https://images.unsplash.com/photo-1651777000971-42922a2e12ad?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8YmVhcmRlZCUyMGRyYWdvbnxlbnwwfHwwfHx8MA%3D%3D',
                'https://images.unsplash.com/photo-1701307742184-b4caa6121681?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTV8fGJlYXJkZWQlMjBkcmFnb258ZW58MHx8MHx8fDA%3D'
            ],
        ];

        // fallback pool (in case a type is missing)
        $fallbackImages = [
            'https://images.unsplash.com/photo-1770983437998-5c16779d7586?w=800&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxmZWF0dXJlZC1waG90b3MtZmVlZHwzMXx8fGVufDB8fHx8fA%3D%3D'
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
