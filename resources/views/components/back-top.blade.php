<div x-data="{ scrollBackTop: false }" class="fixed bottom-2 right-1/2 translate-x-1/2 md:translate-x-0">
    <button type="button"
            class="animate-pulse inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-indigo-600/25 md:bg-indigo-600/40 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            x-cloak x-show="scrollBackTop"
            @scroll.window="document.documentElement.scrollTop > 20 ? scrollBackTop = true : scrollBackTop = false"
            @click="window.scrollTo({top: 0})">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-5 md:w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
        </svg>
    </button>
</div>
