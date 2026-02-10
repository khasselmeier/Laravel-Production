<x-layout>
    <x-slot:heading>
        Your Horoscope
    </x-slot:heading>

    <h2 class="font-bold text-lg">
        {{ $horoscope->sign_name }}
    </h2>

    <p class="text-sm italic text-gray-500">
        {{ $horoscope->core_vibe }}
    </p>

    <p class="mt-4">
        {{ $horoscope->horoscope_text }}
    </p>

    <div class="mt-6 space-y-2">
        <p>
            <strong>Lucky thing:</strong> {{ $horoscope->lucky_thing }}
        </p>
        <p>
            <strong>Unlucky thing:</strong> {{ $horoscope->unlucky_thing }}
        </p>
        <p>
            <strong>Confidence:</strong> {{ $horoscope->confidence_level }}%
        </p>
    </div>
</x-layout>
