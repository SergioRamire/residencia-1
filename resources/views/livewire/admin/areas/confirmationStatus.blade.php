{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="showConfirmationModal">
    <x-slot name="title">
        {{-- confirming_area_active --}}
        Confirmación
    </x-slot>

    <x-slot name="content">

        @if($confirming_area_active)
            ¿Seguro que desea habilitar el departamento <strong>
            {{ $area->nombre}}</strong>?
        @elseif($confirming_area_Inactive)
            ¿Seguro que desea inhabilitar el departamento <strong>
            {{ $area->nombre}}</strong>?
        @endif
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        @if($confirming_area_active)
        <x-jet-secondary-button wire:click="$toggle('showConfirmationModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button class="ml-3" wire:click="habilitar()" wire:loading.attr="disabled">
            Aceptar
        </x-jet-danger-button>
        @elseif($confirming_area_Inactive)
        <x-jet-secondary-button wire:click="$toggle('showConfirmationModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-danger-button class="ml-3" wire:click="inhabilitar()" wire:loading.attr="disabled">
            Aceptar
        </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-confirmation-modal>
