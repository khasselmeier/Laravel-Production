<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sitterProfile()
    {
        $profile = \App\Models\SitterProfile::where('user_id', auth()->id())->first();
        return view('account.sitter-profile', compact('profile'));
    }

    public function requests()
    {
        $requests = \App\Models\PetSittingRequest::where('user_id', auth()->id())
            ->latest()->get();

        return view('account.requests', compact('requests'));
    }

    // Show matches either for their sitter profile or their requests
    public function matches()
    {
        $profile = \App\Models\SitterProfile::where('user_id', auth()->id())->first();

        $sitterMatches = $profile
            ? \App\Models\MatchResult::where('sitter_profile_id', $profile->id)
                ->with('request')
                ->orderByDesc('score')
                ->get()
            : collect();

        $myRequestIds = \App\Models\PetSittingRequest::where('user_id', auth()->id())->pluck('id');
        $ownerMatches = \App\Models\MatchResult::whereIn('pet_sitting_request_id', $myRequestIds)
            ->with('sitterProfile.user')
            ->orderByDesc('score')
            ->get();

        return view('account.matches', compact('sitterMatches','ownerMatches'));
    }
}
