<x-jet-confirmation-modal wire:model="modal_confirmacion">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea cambiar a <strong class="text-red-500">{{ date('d-m-Y', strtotime($period->fecha_limite_para_calificar)) }}</strong> como fecha limite?
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modal_confirmacion')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="save" wire:loading.attr="disabled">
            Guardar
        </x-jet-danger-button>
        
    </x-slot>
</x-jet-confirmation-modal>
