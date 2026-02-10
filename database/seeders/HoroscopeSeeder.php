<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Horoscope;


// RUN php artisan db:seed TO SEED!!

class HoroscopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $signNames = [
            'The Overthinker',
            'The Procrastinator',
            'The Spilled Drink',
            'The Side-Quester',
            'The Chronically Early',
            'The Chair with Intent',
            'The Emotionally Attached',
            'The Sentient Puddle',
            'The Tab Opener',
            'The Almost Productive',
            'The Snack Drawer',
            'The Optimistic Liar',
        ];

        $coreVibes = [
            'Aggressively whimsical',
            'Confidently behind schedule',
            'Technically online, spiritually offline',
            'Searching for meaning',
            'On the verge of a meaningless breakthrough',
            'Existing aggressively',
            'Too invested',
            'Searching for meaning',
            'Suspiciously biodegradable',
            'Vaguely threatening optimism ',
            'Mysterious chaos',
            'Constantly thinking',
        ];

        $horoscopeTexts = [
            'You will replay a conversation from years ago and learn nothing from it.',
            'Someone will staying "interesting" and you will think about it for hours.',
            'You will remember something embarrassing from years ago.',
            'You will start one task and complete four unrelated ones.',
            'Avoid making big choices while hungry, tired, or annoyed.',
            'You will remember to respond after it’s socially unacceptable.',
            'An invisible committee has approved of your existence for another 24 hours.',
            'Your brain will buffer mid-sentence. Pretend it was intentional.',
            'You will open a new tab and forget why.',
            'A minor inconvenience will feel like a personal attack from the universe.',
            'You will win an argument you never actually had. Celebrate quietly.',
            'Avoid decisions made while standing in a doorway.',
        ];

        $luckyThings = [
            'Finding cash in a pocket',
            'Tomorrow',
            'A charger appearing when needed',
            'Snacks',
            'Extra time you did not expect',
            'Finding something you thought was lost',
            'Dramatic sighs',
            'Your favorite song playing',
            'A rock that feels unusually important',
            'Finding a feather indoors',
            'The color orange (emotionally)',
            'A nap that feels prophetic',
        ];

        $unluckyThings = [
            'Autocorrect inventing new words',
            'Forgetting why you opened a tab',
            'People watching your parallel park',
            'Walking into a spider web',
            'Small talk',
            'A very confident pigeon',
            'The concept of triangles',
            'A lamp',
            'Burnt toast',
            'Squeaky doors',
            'Remembering a task right after you relax',
            'Reality',
        ];

        //clear table before seeding
        Horoscope::truncate();

        foreach ($signNames as $signName) {
            Horoscope::create([
                'sign_name' => $signName,
                'core_vibe' => $coreVibes[array_rand($coreVibes)],
                'horoscope_text' => $horoscopeTexts[array_rand($horoscopeTexts)],
                'lucky_thing' => $luckyThings[array_rand($luckyThings)],
                'unlucky_thing' => $unluckyThings[array_rand($unluckyThings)],
                'confidence_level' => rand(1, 99),
            ]);
        }
    }
}
