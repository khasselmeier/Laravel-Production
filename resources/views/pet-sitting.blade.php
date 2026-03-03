<x-layout>
    <x-slot:heading>
        Pet Sitting Application
    </x-slot:heading>

    <div class="max-w-2xl space-y-6">

        <p class="text-slate-700">
            Apply to become a pet sitter! Tell us about your experience and what
            animals you’re comfortable caring for.
        </p>

        @if(session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST"
              action="{{ url('/pet-sitting/apply') }}"
              class="space-y-5 bg-white/60 backdrop-blur border border-[#8fae9b]/40 rounded-xl p-6 shadow">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-800 mb-1">
                    Full Name
                </label>
                <input type="text"
                       name="full_name"
                       value="{{ old('full_name') }}"
                       class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none">
                @error('full_name')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-800 mb-1">
                    Experience
                </label>
                <textarea rows="4"
                          name="experience"
                          class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none">{{ old('experience') }}</textarea>
                @error('experience')
                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1">
                        Availability
                    </label>
                    <input type="text"
                           name="availability"
                           value="{{ old('availability') }}"
                           placeholder="Weekends, evenings..."
                           class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1">
                        Preferred Animals
                    </label>
                    <input type="text"
                           name="preferred_animals"
                           value="{{ old('preferred_animals') }}"
                           placeholder="Dogs, cats, reptiles..."
                           class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none">
                </div>
            </div>

            <button type="submit"
                    class="bg-[#8fae9b] hover:bg-[#6f9282] text-white font-semibold px-6 py-3 rounded-lg shadow">
                Submit Application
            </button>

            <p class="text-xs text-slate-500">
                After you submit, your application is stored as <b>pending</b> and reviewed by a queued moderation job.
            </p>

        </form>
    </div>
</x-layout>
