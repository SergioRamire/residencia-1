@props([
    'sortable' => null,
    'direction' => null,
])

<th scope="col" {{ $attributes->merge(['class' => 'px-6 py-3 bg-[#1b396a] text-left text-xs font-medium text-white uppercase tracking-wider'])->only('class') }}>
    @unless($sortable)
        <span>{{ $slot }}</span>
    @else
        <button {{ $attributes->except('class') }} class="flex items-center space-x-1 text-left text-xs font-medium text-white uppercase tracking-wider group">
            <span>{{ $slot }}</span>

            <span>
                @if($direction === 'asc')
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                    </svg>
                @elseif($direction === 'desc')
                    <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                @else
                    <svg class="h-3 w-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                    </svg>
                @endif
            </span>
        </button>
    @endunless
</th>
