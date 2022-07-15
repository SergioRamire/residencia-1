<!-- Modales -->
<x-jet-dialog-modal wire:model="is_open">
    <x-slot name="title">
        {{$modo}} Grupo
    </x-slot>
    <x-slot name="content">
        <x-jet-label for="x" class="text-red-600" value="Los campos con * son obligatorios" />
        <form  id="courseForm">
                <!-- Grupo -->
                <div class="mt-4">
                    <x-jet-label for="Nombre" value="Nombre*" />
                    <x-input.error wire:model="groups.nombre" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="groups.nombre" maxlength="8" required/>
                </div>

        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('is_open')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent="update_group()" wire:loading.attr="disabled" form="courseForm">
           {{$modo}} Datos
        </x-jet-button>
        @if($confirming_save_group)
                    @include('livewire.admin.groups.confirmation')
        @endif
    </x-slot>
</x-jet-dialog-modal>
