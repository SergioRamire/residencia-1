{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="confirmingSavePeriod">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea guardar cambios del periodo de  <strong> {{ date('d-m-Y', strtotime($p->fecha_inicio)) }} a {{ date('d-m-Y', strtotime($p->fecha_fin)) }}</strong>?
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingSavePeriod')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="store" wire:loading.attr="disabled">
            Guardar
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
