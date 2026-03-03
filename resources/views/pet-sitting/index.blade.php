<x-layout>
    <x-slot:heading>Pet Sitting</x-slot:heading>

    <div class="space-y-4">
        <p class="text-slate-700">
            Choose what you want to do:
        </p>

        <div class="flex flex-col sm:flex-row gap-3">
            @auth
                <a href="{{ route('sitter.apply') }}"
                   class="bg-[#8fae9b] hover:bg-[#6f9282] text-white font-semibold px-6 py-3 rounded-lg shadow text-center">
                    Apply as a Sitter
                </a>

                <a href="{{ route('request.create') }}"
                   class="bg-white border border-[#8fae9b]/50 hover:bg-[#eef3ef] text-slate-800 font-semibold px-6 py-3 rounded-lg shadow text-center">
                    Create Pet Sitting Request
                </a>

                <a href="{{ route('account.sitter-profile') }}"
                   class="bg-white border border-[#8fae9b]/50 hover:bg-[#eef3ef] text-slate-800 font-semibold px-6 py-3 rounded-lg shadow text-center">
                    View My Application
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="bg-[#8fae9b] hover:bg-[#6f9282] text-white font-semibold px-6 py-3 rounded-lg shadow text-center">
                    Log in to Get Started
                </a>

                <a href="{{ route('register') }}"
                   class="bg-white border border-[#8fae9b]/50 hover:bg-[#eef3ef] text-slate-800 font-semibold px-6 py-3 rounded-lg shadow text-center">
                    Register
                </a>
            @endauth
        </div>
    </div>
</x-layout>
