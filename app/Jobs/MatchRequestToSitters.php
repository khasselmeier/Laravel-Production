<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MatchRequestToSitters implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $requestId) {}

    public function handle(): void
    {
        $req = \App\Models\PetSittingRequest::where('status','approved')->find($this->requestId);
        if (!$req) return;

        $profiles = \App\Models\SitterProfile::where('status','approved')->get();

        foreach ($profiles as $profile) {
            [$score, $reasons] = (new \App\Jobs\MatchSitterToRequests(0))->score($profile, $req);
            if ($score <= 0) continue;

            \App\Models\MatchResult::updateOrCreate(
                ['sitter_profile_id' => $profile->id, 'pet_sitting_request_id' => $req->id],
                ['score' => $score, 'reasons' => $reasons]
            );
        }
    }
}
