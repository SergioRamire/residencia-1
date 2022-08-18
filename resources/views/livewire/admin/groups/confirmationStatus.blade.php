{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="showConfirmationModal">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        @if($confirming_group_active)
        ¿Seguro que desea habilitar el grupo <strong>
            {{ $this->grupo->nombre}}</strong>?
        @endif
        @if($confirming_group_Inactive)
        ¿Seguro que desea inhabilitar el grupo <strong>
            {{ $this->grupo->nombre}}</strong>?
        @endif
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showConfirmationModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        @if($confirming_group_active)
        <x-jet-danger-button class="ml-3" wire:click="habilitar()" wire:loading.attr="disabled">
            Aceptar
        </x-jet-danger-button>
        @elseif($confirming_group_Inactive)
        <x-jet-danger-button class="ml-3" wire:click="inhabilitar()" wire:loading.attr="disabled">
            Aceptar
        </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-confirmation-modal>
