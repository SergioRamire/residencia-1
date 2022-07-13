<x-jet-confirmation-modal wire:model="modalConfirmacion">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea guardar cambios del participante?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalConfirmacion')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
            Guardar
        </x-jet-danger-button>
        
    </x-slot>
</x-jet-confirmation-modal>
