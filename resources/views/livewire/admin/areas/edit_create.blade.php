<!-- Modales -->
<x-jet-dialog-modal wire:model="showEditCreateModal">
    <x-slot name="title">
        {{$modo}} Área
    </x-slot>
    <x-slot name="content">
        <x-jet-label for="x" class="text-red-600" value="Los campos con * son obligatorios" />
        <form  id="courseForm">
                <!-- Clave -->
                <div class="mt-4">
                    <x-jet-label for="clave">Clave <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="clave" class="block mt-1 w-full" type="text" id="clave" name="clave" for="clave" required/>
                </div>
                <!-- Nombre -->
                <div class="mt-4">
                    <x-jet-label for="nombre">Nombre <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="nombre" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="nombre" required/>
                </div>
                <!-- Jefe -->
                <div class="mt-4">
                    <x-jet-label for="nombre">Nombre del Jefe <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="jefe_area" class="block mt-1 w-full" type="text" id="jefe_area" name="jefe" for="jefe_area" required/>
                </div>

                <!-- Telefono -->
                <div class="mt-4">
                    <x-jet-label for="telefono">Teléfono <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="telefono" class="block mt-1 w-full" type="text" id="telefono" name="telefono" for="telefono" maxlength="10" required/>
                </div>

                <!-- Extension -->
                <div class="mt-4">
                    <x-jet-label for="extension">Extensión <span class="text-red-600">*</span></x-jet-label>
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
