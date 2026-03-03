<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SitterProfile;
use App\Jobs\ModerateSitterProfile;

class SitterProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('pet-sitting.sitter-apply');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'experience' => ['nullable', 'string', 'max:5000'],
            'allowed_species' => ['required', 'array', 'min:1'],
            'allowed_species.*' => ['string', 'max:50'],
            'vibes' => ['nullable', 'array'],
            'vibes.*' => ['string', 'max:50'],
            'cannot_handle' => ['nullable', 'array'],
            'cannot_handle.*' => ['string', 'max:50'],
        ]);

        $profile = SitterProfile::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'experience' => $data['experience'] ?? null,
                'allowed_species' => $data['allowed_species'],
                'vibes' => $data['vibes'] ?? [],
                'cannot_handle' => $data['cannot_handle'] ?? [],
                'status' => 'pending',
                'moderation_notes' => null,
                'moderated_at' => null,
            ]
        );

        ModerateSitterProfile::dispatch($profile->id);

        return redirect()
            ->route('account.sitter-profile')
            ->with('success', 'Submitted! Your application is pending review.');
    }
}
