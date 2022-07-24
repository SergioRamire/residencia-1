{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="confirming_period_deletion">
    <x-slot name="title">
        Eliminar Período.
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea eliminar el Período de <strong>{{$periods->clave}}</strong> ?
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirming_period_deletion')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="delete()" wire:loading.attr="disabled">
            Eliminar
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
