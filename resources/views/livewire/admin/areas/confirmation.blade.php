{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="confirmingSaveArea">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        @if($edit)
                ¿Seguro que desea guardar los cambios del área <strong>{{ $nombre }}</strong>
            @else
                ¿Seguro que desea crear el área <strong>{{ $nombre }}</strong>
            @endif
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingSaveArea')" wire:loading.attr="disabled">
            {{ __('Cancelar') }}
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="store()" wire:loading.attr="disabled">
            {{ __('Guardar') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
