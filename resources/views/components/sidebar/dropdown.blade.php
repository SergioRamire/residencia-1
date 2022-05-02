@props(['dpId', 'title', 'active'])

@php
    $linkclasses = ($active ?? false)
                ? 'w-full bg-gray-200 text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md'
                : 'w-full text-gray-600 hover:bg-gray-100 hover:text-gray-900 group flex items-center px-2 py-2 text-base font-medium rounded-md';

    $iconClasses = ($active ?? false)
                ? 'text-gray-500 mr-4 flex-shrink-0 h-6 w-6'
                : 'text-gray-400 group-hover:text-gray-500 mr-4 flex-shrink-0 h-6 w-6';
@endphp

<div x-data="{ show: false }">
    <button @click="show = !show" type="button"
            class="{{ $linkclasses }}">
        <svg {{ $icon->attributes->merge(['class' => $iconClasses]) }} xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            {{ $icon }}
        </svg>
        <span class="flex-1 text-left">{{ $title }}</span>
        <svg :class="!show || 'rotate-180 transition linear duration-300'" class="w-6 h-6 transition linear duration-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </button>
    <div class="space-y-2"
        x-cloak x-show="show"
        x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95">

        <div class="pl-5">
            <div class="flex flex-col border-l border-gray-400">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
