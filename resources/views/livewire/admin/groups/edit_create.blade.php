<!-- Modales -->
<x-jet-dialog-modal wire:model="isOpen">
    <x-slot name="title">
        {{$modo}} Grupo
    </x-slot>
    <x-slot name="content">
        <form  id="courseForm">

                <!-- Grupo -->
                <div class="mt-4">
                    <x-jet-label for="Nombre" value="{{ __('Nombre') }}" />
                    <x-input.error wire:model.defer="nombre" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="nombre" required/>
                </div>

                <!-- Capacidad -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="cap" value="{{ __('Capacidad') }}" />
                    <x-input.error wire:model.defer="capacidad" class="block mt-1 w-full" type="number" id="capacidad" name="capacidad" for="capacidad" maxlength="2" required/>
                </div>

        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('isOpen')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent="updateGroup()" wire:loading.attr="disabled" form="courseForm">
           {{$modo}} Datos
        </x-jet-button>
        @if($confirmingSaveGroup)
                    @include('livewire.admin.groups.confirmation')
        @endif
    </x-slot>
</x-jet-dialog-modal>
