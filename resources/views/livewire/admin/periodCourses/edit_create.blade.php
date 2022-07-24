<x-jet-dialog-modal wire:ignore.self wire:model.defer="show_edit_create_modal">
    <x-slot name="title">
        {{$modo}} Período
    </x-slot>
    <x-slot name="content">
        <x-jet-label for="x" class="text-red-600" value="Los campos con * son obligatorios" />
        <form id="courseForm">
            <!-- Clave -->
            <div class="mt-4">
                <p>Clave * </p>
                <p class="text-red-700">[Semana] [-] [3 primeras letras del mes] [/] [3 primeras letras del mes] [Año] </p>
                <p class="text-red-700">  <strong> Ejemplo: 1-ENE/AGO2022</strong> </p>
                <x-input.error wire:model="periods.clave" class="block mt-1 w-full" type="text" id="clave" name="clave" for="periods.clave" required/>
            </div>
            <!-- Clave y Periodo -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Clave -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="FechaInicio" >Fecha Inicio <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="periods.fecha_inicio" class="block mt-1 w-full" type="date" id="fecha_inicio" name="fecha_inicio" for="periods.fecha_inicio" required/>
                </div>
                <!-- Perfil -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="FechaFin">Fecha Fin <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="periods.fecha_fin" class="block mt-1 w-full" type="date" id="fecha_fin" name="fecha_fin" for="periods.fecha_fin" required/>
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('show_edit_create_modal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent=" update_period()" wire:loading.attr="disabled" form="courseForm">
            {{$modo}} Datos
         </x-jet-button>
        @if($confirming_save_period)
                    @include('livewire.admin.periodCourses.confirmation')
        @endif
    </x-slot>
</x-jet-dialog-modal>
