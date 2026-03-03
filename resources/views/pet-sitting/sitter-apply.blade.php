<x-layout>
    <x-slot:heading>Pet Sitter Application</x-slot:heading>

    <div class="max-w-2xl space-y-6">
        @if(session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('sitter.store') }}"
              class="space-y-5 bg-white/60 backdrop-blur border border-[#8fae9b]/40 rounded-xl p-6 shadow">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-800 mb-1">Experience</label>
                <textarea name="experience" rows="4"
                          class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none">{{ old('experience') }}</textarea>
                @error('experience') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            @php
                $species = ['cat'=>'Cats','dog'=>'Dogs','reptile'=>'Reptiles','bird'=>'Birds','rabbit'=>'Rabbits'];
                $vibes = ['calm'=>'Calm', 'chaotic'=>'Chaotic','energetic'=>'Energetic','playful'=>'Playful','lazy'=>'Lazy',
                    'gentle'=>'Gentle','loyal'=>'Loyal','curious'=>'Curious','shy'=>'Shy','brave'=>'Brave','affectionate'=>'Affectionate',
                        'independent'=>'Independent'];
                $cannot = ['calm'=>'Calm', 'chaotic'=>'Chaotic','energetic'=>'Energetic','playful'=>'Playful','lazy'=>'Lazy',
                    'gentle'=>'Gentle','loyal'=>'Loyal','curious'=>'Curious','shy'=>'Shy','brave'=>'Brave','affectionate'=>'Affectionate',
                        'independent'=>'Independent'];
            @endphp

            <div class="space-y-2">
                <p class="text-sm font-semibold text-slate-800">Animals you’re OK sitting</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($species as $k => $label)
                        <label class="flex items-center gap-2 text-slate-700">
                            <input type="checkbox" name="allowed_species[]"
                                   value="{{ $k }}"
                                @checked(in_array($k, old('allowed_species', [])))>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
                @error('allowed_species') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <p class="text-sm font-semibold text-slate-800">Energy Levels You Can Handle</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($vibes as $k => $label)
                        <label class="flex items-center gap-2 text-slate-700">
                            <input type="checkbox" name="vibes[]"
                                   value="{{ $k }}"
                                @checked(in_array($k, old('vibes', [])))>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="space-y-2">
                <p class="text-sm font-semibold text-slate-800">Dealbreakers</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($cannot as $k => $label)
                        <label class="flex items-center gap-2 text-slate-700">
                            <input type="checkbox" name="cannot_handle[]"
                                   value="{{ $k }}"
                                @checked(in_array($k, old('cannot_handle', [])))>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>

            <button type="submit"
                    class="bg-[#8fae9b] hover:bg-[#6f9282] text-white font-semibold px-6 py-3 rounded-lg shadow">
                Submit Application
            </button>

            <p class="text-xs text-slate-500">
                Your application is saved as <b>pending</b>, moderated in a queue, then matched to compatible pets.
            </p>
        </form>
    </div>
</x-layout>
