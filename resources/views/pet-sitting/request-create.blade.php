<x-layout>
    <x-slot:heading>Create Pet Sitting Request</x-slot:heading>

    <div class="max-w-2xl space-y-6">
        <form method="POST" action="{{ route('request.store') }}"
              class="space-y-5 bg-white/60 backdrop-blur border border-[#8fae9b]/40 rounded-xl p-6 shadow">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1">Pet Name</label>
                    <input name="pet_name" value="{{ old('pet_name') }}"
                           class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none">
                    @error('pet_name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1">Species</label>
                    <select name="species"
                            class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none">
                        @foreach(['cat'=>'Cat','dog'=>'Dog','reptile'=>'Reptile','bird'=>'Bird','rabbit'=>'Rabbit'] as $k=>$label)
                            <option value="{{ $k }}" @selected(old('species')===$k)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('species') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1">Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}"
                           class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1">End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}"
                           class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none">
                </div>
            </div>

            @php
                $traits = ['hyperactive'=>'Hyperactive','anxious'=>'Anxious','aggressive'=>'Aggressive','needs_meds'=>'Needs medication'];
            @endphp

            <div class="space-y-2">
                <p class="text-sm font-semibold text-slate-800">Pet traits</p>
                <div class="grid grid-cols-2 gap-2">
                    @foreach($traits as $k => $label)
                        <label class="flex items-center gap-2 text-slate-700">
                            <input type="checkbox" name="pet_traits[]"
                                   value="{{ $k }}"
                                @checked(in_array($k, old('pet_traits', [])))>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-800 mb-1">Notes</label>
                <textarea name="notes" rows="4"
                          class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none">{{ old('notes') }}</textarea>
            </div>

            <button type="submit"
                    class="bg-[#8fae9b] hover:bg-[#6f9282] text-white font-semibold px-6 py-3 rounded-lg shadow">
                Submit Request
            </button>

            <p class="text-xs text-slate-500">
                Requests are moderated in a queue, then matched to sitters.
            </p>
        </form>
    </div>
</x-layout>
