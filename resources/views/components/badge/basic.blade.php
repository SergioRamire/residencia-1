@props(['value', 'rounded', 'large', 'color' => 'bg-gray-100 text-gray-800'])

@php
    $c = match ($color) {
        'red' => 'bg-red-100 text-red-800',
        'yellow' => 'bg-yellow-100 text-yellow-800',
        'green' => 'bg-green-100 text-green-800',
        'blue' => 'bg-blue-100 text-blue-800',
        'indigo' => 'bg-indigo-100 text-indigo-800',
        'purple' => 'bg-purple-100 text-purple-800',
        'pink' => 'bg-pink-100 text-pink-800',
        default => 'bg-gray-100 text-gray-800'
    };
@endphp

<span {{ $attributes->merge() }} class="inline-flex items-center {{ isset($large) ? 'px-3 py-0.5 text-sm' : 'px-2.5 py-0.5 text-xs' }} {{ isset($rounded) ? 'rounded-md' : 'rounded-full' }} font-medium {{ $c }}">
    {{ $value ?? $slot }}
</span>
