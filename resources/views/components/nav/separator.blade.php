@props(['value'])

<div class="block border-[#1b396a] px-4 py-2 text-xs text-gray-400">
    {{ $value ?? $slot }}
</div>
