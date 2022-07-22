{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="confirming_save_inscription">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        ¿Está seguro de su elección?
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirming_save_inscription')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="alter"  wire:loading.attr="disabled">
             Generar Inscripcion
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
