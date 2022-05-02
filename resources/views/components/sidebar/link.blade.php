@props(['active'])

@php
    $linkClasses = ($active ?? false)
                ? 'bg-gray-200 text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md'
                : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md';

    $iconClasses = ($active ?? false)
                ? 'text-gray-500 mr-4 flex-shrink-0 h-6 w-6'
                : 'text-gray-400 group-hover:text-gray-500 mr-4 flex-shrink-0 h-6 w-6';
@endphp

<a {{ $attributes->merge(['class' => $linkClasses]) }}>
    @if(isset($icon))
        <svg {{ $icon->attributes->merge(['class' => $iconClasses]) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            {{ $icon }}
        </svg>
    @endif
    {{ $slot }}
</a>
