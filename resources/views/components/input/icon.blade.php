@props(['right'])

<div {{ $attributes->merge(['class' => 'relative'])->only('class') }}>
    @if(!isset($right))
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                {{ $slot }}
        </div>
        <x-jet-input class="pl-10 w-full border-sky-800" {{ $attributes->merge()->except('class') }}/>
    @else
        <x-jet-input class="pr-10 w-full border-sky-800" {{ $attributes->merge()->except('class') }}/>
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                {{ $slot }}
        </div>
    @endif
</div>
