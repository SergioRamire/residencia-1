{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model.defer="confirming_save_participant">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea guardar cambios del participante?
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirming_save_participant')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        @if ($edit)
            <x-jet-danger-button class="ml-3" wire:click="update" wire:loading.attr="disabled">
                Actualizar
            </x-jet-danger-button>
        @else
            <x-jet-danger-button class="ml-3" wire:click="store" wire:loading.attr="disabled">
                Guardar
            </x-jet-danger-button>
        @endif

    </x-slot>
</x-jet-confirmation-modal>
