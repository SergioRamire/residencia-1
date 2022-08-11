<x-jet-dialog-modal wire:ignore.self wire:model.defer="show_view_modal">
    <x-slot name="title">
        Detalles del curso:
    </x-slot>
    <x-slot name="content">
            <!-- Nombre  Curso-->
            <div class="mt-4">
                <x-jet-label for="nombrec" value="Curso"/>
                <x-jet-input wire:model.defer="curso" class="block mt-1 w-full" type="text" disabled/>
            </div>

            <!-- Periodo y Hora inicio y Hora fin -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Periodo -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="periodo" value="Período"/>
                    <x-jet-input wire:model.defer="period" class="block mt-1 w-full" type="text" disabled/>
                </div>

                <!-- Modalidad -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="modalidad" value="Modalidad"/>
                    <x-jet-input wire:model.defer="modalidad" class="block mt-1 w-full" type="text" disabled/>
                </div>
            </div>

            <!-- Periodo y Hora inicio y Hora fin -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">

                <!-- Hora inicio -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="hora_inicio" value="Hora inicio"/>
                    <x-jet-input wire:model.defer="hora_inicio" class="block mt-1 w-full" type="text" disabled/>
                </div>

                <!-- Hora fin -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="hora_fin" value="Hora fin"/>
                    <x-jet-input wire:model.defer="hora_fin" class="block mt-1 w-full" type="text" disabled/>
                </div>
            </div>

            <!-- Lugar -->
            <div class="mt-4">
                <x-jet-label for="lugar" value="Lugar"/>
                <x-jet-input wire:model.defer="lugar" class="block mt-1 w-full" type="text" disabled/>
            </div>

            <!-- Capacidad y Grupo -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">

                <!-- Capacidad -->
                <div class="mt-4">
                    <x-jet-label for="capacidad" value="Capacidad" />
                    <x-jet-input wire:model.defer="capacidad" class="block mt-1 w-full" type="number" disabled/>
                </div>

                <!-- Grupo -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="grupo" value="Grupo"/>
                    <x-jet-input wire:model.defer="grupo_id" class="block mt-1 w-full" type="text" disabled/>
                </div>

                <!-- Numero de curso para las constancias -->
                <div class="mt-4">
                    <x-jet-label for="numero_curso" value="Número de curso" />
                    <x-jet-input wire:model.defer="numero_curso" class="block mt-1 w-full" type="number" disabled />
                </div>
            </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-button wire:click="$toggle('show_view_modal')" wire:loading.attr="disabled" >
            Hecho
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
