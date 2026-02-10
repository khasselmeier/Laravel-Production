@props(['active' => false])

<a
    {{ $attributes }}
    class="rounded-md px-4 py-2 text-sm font-semibold transition-all duration-200

    {{ $active
        ? 'bg-gradient-to-r from-indigo-900 to-indigo-950 text-yellow-500/80 shadow-md ring-1 ring-yellow-400/40'
        : 'text-yellow-500/40 hover:text-yellow-500/80 hover:bg-indigo-800/60'
    }}"
    aria-current="{{ $active ? 'page' : 'false' }}"
>
    {{ $slot }}
</a>
