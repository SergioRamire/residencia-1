<x-jet-dialog-modal wire:ignore.self wire:model.defer="show_horario">
    <x-slot name="title">
        Cursos seleccionados
    </x-slot>
    <x-slot name="content">
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

    </x-slot>

    <x-slot name="footer">

            <x-jet-secondary-button wire:click="$toggle('show_horario')" type="button">
                Cerrar
            </x-jet-secondary-button>

            <x-jet-button class="ml-3 bg-[#1b396a]" wire:click.prevent="mostrar_modal_de_verificacion()" form="courseForm">
                Aceptar
            </x-jet-button>
            @include('livewire.admin.inscriptions.confirmation')
    </x-slot>
</x-jet-dialog-modal>


