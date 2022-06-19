@props(['value'])

<div class="block border-sky-800 px-4 py-2 text-xs text-gray-400">
    {{ $value ?? $slot }}
</div>
