{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="confirmingSaveParti">
    <x-slot name="title">
        {{ __('Confirmación de acción') }}
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea guardar cambios?
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingSaveParti')" wire:loading.attr="disabled">
            {{ __('Cancelar') }}
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="store()" wire:loading.attr="disabled">
            {{ __('Guardar') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
