{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="confirmingSaveInscription">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        ¿Está seguro de su elección?
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmingSaveInscription')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        {{-- <form method="get" action="{{ route('participant.studying') }}">
            <div class="flex items-center justify-center">
                <x-jet-button wire:click="store()" class="ml-4">
                    Generar Inscripcion
                </x-jet-button>
            </div>
        </form> --}}

        <x-jet-danger-button class="ml-3" wire:click="alter"  wire:loading.attr="disabled">
             Generar Inscripcion
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
