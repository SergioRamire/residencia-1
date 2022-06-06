<x-jet-dialog-modal wire:ignore.self wire:model.defer="showOneModal">
    <x-slot name="title">
        Ventana Emergente
        {{-- {{ $edit ? 'Editar curso' : 'Crear curso' }} --}}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="confirmSave()" id="courseForm">

            <h5 class="text-xl font-medium text-blue-600">Reinscripción del periodo Febrero - Junio 2022</h5>

            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">

                <div class="sm:flex-1">
                    <div>
                        <span>Horario de selección de materias:</span>
                    </div>
                    <div>
                        <span>11 de Febrero de 2022 a las 18:32 hrs.</span>
                    </div>
                </div>
                <div class="sm:flex-1">
                    <div>
                        <span>Datos del pago</span>
                    </div>
                    <div>
                        <span>Tu pago ya se encuentra registrado.</span>
                    </div>
                </div>
            </div>

        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showOneModal')" wire:loading.attr="disabled">
            Cerrar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:loading.attr="disabled" form="courseForm">
            Aceptar
            {{-- {{ $edit ? 'Editar' : 'Crear' }} --}}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
