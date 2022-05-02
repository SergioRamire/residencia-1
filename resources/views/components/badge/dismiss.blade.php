@props(['value', 'large', 'color' => ['bg-gray-100 text-gray-800', 'text-gray-400']])

@php
    $c = match ($color) {
        'red' => ['bg-red-100 text-red-700', 'text-red-400 hover:bg-red-200 hover:text-red-500 focus:bg-red-500'],
        'yellow' => ['bg-yellow-100 text-yellow-700', 'text-yellow-400 hover:bg-yellow-200 hover:text-yellow-500 focus:bg-yellow-500'],
        'green' => ['bg-green-100 text-green-700', 'text-green-400 hover:bg-green-200 hover:text-green-500 focus:bg-green-500'],
        'blue' => ['bg-blue-100 text-blue-700', 'text-blue-400 hover:bg-blue-200 hover:text-blue-500 focus:bg-blue-500'],
        'indigo' => ['bg-indigo-100 text-indigo-700', 'text-indigo-400 hover:bg-indigo-200 hover:text-indigo-500 focus:bg-indigo-500'],
        'purple' => ['bg-purple-100 text-purple-700', 'text-purple-400 hover:bg-purple-200 hover:text-purple-500 focus:bg-purple-500'],
        'pink' => ['bg-pink-100 text-pink-700', 'text-pink-400 hover:bg-pink-200 hover:text-pink-500 focus:bg-pink-500'],
        default => ['bg-gray-100 text-gray-700', 'text-gray-400 hover:bg-gray-200 hover:text-gray-500 focus:bg-gray-500']
    };
@endphp

<span {{ $attributes->merge()->only('class') }} class="inline-flex items-center rounded-full {{ isset($large) ? 'y-0.5 pl-2.5 pr-1 text-sm' : 'py-0.5 pl-2 pr-0.5 text-xs' }} font-medium {{ $c[0] }}">
  {{ $value ?? $slot }}
  <button {{ $attributes->merge()->except('class') }} type="button" class="flex-shrink-0 ml-0.5 h-4 w-4 rounded-full inline-flex items-center justify-center {{ $c[1] }} focus:outline-none focus:text-white">
    <span class="sr-only">Remove</span>
    <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
      <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
    </svg>
  </button>
</span>
