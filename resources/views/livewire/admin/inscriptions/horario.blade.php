<x-jet-dialog-modal wire:ignore.self wire:model.defer="showHorario">
    <x-slot name="title">
        Cursos seleccionados
    </x-slot>
    <x-slot name="content">
        <div class="max-w-7xl mx-auto pt-5">
            <div class="space-y-2">
                <div class="p-2 bg-white rounded-lg border border-gray-200 shadow-md sm:p-3 lg:p-4 ">
                    <div class="flex flex-col space-y-2">
                        <div id="Layer1" style="width:600px; height:500px; overflow: scroll;">
                            @foreach ($tabla as $c)
                                <span class="text-gray-400">Semana del: </span>{{date('d-m-Y', strtotime($c->fecha_inicio))}} al {{date('d-m-Y', strtotime($c->fecha_fin))}}
                                <br>
                                <span class="text-gray-400">Curso: </span>{{ $c->nombre }}
                                <br>
                                <span class="text-gray-400">Horario: </span> De {{ date("g:i a", strtotime($c->hora_inicio))}} a {{ date("g:i a", strtotime($c->hora_fin))}}
                                <br>
                                <span class="text-gray-400">Lugar: </span>{{ $c->lugar }}
                                <br>
                                <span class="text-gray-400">Duración: </span>{{ $c->duracion }} Hrs.
                                <br>
                                <span class="text-gray-400">Perfil: </span>{{ $c->perfil }}
                                <br>
                                <span class="text-gray-400">Objetivo: </span>{{ $c->objetivo }}
                                <br>
                                {{-- <button  type="button"
                                    class="text-indigo-600 hover:text-indigo-900">
                                    Descargar cédula de inscripción
                                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/>
                                    </svg>
                                </button> --}}
                                <br>

                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showHorario')" type="button">
            Cerrar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent="register()" form="courseForm">
            Aceptar
        </x-jet-button>
        @if($confirmingSaveInscription)
                    @include('livewire.admin.inscriptions.confirmation')
        @endif
    </x-slot>
</x-jet-dialog-modal>
