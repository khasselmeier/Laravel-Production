<x-layout>
    <x-slot:heading>
        Pet Adoption
    </x-slot:heading>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($animals as $a)
            <div class="rounded-xl bg-indigo-950/40 border border-yellow-500/20 p-5 space-y-2">

                <div class="text-yellow-100 font-bold text-lg">
                    {{ $a->name }}
                </div>

                <div class="text-slate-200/90">
                    {{ $a->type }} • {{ $a->age }} yrs •
                    <span class="text-yellow-200">{{ $a->energy_level }}</span>
                </div>

                <p class="text-slate-300/90">{{ $a->bio }}</p>

                <div class="pt-3 flex items-center justify-between">
                    <span class="text-xs text-yellow-200/90">
                        Match vibe: {{ $a->zodiac_match }}
                    </span>

                    <a href="/adoption/{{ $a->id }}" class="text-yellow-300 hover:text-yellow-200 underline font-semibold">
                        Adopt me →
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
