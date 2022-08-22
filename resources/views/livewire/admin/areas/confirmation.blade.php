{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="confirmingSaveArea">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        @if($edit)
                ¿Seguro que desea guardar los cambios del área <strong>{{ $areas->nombre }}</strong>?
            @else
                ¿Seguro que desea crear el área <strong>{{ $areas->nombre }}</strong> ?
            @endif
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingSaveArea')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="save()" wire:loading.attr="disabled">
            Guardar
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
