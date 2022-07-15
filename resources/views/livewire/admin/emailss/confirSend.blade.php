<x-jet-confirmation-modal wire:model.defer="confirming_save_email">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea enviar la notifications?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirming_save_email')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

            <x-jet-button class="ml-3" wire:click.prevent="store()" wire:loading.attr="disabled">
                Confirmar
            </x-jet-button>

    </x-slot>
</x-jet-confirmation-modal>
