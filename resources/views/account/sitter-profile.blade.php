<x-layout>
    <x-slot:heading>Your Pet Sitter Application</x-slot:heading>

    <div class="max-w-2xl space-y-4">
        @if(!$profile)
            <p class="text-slate-700">You haven’t submitted an application yet.</p>
            <a href="{{ route('sitter.apply') }}" class="underline text-slate-800">Apply now</a>
        @else
            <div class="rounded-xl border border-slate-200 bg-white p-6 space-y-2">
                <p><b>Status:</b> {{ $profile->status }}</p>

                @if($profile->status === 'flagged')
                    <p class="text-red-700"><b>Notes:</b> {{ $profile->moderation_notes }}</p>
                @endif

                <p><b>Allowed species:</b> {{ implode(', ', $profile->allowed_species ?? []) }}</p>
                <p><b>Vibes:</b> {{ implode(', ', $profile->vibes ?? []) }}</p>
                <p><b>Cannot handle:</b> {{ implode(', ', $profile->cannot_handle ?? []) }}</p>
            </div>

            <a href="{{ route('account.matches') }}" class="underline text-slate-800">
                View your matches
            </a>
        @endif
    </div>
</x-layout>
