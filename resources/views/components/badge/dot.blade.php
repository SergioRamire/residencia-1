@props(['value', 'large', 'color' => ['bg-gray-100 text-gray-800', 'text-gray-400']])

@php
    $c = match ($color) {
        'red' => ['bg-red-100 text-red-800', 'text-red-400'],
        'yellow' => ['bg-yellow-100 text-yellow-800', 'text-yellow-400'],
        'green' => ['bg-green-100 text-green-800', 'text-green-400'],
        'blue' => ['bg-blue-100 text-blue-800', 'text-blue-400'],
        'indigo' => ['bg-indigo-100 text-indigo-800', 'text-indigo-400'],
        'purple' => ['bg-purple-100 text-purple-800', 'text-purple-400'],
        'pink' => ['bg-pink-100 text-pink-800', 'text-pink-400'],
        default => ['bg-gray-100 text-gray-800', 'text-gray-400']
    };
@endphp

<span {{ $attributes->merge() }} class="inline-flex items-center {{ isset($large) ? 'px-3 py-0.5 text-sm' : 'px-2.5 py-0.5 text-xs' }} rounded-full font-medium {{ $c[0] }}">
  <svg class="{{ isset($large) ? '-ml-1' : '-ml-0.5' }} mr-1.5 h-2 w-2 {{ $c[1] }}" fill="currentColor" viewBox="0 0 8 8">
    <circle cx="4" cy="4" r="3" />
  </svg>
  {{ $value ?? $slot }}
</span>
