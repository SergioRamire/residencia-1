{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="confirmingSaveDetails">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        @if($edit)
                ¿Seguro que desea guardar los cambios de los detalles del curso?</strong>
            @else
                ¿Seguro que desea crear los detalles del curso?</strong>
            @endif
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingSaveDetails')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="store()" wire:loading.attr="disabled">
            Guardar
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
