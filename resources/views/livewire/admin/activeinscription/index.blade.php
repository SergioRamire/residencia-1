<div>
    <div class="p-6 w-full bg-white rounded-lg border border-sky-600 shadow-md shadow-sky-800">
        <div class="m-4">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">Ofertar Cursos Para las Inscripciones</h5>
        </div>
        <div class="m-4">
            <p class="text-xl mx=4">Fecha de hoy <span class="font-bold">{{ date('d-m-Y', strtotime($hoy)) }}</span></p>
            <p class="text-xl mx=4">Periodo mas cercano: <span class="font-bold">
                    {{ date('d-m-Y', strtotime($fecha->fecha_inicio)) }}
                    -  
                    {{ date('d-m-Y', strtotime($fecha->fecha_fin)) }}
                </span>
            </p>
        </div>

        <div class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            <div class="flex justify-center ">
                <x-jet-secondary-button wire:click="activar()"
                    class="mx-10 border-sky-800 text-sky-700 hover:text-white hover:bg-sky-800 active:text-sky-50 active:bg-sky-500">
                    Activar
                </x-jet-secondary-button>
                <x-jet-secondary-button wire:click="desactivar()"
                    class="mx-10 border-sky-800 text-sky-700 hover:text-white hover:bg-sky-800 active:text-sky-50 active:bg-sky-500">
                    Desactivar
                </x-jet-secondary-button>
            </div>

        </div>
    </div>
</div>
