<x-layout>
    <x-slot:heading>Your Pet Sitting Requests</x-slot:heading>

    <div class="max-w-4xl space-y-6">

        @if(session('success'))
            <div class="rounded-lg border border-green-200 bg-green-50 p-4 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex items-center justify-between">
            <p class="text-slate-700">
                These are the requests you’ve submitted as a pet owner.
            </p>

            <a href="{{ route('request.create') }}"
               class="bg-[#8fae9b] hover:bg-[#6f9282] text-white font-semibold px-4 py-2 rounded-lg shadow">
                + New Request
            </a>
        </div>

        @if(($requests ?? collect())->isEmpty())
            <div class="rounded-xl bg-white border border-slate-200 p-6">
                <p class="text-slate-700">No requests yet.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($requests as $r)
                    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-2 shadow">
                        <div class="font-semibold text-slate-900">
                            {{ $r->pet_name }} ({{ $r->species }})
                        </div>

                        <div class="text-sm text-slate-700">
                            {{ $r->start_date->format('M j, Y') }} → {{ $r->end_date->format('M j, Y') }}
                        </div>

                        <div class="text-sm">
                            <span class="font-semibold">Status:</span>
                            <span class="
                                {{ $r->status === 'approved' ? 'text-green-700' : '' }}
                                {{ $r->status === 'pending' ? 'text-yellow-700' : '' }}
                                {{ $r->status === 'flagged' ? 'text-red-700' : '' }}
                            ">
                                {{ $r->status }}
                            </span>
                        </div>

                        @if($r->status === 'flagged' && $r->moderation_notes)
                            <div class="text-xs text-red-700">
                                {{ $r->moderation_notes }}
                            </div>
                        @endif

                        @if(!empty($r->pet_traits))
                            <div class="text-xs text-slate-500">
                                Traits: {{ implode(', ', $r->pet_traits) }}
                            </div>
                        @endif

                        <div class="pt-2">
                            <a href="{{ route('account.matches') }}"
                               class="text-sm underline text-slate-800">
                                View Matches →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-layout>
