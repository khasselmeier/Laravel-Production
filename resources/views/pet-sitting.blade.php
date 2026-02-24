<x-layout>
    <x-slot:heading>
        Pet Sitting Application
    </x-slot:heading>

    <div class="max-w-2xl space-y-6">

        <p class="text-slate-700">
            Apply to become a pet sitter! Tell us about your experience and what
            animals you’re comfortable caring for.
        </p>

        <form class="space-y-5 bg-white/60 backdrop-blur border border-[#8fae9b]/40 rounded-xl p-6 shadow">

            <div>
                <label class="block text-sm font-semibold text-slate-800 mb-1">
                    Full Name
                </label>
                <input type="text"
                       class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-800 mb-1">
                    Experience
                </label>
                <textarea rows="4"
                          class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1">
                        Availability
                    </label>
                    <input type="text"
                           placeholder="Weekends, evenings..."
                           class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-800 mb-1">
                        Preferred Animals
                    </label>
                    <input type="text"
                           placeholder="Dogs, cats, reptiles..."
                           class="w-full rounded-lg border border-[#8fae9b]/40 p-3 bg-white focus:ring-2 focus:ring-[#8fae9b] outline-none">
                </div>
            </div>

            <button type="button"
                    class="bg-[#8fae9b] hover:bg-[#6f9282] text-white font-semibold px-6 py-3 rounded-lg shadow">
                Submit Application
            </button>

            <p class="text-xs text-slate-500">
                (Demo form — submissions are not stored yet.)
            </p>

        </form>
    </div>
</x-layout>
