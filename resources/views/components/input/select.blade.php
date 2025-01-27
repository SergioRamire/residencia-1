@props(['disabled' => false])

<div class="relative">
    <select {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'border-[#1b396a] focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-[#1b396a] rounded-md shadow-sm']) }}>
        {{ $slot }}
    </select>
</div>
