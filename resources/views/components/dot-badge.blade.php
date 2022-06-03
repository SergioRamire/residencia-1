<span class="flex absolute h-[0.8rem] w-[0.8rem] top-1 right-1.5 pointer-events-none">
    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
    <span class="relative inline-flex rounded-full h-[0.8rem] w-[0.8rem] bg-indigo-500"></span>
    <span class="absolute text-[9px] font-bold left-1">
        @if(isset($counter))
            <span class="text-white">{{ $counter }}</span>
        @endif
    </span>
</span>
