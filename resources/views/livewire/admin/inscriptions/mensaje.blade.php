<x-jet-dialog-modal wire:ignore.self wire:model="show_mensaje">
    <x-slot name="title">
    </x-slot>
    <x-slot name="content">
        <div class="bg-[#d9ebfc] px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class=" sm:flex sm:items-start">
                <div class="mx-auto shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-white sm:mx-0 sm:h-10 sm:w-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-xl font-bold">
                        Inscripcion Exitosa
                    </h3>

                    <div class="mt-2 text-xl">
                        Proceso Finalizado
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <div class="flex items-center justify-center">
            <x-jet-button wire:click="redireccionamiento()" class="ml-4 bg-[#1b396a]">
                Aceptar
            </x-jet-button>
        </div>
    </x-slot>
</x-jet-dialog-modal>
