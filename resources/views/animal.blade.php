<x-layout>
    <x-slot:heading>
        Adopt {{ $animal->name }}
    </x-slot:heading>

    @php
        // If you later add $animal->image_url in the DB, it will use that.
        // Otherwise it uses a fallback image so it always shows something.
        $img = $animal->image_url
            ?? 'https://images.unsplash.com/photo-1543852786-1cf6624b9987?q=80&w=1200&auto=format&fit=crop';
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Animal card --}}
        <div class="rounded-xl bg-indigo-950/40 border border-yellow-500/20 overflow-hidden">
            <img
                src="{{ $img }}"
                alt="{{ $animal->name }}"
                class="w-full h-72 object-cover"
            />

            <div class="p-6 space-y-3">
                <div class="text-yellow-100 text-2xl font-bold">{{ $animal->name }}</div>

                <div class="text-slate-200/90">
                    {{ $animal->type }} • {{ $animal->age }} yrs •
                    <span class="text-yellow-200">{{ $animal->energy_level }}</span>
                </div>

                <p class="text-slate-300/90">{{ $animal->bio }}</p>

                <div class="text-sm text-yellow-200/90">
                    Match vibe: {{ $animal->zodiac_match }}
                </div>

                <a href="/adoption" class="inline-block text-yellow-300 hover:text-yellow-200 underline">
                    ← Back to Adoption
                </a>
            </div>
        </div>

        {{-- Adoption form --}}
        <div class="rounded-xl bg-white/70 border border-[#8fae9b]/40 p-6 shadow space-y-4">
            <div class="text-slate-900 text-xl font-bold">
                Adoption Form
            </div>

            <p class="text-slate-700">
                Want to adopt <strong>{{ $animal->name }}</strong>? Fill this out and we’ll get back to you.
            </p>

            {{-- Demo form (not saving yet) --}}
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1">Your Name</label>
                    <input
                        type="text"
                        class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none"
                        placeholder="Name"
                    />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1">Email</label>
                    <input
                        type="email"
                        class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none"
                        placeholder="you@email.com"
                    />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1">Why do you want to adopt?</label>
                    <textarea
                        rows="4"
                        class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none"
                        placeholder="Tell us about your home, schedule, etc..."
                    ></textarea>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1">Do you have other pets?</label>
                    <input
                        type="text"
                        class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none"
                        placeholder="Cats, dogs, none, etc."
                    />
                </div>

                <button
                    type="button"
                    class="w-full rounded-lg bg-[#8fae9b] hover:bg-[#6f9282] text-white font-semibold px-6 py-3 shadow"
                >
                    Submit Adoption Request
                </button>

                <p class="text-xs text-slate-500">
                    (Demo form — not stored yet.)
                </p>
            </form>
        </div>

    </div>
</x-layout>
