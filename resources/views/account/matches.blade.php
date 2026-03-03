<x-layout>
    <x-slot:heading>Your Matches</x-slot:heading>

    <div class="max-w-4xl space-y-8">

        {{-- sitter side matches: pets you can sit --}}
        <div class="space-y-3">
            <h2 class="text-xl font-semibold text-slate-900">Pets you match with (as a sitter)</h2>

            @if(($sitterMatches ?? collect())->isEmpty())
                <p class="text-slate-600">No sitter matches yet.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($sitterMatches as $m)
                        <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-2 shadow">
                            <div class="font-semibold text-slate-900">
                                {{ $m->request->pet_name ?? 'Pet' }}
                            </div>

                            <div class="text-sm text-slate-700">
                                Species: {{ $m->request->species ?? 'Unknown' }}
                            </div>

                            <div class="text-sm text-slate-700">
                                Score: <span class="font-semibold">{{ $m->score }}</span>
                            </div>

                            @if(!empty($m->reasons))
                                <div class="text-xs text-slate-500">
                                    {{ implode(' • ', $m->reasons) }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- owner side matches: sitters that match your requests --}}
        <div class="space-y-3">
            <h2 class="text-xl font-semibold text-slate-900">Sitters who match your requests (as an owner)</h2>

            @if(($ownerMatches ?? collect())->isEmpty())
                <p class="text-slate-600">No owner matches yet.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($ownerMatches as $m)
                        <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-2 shadow">
                            <div class="font-semibold text-slate-900">
                                {{ $m->sitterProfile->user->name ?? 'Sitter' }}
                            </div>

                            <div class="text-sm text-slate-700">
                                Score: <span class="font-semibold">{{ $m->score }}</span>
                            </div>

                            @if(!empty($m->reasons))
                                <div class="text-xs text-slate-500">
                                    {{ implode(' • ', $m->reasons) }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
</x-layout>
