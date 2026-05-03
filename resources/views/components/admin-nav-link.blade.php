@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block px-4 py-2.5 mt-2 text-sm font-semibold text-white bg-gradient-to-r from-theme-orange to-theme-gold rounded-xl shadow-[0_0_15px_rgba(255,107,0,0.2)] transition-all border border-theme-orange/20'
            : 'block px-4 py-2.5 mt-2 text-sm font-semibold text-gray-400 bg-transparent rounded-xl hover:bg-[#1a1c23] hover:text-white border border-transparent hover:border-gray-800 transition-colors';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
