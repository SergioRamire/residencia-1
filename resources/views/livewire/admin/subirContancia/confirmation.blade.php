<x-jet-confirmation-modal wire:model.defer="showConfirmationModal">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea subir el archivo <strong>{{ isset($constancia) ? $constancia->getClientOriginalName() : ''  }}</strong>?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showConfirmationModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent="save()" wire:loading.attr="disabled">
            Subir
        </x-jet-button>
    </x-slot>
</x-jet-confirmation-modal>
