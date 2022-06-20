{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="modalConfirmacion">
    <x-slot name="title">
        Confirmacion 
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea {{ $estadox ? 'Activar' : 'Desacticar' }} ALGO?
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalConfirmacion')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="confirmar" wire:loading.attr="disabled">
            {{ $estadox ? 'Activar' : 'Desacticar' }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
