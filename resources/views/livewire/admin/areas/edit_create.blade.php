<!-- Modales -->
<x-jet-dialog-modal wire:model="showEditCreateModal">
    <x-slot name="title">
        {{$modo}} Área
    </x-slot>
    <x-slot name="content">
        <x-jet-label for="x"  value="{{_('Los campos con * son obligatorios')}}" />
        <form  id="courseForm">
                <!-- Clave -->
                <div class="mt-4">
                    <x-jet-label for="clave" value="Clave*" />
                    <x-input.error wire:model="clave" class="block mt-1 w-full" type="text" id="clave" name="clave" for="clave" required/>
                </div>
                <!-- Nombre -->
                <div class="mt-4">
                    <x-jet-label for="nombre" value="Nombre*" />
                    <x-input.error wire:model="nombre" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="nombre" required/>
                </div>
                <!-- Jefe -->
                <div class="mt-4">
                    <x-jet-label for="nombre" value="Nombre del Jefe*" />
                    <x-input.error wire:model="jefe_area" class="block mt-1 w-full" type="text" id="jefe_area" name="jefe" for="jefe_area" required/>
                </div>

                <!-- Telefono -->
                <div class="mt-4">
                    <x-jet-label for="telefono" value="Teléfono*" />
                    <x-input.error wire:model="telefono" class="block mt-1 w-full" type="text" id="telefono" name="telefono" for="telefono" maxlength="10" required/>
                </div>

                <!-- Extension -->
                <div class="mt-4">
                    <x-jet-label for="extension" value="Extensión*" />
                    <x-input.error wire:model="extension" class="block mt-1 w-full" type="text" id="extension" name="extension" for="extension" maxlength="4" required/>
                </div>
                </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEditCreateModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent=" updateArea()" wire:loading.attr="disabled" form="courseForm">
           {{$modo}} Datos
        </x-jet-button>
        @if($confirmingSaveArea)
                    @include('livewire.admin.areas.confirmation')
        @endif
    </x-slot>
</x-jet-dialog-modal>
