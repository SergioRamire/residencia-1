<x-jet-confirmation-modal wire:model="advertencia_periodo">
    <x-slot name="title">
        Advertencia
    </x-slot>
    <x-slot name="content">
        <strong>No se puede activar un periodo con fechas anteriores a la actual.</strong>?
    </x-slot>
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('advertencia_periodo')" wire:loading.attr="disabled">
            Cerrar
        </x-jet-secondary-button>
    </x-slot>
</x-jet-confirmation-modal>
