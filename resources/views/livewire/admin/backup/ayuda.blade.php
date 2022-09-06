<x-jet-dialog-modal wire:ignore.self wire:model.defer="modal_ayuda">
    <x-slot name="title">
        Ayuda para crear respaldos y restaurarlos.
    </x-slot>
    <x-slot name="content">

        <div x-data="{ open: false }" @click="open = true" class="p-4 my-4 bg-blue-50 border-gray-100 rounded-md">
            <div class="flex justify-between">
                <button class="font-bold text-justify text-xl">Pasos para crear Respaldo de la base de datos.</button> 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>

            <div x-show="open" @click.outside="open = false">
                <div class="py-2 px-4">
                    <span class="font-normal text-justify text-lg">Presionar el botón <strong class="bg-white text-black font-bold border border-[#1b396a] rounded shadow">NUEVO RESPALDO</strong>.</span>
                </div>
                <div class="py-2 px-4">
                    <span class="font-normal text-justify text-lg">Aparecera un modal, presionar el botón <strong class="bg-[#1b396a] text-white font-bold border border-[#1b396a] rounded shadow">Crear</strong>.</span>
                    
                </div>
                <div class="py-2 px-4">
                    <span class="font-normal text-justify text-lg">El respaldo se generará, y se mostrará en la tabla.</span>
                </div>
            </div>
        </div>

        <div x-data="{ open: false }" @click="open = true" class="p-4 my-4 bg-blue-50 border-gray-100 rounded-md">
            <div class="flex justify-between">
                <button class="font-bold text-justify text-xl">Pasos para descargar el Respaldo de la base de datos.</button>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div x-show="open" @click.outside="open = false">
                <div class="py-2 px-4">
                    <span class="font-normal text-justify text-lg">Presionar el botón <strong class="bg-white text-black font-bold border border-amber-400 rounded shadow">Descargar</strong>.</span>
                </div>
                <div class="py-2 px-4">
                    <span class="font-normal text-justify text-lg">Elegimos donde guardar, y empezara a descargar el respaldo.</span>
                </div>
            </div>
        </div>

        <div x-data="{ open: false }" @click="open = true" class="p-4 my-4 bg-blue-50 border-gray-100 rounded-md">
            <div class="flex justify-between">
                <button class="font-bold text-justify text-xl">Pasos para la Restauración la base de datos.</button>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div x-show="open" @click.outside="open = false">
                <div class="py-2 px-4">
                    <span class="font-normal text-justify text-lg">Presionar el botón <strong class="bg-white text-black font-bold border border-green-400 rounded shadow">Restaurar</strong>.</span>
                </div>
                <div class="py-2 px-4">
                    <span class="font-normal text-justify text-lg">Aparecera un modal, presionar el botón <strong class="bg-green-800 text-white font-bold border border-green-400 rounded shadow">Restaurar</strong>.</span>
                </div>
                <div class="py-2 px-4">
                    <span class="font-normal text-justify text-lg">El respaldo se estará ejecutando, al terminar los datos estaran resaurados.</span>
                </div>
            </div>
        </div>

        <div x-data="{ open: false }" @click="open = true" class="p-4 my-4 bg-blue-50 border-gray-100 rounded-md">
            <div class="flex justify-between">
                <button class="font-bold text-justify text-xl">Pasos para eliminar el respaldo de la base de datos.</button>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div x-show="open" @click.outside="open = false">
                <div class="p-4">
                    <span class="font-normal text-justify text-lg">Presionar el botón <strong class="bg-white text-black font-bold border border-red-400 rounded shadow">Eliminar</strong>.</span>
                </div>
                <div class="py-2 px-4">
                    <span class="font-normal text-justify text-lg">Aparecera un modal, presionar el botón <strong class="bg-red-800 text-white font-bold border border-red-400 rounded shadow">Eliminar</strong>.</span>
                </div>
                <div class="py-2 px-4">
                    <span class="font-normal text-justify text-lg">El respaldo se eliminará, y ya no aparecesar en la tabla.</span>
                </div>
            </div>
        </div>

    </x-slot>   

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modal_ayuda')" wire:loading.attr="disabled">
            Cerrar
        </x-jet-secondary-button>
    </x-slot>
</x-jet-dialog-modal>
