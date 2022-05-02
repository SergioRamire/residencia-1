@props(['right', 'addon'])

<div {{ $attributes->merge(['class' => 'flex rounded-md'])->only('class') }}>
    @if(!isset($right))
        <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500">
            {{ $addon ?? $slot }}
        </span>
        <x-jet-input class="w-full min-w-0 rounded-none rounded-r-md" {{ $attributes->merge()->except('class') }}/>
    @else
        <x-jet-input class="w-full min-w-0 rounded-none rounded-l-md" {{ $attributes->merge()->except('class') }}/>
        <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500">
            {{ $addon ?? $slot }}
        </span>
    @endif
</div>
