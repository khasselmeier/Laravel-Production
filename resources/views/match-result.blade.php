<x-layout>
    <x-slot:heading>
        Your Match: {{ $animal->name }}
    </x-slot:heading>

    @php
        $img = $animal->image_url
            ?? 'https://images.unsplash.com/photo-1543852786-1cf6624b9987?q=80&w=1200&auto=format&fit=crop';
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="rounded-xl bg-indigo-950/40 border border-yellow-500/20 overflow-hidden">
            <img src="{{ $img }}" alt="{{ $animal->name }}" class="w-full h-72 object-cover" />
            <div class="p-6 space-y-3">
                <div class="text-yellow-100 text-2xl font-bold">{{ $animal->name }}</div>
                <div class="text-slate-200/90">
                    {{ $animal->type }} • {{ $animal->age }} yrs •
                    <span class="text-yellow-200">{{ $animal->energy_level }}</span>
                </div>
                <p class="text-slate-300/90">{{ $animal->bio }}</p>
                <div class="text-sm text-yellow-200/90">
                    Wheel vibe: <span class="font-semibold">{{ $selectedVibe }}</span>
                </div>

                <div class="pt-3 flex gap-3">
                    <a href="/adoption/{{ $animal->id }}"
                       class="rounded-lg bg-yellow-400 text-slate-900 font-semibold px-4 py-2 hover:bg-yellow-300">
                        Adopt {{ $animal->name }} →
                    </a>
                    <a href="/match" class="rounded-lg border border-yellow-400/50 text-yellow-200 px-4 py-2 hover:bg-yellow-400/10">
                        Spin again
                    </a>
                </div>
            </div>
        </div>

        <div class="rounded-xl bg-white/70 border border-[#8fae9b]/40 p-6 shadow space-y-3">
            <div class="text-slate-900 text-xl font-bold">Why this match?</div>
            <p class="text-slate-700">
                You picked <strong>{{ $selectedVibe }}</strong>. This animal matched that vibe.
            </p>
        </div>

    </div>
</x-layout>
