<?php

namespace App\Jobs;

use App\Models\PetSittingRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ModeratePetSittingRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $requestId) {}

    public function handle(): void
    {
        $request = PetSittingRequest::find($this->requestId);
        if (!$request) return;

        $text = strtolower(
            ($request->notes ?? '') . ' ' .
            json_encode($request->pet_traits)
        );

        $reasons = [];

        if (preg_match('/https?:\/\/|www\./', $text)) {
            $reasons[] = 'Contains a link.';
        }

        if (preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i', $text)) {
            $reasons[] = 'Contains email.';
        }

        $status = count($reasons) ? 'flagged' : 'approved';

        $request->update([
            'status' => $status,
        ]);
    }
}
