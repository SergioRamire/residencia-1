<x-jet-dialog-modal wire:ignore.self wire:model.defer="modalEdit">
    <x-slot name="title">
        Editar fecha limite
    </x-slot>
    <x-slot name="content">

        <div class="col-start pr-1">
            <x-jet-label for="desde" value="Fecha límite para cargar calificaciones." class="text-lg" />
            <x-input.error wire:model="limite_fecha" class="block mt-1 w-full border-[#1b396a] text-[#1b396a] active:text-sky-50 active:bg-sky-500"
                type="date" id="fecha_limite" name="fecha_limite" for="fecha_limite" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modalEdit')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click="confirmar" wire:loading.attr="disabled" form="courseForm">
            Guardar
         </x-jet-button>
        @if($modalConfirmacion)
            @include('livewire.admin.limitForInstructors.confirmation')
        @endif
    </x-slot>
</x-jet-dialog-modal>
