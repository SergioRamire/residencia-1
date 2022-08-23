{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="showConfirmationModal">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        @if($confirming_period_habil)
            ¿Seguro que desea habilitar el período <strong> {{ date('d-m-Y', strtotime($periods->fecha_inicio)) }} a {{ date('d-m-Y', strtotime($periods->fecha_fin)) }}</strong>?
        @endif
        @if($confirming_period_inhabil)
            ¿Seguro que desea inhabilitar el período <strong> {{ date('d-m-Y', strtotime($periods->fecha_inicio)) }} a {{ date('d-m-Y', strtotime($periods->fecha_fin)) }}</strong>?
        @endif
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showConfirmationModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        @if($confirming_period_active)
        <x-jet-danger-button class="ml-3" wire:click="activar()" wire:loading.attr="disabled">
            Aceptar
        </x-jet-danger-button>
        @endif
        @if($confirming_period_Inactive)
        <x-jet-danger-button class="ml-3" wire:click="desactivar()" wire:loading.attr="disabled">
            Aceptar
        </x-jet-danger-button>
        @endif
        @if($confirming_period_habil)
        <x-jet-danger-button class="ml-3" wire:click="habilitar()" wire:loading.attr="disabled">
            Aceptar
        </x-jet-danger-button>
        @endif
        @if($confirming_period_inhabil)
        <x-jet-danger-button class="ml-3" wire:click="inhabilitar()" wire:loading.attr="disabled">
            Aceptar
        </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-confirmation-modal>
