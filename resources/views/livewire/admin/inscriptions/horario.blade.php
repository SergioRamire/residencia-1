<x-jet-dialog-modal wire:ignore.self wire:model.defer="showHorario">
    <x-slot name="title">
        @if ($flag)

        @else
            Cursos seleccionados
        @endif
    </x-slot>
    <x-slot name="content">

        @if ($flag)
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
        @else
            <div class="max-w-7xl mx-auto pt-5">
                <div class="space-y-2">
                    <div class="p-2 bg-white rounded-lg border border-gray-200 shadow-md sm:p-3 lg:p-4 ">
                        <div class="flex flex-col space-y-2">
                            <div id="Layer1" style="
                                width:600px; 
                                height:500px; 
                                overflow-y: scroll;
                            ">
                                @foreach ($tabla as $c)
                                    <span class="text-gray-400">Semana del:
                                    </span>{{ date('d-m-Y', strtotime($c->fecha_inicio)) }} al
                                    {{ date('d-m-Y', strtotime($c->fecha_fin)) }}
                                    <br>
                                    <span class="text-gray-400">Curso: </span>{{ $c->nombre }}
                                    <br>
                                    <span class="text-gray-400">Horario: </span>{{ date('H:i', strtotime($c->hora_inicio)) }} hrs. - {{ date('H:i', strtotime($c->hora_fin)) }} hrs.
                                    <br>
                                    <span class="text-gray-400">Lugar: </span>{{ $c->lugar }}
                                    <br>
                                    <span class="text-gray-400">Duración: </span>{{ $c->duracion }} Hrs.
                                    <br>
                                    <span class="text-gray-400">Perfil: </span>{{ $c->perfil }}
                                    <br>
                                    <span class="text-gray-400">Objetivo: </span>{{ $c->objetivo }}
                                    <br>
                                    <br>
                                @endforeach
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        @endif

    </x-slot>

    <x-slot name="footer">
        @if ($flag)
            <div class="flex items-center justify-center">
                <x-jet-button wire:click="store()" class="ml-4 bg-[#1b396a]">
                    Aceptar
                </x-jet-button>
            </div>
        @else
            <x-jet-secondary-button wire:click="$toggle('showHorario')" type="button">
                Cerrar
            </x-jet-secondary-button>

            <x-jet-button class="ml-3 bg-[#1b396a]" wire:click.prevent="register()" form="courseForm">
                Aceptar
            </x-jet-button>
            {{-- @if ($confirmingSaveInscription) --}}
                @include('livewire.admin.inscriptions.confirmation')
            {{-- @endif --}}
        @endif
    </x-slot>
</x-jet-dialog-modal>



