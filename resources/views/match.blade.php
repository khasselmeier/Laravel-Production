<x-layout>
    <x-slot:heading>
        Match Me With an Animal
    </x-slot:heading>

    <p class="text-slate-700 mb-6 max-w-2xl">
        Choose your vibe from the wheel below. The universe
        will match you with your ideal animal companion.
    </p>

    @php
        //canvas size
        $size = 700;

        //center point of the circle
        $cx = $size / 2;
        $cy = $size / 2;

        //outer and inner radius of the wheel
        $R = 340;  //outer radius
        $r = 120;  //inner radius (center hole)

        //function to convert angle & radius into x/y coordinates for SVG placement
        $polar = function ($radius, $angleDeg) use ($cx, $cy) {
            $a = deg2rad($angleDeg); //convert degrees to radians
            return [
                $cx + $radius * cos($a), //calculate x position
                $cy + $radius * sin($a)  //calculate y position
            ];
        };

        //function to create a sliced path between two angles
        //this builds the curved wedge for each section
        $makePath = function ($startDeg, $endDeg) use ($polar, $R, $r) {

            //outer arc start and end points
            [$x1, $y1] = $polar($R, $startDeg);
            [$x2, $y2] = $polar($R, $endDeg);

            //inner arc start and end points
            [$x3, $y3] = $polar($r, $endDeg);
            [$x4, $y4] = $polar($r, $startDeg);

            //return path string:
            //M = move to start
            //A = draw arc
            //L = draw line
            //Z = close shape
            return "M $x1 $y1
                    A $R $R 0 0 1 $x2 $y2
                    L $x3 $y3
                    A $r $r 0 0 0 $x4 $y4
                    Z";
        };

        //function to determine where the text label should be placed
        //slightly inside the outer radius
        $labelPos = function ($angleDeg) use ($polar, $R) {
            return $polar($R - 90, $angleDeg);
        };

        //function to split long names into 2 lines
        $wrap = function ($text) {
            $parts = preg_split('/\s+/', trim($text)); // split words

            //if 1–2 words, keep as single line
            if (count($parts) <= 2) return [$text];

            //otherwise split into two roughly even lines
            $mid = (int) ceil(count($parts) / 2);
            return [
                implode(' ', array_slice($parts, 0, $mid)),
                implode(' ', array_slice($parts, $mid)),
            ];
        };
    @endphp

    <div class="zodiac-svg-wrap">
        <!-- main SVG element for wheel -->
        <svg class="zodiac-svg" viewBox="0 0 {{ $size }} {{ $size }}" role="img" aria-label="Horoscope wheel">

            {{-- generate each slice + label --}}
            {{-- generate each slice + label --}}
            @foreach ($matchSigns as $i => $sign)
                @php
                    $start = -90 + ($i * 30);
                    $end   = $start + 30;
                    $mid   = $start + 15;

                    $d = $makePath($start, $end);
                    [$tx, $ty] = $labelPos($mid);

                    $lines = $wrap($sign['sign_name']);
                @endphp

                {{-- clickable slice linking to the vibe results page --}}
                <a href="/match/{{ $sign['id'] }}" class="zodiac-slice-link" aria-label="{{ $sign['sign_name'] }}">                    <path
                        d="{{ $d }}"
                        class="zodiac-slice {{ $i % 2 === 0 ? 'zodiac-slice-a' : 'zodiac-slice-b' }}"
                    />
                </a>

                {{-- text label --}}
                <text
                    x="{{ $tx }}"
                    y="{{ $ty }}"
                    class="zodiac-label-text"
                    text-anchor="middle"
                    dominant-baseline="middle"
                >
                    @if (count($lines) === 1)
                        {{ $lines[0] }}
                    @else
                        <tspan x="{{ $tx }}" dy="-0.2em">{{ $lines[0] }}</tspan>
                        <tspan x="{{ $tx }}" dy="1.2em">{{ $lines[1] }}</tspan>
                    @endif
                </text>
            @endforeach

            {{-- draw divider lines between each slice --}}
            @for ($j = 0; $j < 12; $j++)
                @php
                    //calculate angle for each divider
                    $angle = -90 + ($j * 30);

                    //line from inner radius to outer radius
                    [$x1, $y1] = $polar($r, $angle);
                    [$x2, $y2] = $polar($R, $angle);
                @endphp

                <line
                    x1="{{ $x1 }}"
                    y1="{{ $y1 }}"
                    x2="{{ $x2 }}"
                    y2="{{ $y2 }}"
                    class="zodiac-divider"
                />
            @endfor

            {{-- center circle of the wheel --}}
            <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r }}" class="zodiac-hole" />

            {{-- lighter ring around the center hole --}}
            <circle cx="{{ $cx }}" cy="{{ $cy }}" r="{{ $r + 10 }}" class="zodiac-hole-ring" />
        </svg>
    </div>
</x-layout>
