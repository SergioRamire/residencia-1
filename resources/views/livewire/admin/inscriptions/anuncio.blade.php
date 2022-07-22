<x-jet-dialog-modal wire:ignore.self wire:model.defer="showOneModal">
    <x-slot name="title">
        AVISO
    </x-slot>
    <x-slot name="content">

            <h5 class="text-xl font-medium text-blue-600"></h5>
                <div class="m-4">
                    <div class="p-2 bg-white rounded-lg border border-gray-200 shadow-md sm:p-3 lg:p-4 ">
                        <p class="text-justify"><strong>Recuerde que,</strong> para aprobar y obtener la constancia de acreditación por curso debes de, cumplir con el <strong>mínimo de asistencias</strong>
                            y tener una <strong>calificación mayor o igual a 70.</strong></p>
                    </div>
                </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showOneModal')" wire:loading.attr="disabled">
            Cerrar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click="open_confir()" wire:loading.attr="disabled">
            Aceptar
        </x-jet-button>
        @include('livewire.admin.inscriptions.confirmation')
    </x-slot>
</x-jet-dialog-modal>
