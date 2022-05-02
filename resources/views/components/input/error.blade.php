@props(['disabled' => false, 'for'])

@php
    $e = $errors->has($for);
    $red = ($e)
            ? 'w-full border-red-300 focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50 pr-10 text-red-900 rounded-md placeholder-red-300 shadow-sm'
            : 'border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'
@endphp

@if($e)
    <div {{ $attributes->merge(['class' => 'inline-block relative'])->only('class') }}>
        <input {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge()->except('class') }} class="{{ $red }}">

        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                 fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                      clip-rule="evenodd"/>
            </svg>
        </div>
    </div>
    @error($for)
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
@else
    <x-jet-input {{ $attributes->merge() }}/>
@endif
