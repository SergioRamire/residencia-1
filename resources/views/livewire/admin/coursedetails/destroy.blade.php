{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="confirmingDetailsDeletion">
    <x-slot name="title">
        Eliminar Detalles de un curso.
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea eliminar los detalles del curso <span class="font-bold text-red-900">{{ $curso }}</span>?
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingDetailsDeletion')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="delete()" wire:loading.attr="disabled">
            Eliminar
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
