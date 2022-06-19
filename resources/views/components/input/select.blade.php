@props(['disabled' => false])

<div class="relative">
    <select {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => 'border-sky-800 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) }}>
        {{ $slot }}
    </select>
</div>
