<x-layout>
    <x-slot:heading>
        Matches for: {{ $selectedVibe }}
    </x-slot:heading>

    <p class="text-slate-700 mb-6 max-w-2xl">
        The wheel has spoken. Pick your favorite animal match below.
    </p>

    @if($animals->isEmpty())
        <div class="rounded-xl bg-white/70 border border-[#8fae9b]/40 p-6 shadow max-w-xl">
            <p class="text-slate-800 font-semibold">
                No animals are assigned to this vibe yet. Seed again or add more animals!
            </p>
            <a href="/match" class="inline-block mt-4 underline text-slate-800 hover:text-slate-900">
                ← Back to wheel
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($animals as $a)
                @php
                    $img = $a->image_url
                        ?? 'https://images.unsplash.com/photo-1543852786-1cf6624b9987?q=80&w=1200&auto=format&fit=crop';
                @endphp

                <a href="{{ route('match.result', ['id' => $vibeId, 'animal' => $a->id]) }}" class="block rounded-xl overflow-hidden bg-indigo-950/40 border border-yellow-500/20 hover:border-yellow-400/60 transition">
                    <img src="{{ $img }}" alt="{{ $a->name }}" class="w-full h-40 object-cover" />
                    <div class="p-4 space-y-1">
                        <div class="text-yellow-100 font-bold text-lg">{{ $a->name }}</div>
                        <div class="text-slate-200/90">
                            {{ $a->type }} • {{ $a->age }} yrs • <span class="text-yellow-200">{{ $a->energy_level }}</span>
                        </div>
                        <p class="text-slate-300/90 line-clamp-2">{{ $a->bio }}</p>
                        <div class="text-yellow-300 underline font-semibold pt-1">
                            Choose this match →
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-6">
            <a href="/match" class="underline text-slate-800 hover:text-slate-900">
                ← Back to wheel
            </a>
        </div>
    @endif
</x-layout>
