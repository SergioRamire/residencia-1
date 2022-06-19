@props(['value'])

<a class="px-4 py-2 text-sm border-sky-800 leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition {{ isset($icon) ? 'group flex items-center' : 'block' }}" {{ $attributes->merge() }}>
    @if(isset($icon))
        <!-- class="mr-3 h-5 w-5 text-gray-400 group-hover:text-gray-500" -->
        {{ $icon }}
    @endif
    {{ $value ?? $slot }}
</a>
