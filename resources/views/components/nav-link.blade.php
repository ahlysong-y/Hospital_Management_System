@props(['active'])

@php
$classes = ($active ?? false)
? 'inline-flex items-center px-3.5 py-1.5 rounded-xl text-sm font-semibold text-teal-800 bg-teal-50 border border-teal-200 transition-colors duration-150'
: 'inline-flex items-center px-3.5 py-1.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 border border-transparent transition-colors duration-150';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>


