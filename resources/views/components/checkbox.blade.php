@props(['for', 'label'])

<div class="relative flex items-start">
    <div class="flex items-center h-5">
        <input {{ $attributes->merge() }} id="{{ $for }}" name="{{ $for }}" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
    </div>
    <div class="ml-3 text-sm">
        <label for="{{ $for }}" class="font-medium text-gray-800">{{ $label }}</label>
        @if(isset($slot))
            <p class="text-gray-500">{{ $slot }}</p>
        @endif
    </div>
</div>
