@props(['right', 'addon', 'padding'])

<div {{ $attributes->merge(['class' => 'relative'])->only('class') }}>
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <span class="text-gray-500"> {{ $addon ?? $slot }} </span>
    </div>
    <x-jet-input class="w-full {{ $padding ?? 'pl-16' }}" {{ $attributes->merge()->except('class') }}/>
</div>
