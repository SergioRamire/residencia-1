{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="confirming_save_period">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea guardar cambios del periodo de  <strong>{{$periods->clave}}</strong>?
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirming_save_period')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
            Guardar
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
