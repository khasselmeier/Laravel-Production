<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MatchSitterToRequests implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $profileId) {}

    public function handle(): void
    {
        $profile = \App\Models\SitterProfile::where('status','approved')->find($this->profileId);
        if (!$profile) return;

        $requests = \App\Models\PetSittingRequest::where('status','approved')->get();

        foreach ($requests as $req) {
            [$score, $reasons] = $this->score($profile, $req);

            if ($score <= 0) continue;

            \App\Models\MatchResult::updateOrCreate(
                ['sitter_profile_id' => $profile->id, 'pet_sitting_request_id' => $req->id],
                ['score' => $score, 'reasons' => $reasons]
            );
        }
    }

    private function score($profile, $req): array
    {
        $score = 0;
        $reasons = [];

        // hard filter: species must be allowed
        if (!in_array($req->species, $profile->allowed_species ?? [])) {
            return [0, ['Species not allowed']];
        }
        $score += 50;
        $reasons[] = "Species match: {$req->species}";

        // hard filter: sitter cannot handle traits
        $cannot = $profile->cannot_handle ?? [];
        $traits = $req->pet_traits ?? [];
        foreach ($traits as $t) {
            if (in_array($t, $cannot)) {
                return [0, ["Rejected: sitter cannot handle {$t}"]];
            }
        }

        // soft scoring: overlap vibes with pet traits (optional fun)
        $vibes = $profile->vibes ?? [];
        $overlap = array_values(array_intersect($vibes, $traits));
        if (count($overlap)) {
            $score += 10 * count($overlap);
            $reasons[] = 'Trait/vibe overlap: '.implode(', ', $overlap);
        }

        // small bonus if sitter accepts “all animals”
        if (in_array('all', $profile->allowed_species ?? [])) {
            $score += 5;
            $reasons[] = 'Accepts all species';
        }

        return [$score, $reasons];
    }
}
