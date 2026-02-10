<x-layout>
    <x-slot:heading>
        Choose Your Unreliable Horoscope
    </x-slot:heading>

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
            @foreach ($horoscopes as $i => $horoscope)
                @php
                    //each slice is 30 degrees (360 / 12 slices)
                    $start = -90 + ($i * 30); //start angle
                    $end   = $start + 30;     //end angle
                    $mid   = $start + 15;     //midpoint angle for text label

                    //create SVG path for slice
                    $d = $makePath($start, $end);

                    //get label position coordinates
                    [$tx, $ty] = $labelPos($mid);

                    //wrap long sign names into 1–2 lines
                    $lines = $wrap($horoscope->sign_name);
                @endphp

                {{-- clickable slice linking to horoscope page --}}
                <a href="/horoscopes/{{ $horoscope->id }}" class="zodiac-slice-link" aria-label="{{ $horoscope->sign_name }}">
                    <path
                        d="{{ $d }}"
                        {{-- alternate colors for contrast --}}
                        class="zodiac-slice {{ $i % 2 === 0 ? 'zodiac-slice-a' : 'zodiac-slice-b' }}"
                    />
                </a>

                {{-- text label for each slice --}}
                <text
                    x="{{ $tx }}"
                    y="{{ $ty }}"
                    class="zodiac-label-text"
                    text-anchor="middle"
                    dominant-baseline="middle"
                >
                    @if (count($lines) === 1)
                        {{-- single-line label --}}
                        {{ $lines[0] }}
                    @else
                        {{--two-line label using tspan --}}
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
