@props(['active'])

@php
$classes = ($active ?? false)
            ? 'text-empex-green bg-green-100 p-2 font-semibold no-underline text-grey-darkest hover:text-blue-dark'
            : 'hover:text-empex-green hover:bg-green-100 p-2 font-semibold no-underline text-grey-darkest hover:text-blue-dark';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
