<?php

namespace App\Jobs;

use App\Models\SitterProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;   // correct namespace
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ModerateSitterProfile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $profileId) {}

    public function handle(): void
    {
        $profile = SitterProfile::find($this->profileId);
        if (!$profile) return;

        $text = strtolower(
            ($profile->experience ?? '') . ' ' .
            json_encode($profile->allowed_species) . ' ' .
            json_encode($profile->vibes)
        );

        $reasons = [];

        if (preg_match('/https?:\/\/|www\./', $text)) {
            $reasons[] = 'Contains a link.';
        }

        if (preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i', $text)) {
            $reasons[] = 'Contains email.';
        }

        $status = count($reasons) ? 'flagged' : 'approved';

        $profile->update([
            'status' => $status,
            'moderation_notes' => count($reasons) ? implode(' ', $reasons) : null,
            'moderated_at' => now(),
        ]);
    }
}
