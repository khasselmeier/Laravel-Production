@props(['active' => false])

<a
    {{ $attributes }}
    class="rounded-md px-4 py-2 text-sm font-semibold transition-all duration-200

    {{ $active
        ? 'bg-gradient-to-r from-[#8fae9b] to-[#6f8f7c] text-white shadow-md ring-1 ring-white/60'
        : 'text-[#6f8f7c] hover:text-[#4f6f5d] hover:bg-[#8fae9b]/30'
    }}"
    aria-current="{{ $active ? 'page' : 'false' }}"
>
    {{ $slot }}
</a>
