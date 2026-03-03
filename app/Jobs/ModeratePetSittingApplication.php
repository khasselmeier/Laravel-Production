<?php

namespace App\Jobs;

use App\Models\PetSittingApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ModeratePetSittingApplication implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $applicationId)
    {
    }

    public function handle(): void
    {
        $app = PetSittingApplication::find($this->applicationId);
        if (!$app) return;

        // Very simple moderation rules (customize freely)
        $text = strtolower($app->experience . ' ' . $app->availability . ' ' . $app->preferred_animals);

        $flaggedReasons = [];

        // links / contact attempts
        $linkPatterns = ['http://', 'https://', 'www.'];
        foreach ($linkPatterns as $p) {
            if (str_contains($text, $p)) {
                $flaggedReasons[] = 'Contains a link.';
                break;
            }
        }

        // phone/email-ish patterns (super basic)
        if (preg_match('/\b\d{3}[-.\s]?\d{3}[-.\s]?\d{4}\b/', $text)) {
            $flaggedReasons[] = 'Looks like a phone number.';
        }
        if (preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i', $text)) {
            $flaggedReasons[] = 'Contains an email address.';
        }

        // some “banned” words (demo)
        $banned = ['scam', 'fraud', 'abuse', 'kill', 'hate'];
        foreach ($banned as $word) {
            if (preg_match('/\b' . preg_quote($word, '/') . '\b/i', $text)) {
                $flaggedReasons[] = "Contains flagged word: {$word}.";
            }
        }

        if (count($flaggedReasons) > 0) {
            $app->update([
                'status' => 'flagged',
                'moderation_notes' => implode(' ', $flaggedReasons),
                'moderated_at' => now(),
            ]);
        } else {
            $app->update([
                'status' => 'approved',
                'moderation_notes' => null,
                'moderated_at' => now(),
            ]);
        }

        //add in the future: notify admins (mail/notification) if flagged
    }
}
