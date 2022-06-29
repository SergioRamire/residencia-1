<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditCreateModal">
    <x-slot name="title">
        {{$modo}} Periodo
    </x-slot>
    <x-slot name="content">
        <form id="courseForm">
            <!-- Clave -->
            <div class="mt-4">
                @if (!$edit)
                <p>Clave: </p>
                <p class="text-red-700">[Semana] [-] [3 primeras letras del mes] [/] [3 primeras letras del mes] [Año] </p>
                <p class="text-red-700">  <strong> Ejemplo: 1-ENE/AGO2022</strong> </p>
                @else
                    <x-jet-label for="clave" value="Clave"/>
                @endif
                <x-input.error wire:model="clave" class="block mt-1 w-full" type="text" id="clave" name="clave" for="clave" required/>
            </div>
            <!-- Clave y Periodo -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Clave -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="FechaInicio" value="Fecha Inicio"/>
                    <x-input.error wire:model="fecha_inicio" class="block mt-1 w-full" type="date" id="fecha_inicio" name="fecha_inicio" for="fecha_inicio" required/>
                </div>
                <!-- Perfil -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="FechaFin" value="Fecha Fin"/>
                    <x-input.error wire:model="fecha_fin" class="block mt-1 w-full" type="date" id="fecha_fin" name="fecha_fin" for="fecha_fin" required/>
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEditCreateModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent=" updatePeriod()" wire:loading.attr="disabled" form="courseForm">
            {{$modo}} Datos
         </x-jet-button>
        @if($confirmingSavePeriod)
                    @include('livewire.admin.periodCourses.confirmation')
        @endif
    </x-slot>
</x-jet-dialog-modal>
