<x-jet-dialog-modal wire:ignore.self wire:model.defer="showHorario">
    <x-slot name="title">
        Horario Preliminar
    </x-slot>
    <x-slot name="content">
        <div class="max-w-7xl mx-auto pt-5">
            <div class="space-y-2">
                <div class="p-2 bg-white rounded-lg border border-gray-200 shadow-md sm:p-3 lg:p-4 ">
                    <div class="flex flex-col space-y-2">
                        <div id="Layer1" style="width:600px; height:500px; overflow: scroll;">
                            @foreach ($tabla as $c)
                                <span class="text-gray-400">Semana: </span>{{ $c->fecha_inicio}} {{ $c->fecha_fin}}
                                <br>
                                <span class="text-gray-400">Nombre: </span>{{ $c->nombre }}
                                <br>
                                <span class="text-gray-400">Duración: </span>{{ $c->duracion }} Hrs.
                                <br>
                                <span class="text-gray-400">Dirigido: </span>{{ $c->dirigido }}
                                <br>
                                <span class="text-gray-400">Objetivo: </span>{{ $c->objetivo }}
                                <br>
                                <br>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeShowHorario()" type="button">
            Cerrar
        </x-jet-secondary-button>

        <x-jet-button wire:loading.attr="disabled" form="courseForm">
            Aceptar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
