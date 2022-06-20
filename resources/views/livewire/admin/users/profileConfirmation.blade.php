<x-jet-confirmation-modal wire:model.defer="showConfirmationModal">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea guardar los cambios?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeM2" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3 bg-[#1b396a]" wire:click.prevent="save()" wire:loading.attr="disabled">
            Confirmar
        </x-jet-button>
    </x-slot>
</x-jet-confirmation-modal>
