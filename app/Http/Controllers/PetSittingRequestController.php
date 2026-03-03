<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetSittingRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('pet-sitting.request-create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pet_name' => ['required','string','max:255'],
            'species' => ['required','string','max:50'],
            'pet_traits' => ['nullable','array'],
            'pet_traits.*' => ['string','max:50'],
            'start_date' => ['required','date'],
            'end_date' => ['required','date','after_or_equal:start_date'],
            'notes' => ['nullable','string','max:5000'],
        ]);

        $req = \App\Models\PetSittingRequest::create([
            'user_id' => auth()->id(),
            'pet_name' => $data['pet_name'],
            'species' => $data['species'],
            'pet_traits' => $data['pet_traits'] ?? [],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'notes' => $data['notes'] ?? null,
            'status' => 'pending',
        ]);

        \App\Jobs\ModeratePetSittingRequest::dispatch($req->id);

        return redirect()->route('account.requests')->with('success', 'Request submitted! Pending review.');
    }
}
