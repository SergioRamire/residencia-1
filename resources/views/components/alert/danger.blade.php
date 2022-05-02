@props(['border' => false, 'duration'])

<div x-cloak x-data="{ show: false }" x-show="show"
     {{ isset($duration) ? $attributes->merge(['x-init' => "() => {setTimeout(() => show = true, 1);setTimeout(() => show = false, $duration);}"]) : ''}}
     x-transition:enter="transition ease-out duration-500"
     x-transition:enter-start="opacity-0 transform scale-90"
     x-transition:enter-end="opacity-100 transform scale-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 transform scale-200"
     x-transition:leave-end="opacity-0 transform scale-90"
     class="{{ $border ? 'border-l-4 border-red-400' : 'rounded-md' }} bg-red-50 p-4">
    <div class="flex">
        <div class="flex-shrink-0">
            <x-icon.danger solid class="h-5 w-5 text-red-400"/>
        </div>
        <div class="ml-3">
            <p class="text-sm font-semibold text-red-800">{{ $slot }}</p>
        </div>
        <div class="ml-auto pl-3">
            <div class="-mx-1.5 -my-1.5">
                <button @click="show = false" type="button" class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600">
                    <span class="sr-only">Dismiss</span>
                    <x-icon.close solid class="h-5 w-5"/>
                </button>
            </div>
        </div>
    </div>
</div>
