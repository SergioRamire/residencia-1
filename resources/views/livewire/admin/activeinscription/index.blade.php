<div>
    <div class="p-6 w-full bg-white rounded-lg border border-sky-600 shadow-md shadow-sky-800">
        
        <div class="py-4 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Activación</h2>
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">Ofertar Cursos Para las Inscripciones</p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">Periodo mas cercanos:</p>
                </div>
                @if (!empty($fecha))
                    <div class="mt-10">
                        <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10 p-4 shadow-md shadow-gray-500 rounded-md">
                            @foreach ($fecha as $f)
                                <div class="relative">
                                    <dt>
                                        <p class="flex items-center justify-center ml-16 text-lg leading-6 font-medium text-gray-900">{{ $f->clave }}</p>
                                    </dt>
                                    <dd class="flex items-center justify-center mt-2 ml-16 text-base text-gray-500">{{ date('d-m-Y', strtotime($f->fecha_inicio)) }} - {{ date('d-m-Y', strtotime($f->fecha_fin)) }}</dd>
                                    <dd class="flex items-center justify-center mt-2 ml-16 text-base text-gray-500">
                                        @if($f->estado === 1)
                                            <x-badge.basic value="Activo" color="green" large/>
                                        @elseif($f->estado === 0)
                                            <x-badge.basic value="Inactivo" color="red" large/>
                                        @endif    
                                    </dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>                    
                @endif
            </div>
        </div>

        @if (!empty($fecha))
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
        @else
        <div class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            <div class="flex justify-center ">
                <span> Aun no hay periodos sercanos.</span>
            </div>
        </div>
        @endif


    </div>
</div>
