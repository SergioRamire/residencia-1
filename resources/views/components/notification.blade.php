<div class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden"
     :class="icon === 'pencil' ? 'border border-yellow-600' : (icon === 'success' ? 'border border-green-600' : (icon === 'trash' ? 'border border-red-600' : ''))"
     x-cloak x-data="{ show: false, icon: '', message: '' }"
     @notify.window="show = true; icon = $event.detail.icon; message = $event.detail.message; setTimeout(() => show = false, 3200)"
     x-show="show"
     x-transition:enter="transform ease-out duration-700 transition"
     x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
     x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="translate-y-0 opacity-100 sm:translate-x-0"
     x-transition:leave-end="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2">
    <div class="p-4">
        <div class="flex items-start">

            <div class="flex-shrink-0">
                <template x-if="icon == 'success'">
                    <x-icon.success class="h-6 w-6 text-green-600"/>
                </template>
                <template x-if="icon == 'pencil'">
                    <x-icon.pencil alt class="h-6 w-6 text-yellow-600"/>
                </template>
                <template x-if="icon == 'trash'">
                    <x-icon.trash class="h-6 w-6 text-red-600"/>
                </template>
                <template x-if="icon == 'info'">
                    <x-icon.info class="h-6 w-6 text-blue-600"/>
                </template>
            </div>

            <div class="'w-0 flex-1 pt-0.5 ml-3">
                <p x-html="message" class="text-sm font-medium text-gray-900"></p>
            </div>

            <div class="ml-4 flex-shrink-0 flex">
                <button @click="show = false" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <span class="sr-only">Close</span>
                    <!-- Heroicon name: solid/x -->
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
