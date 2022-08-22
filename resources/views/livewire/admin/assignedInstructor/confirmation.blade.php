{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="modal_confirmacion">
    <x-slot name="title">
        Confirmación de agregación
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea agregar el instructor?
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modal_confirmacion')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="asignar()" wire:loading.attr="disabled">
            Guardar
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
