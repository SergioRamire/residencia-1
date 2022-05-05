<x-jet-dialog-modal wire:model="isOpen">
    <x-slot name="title">
        Actualizar Calificación
    </x-slot>
    <x-slot name="content">
        <form  id="courseForm">
                <!-- Curso -->
                <div class="mt-4">
                    <x-jet-label for="curso" value="Curso" />
                    <x-input.error readonly  wire:model="curso" class="block mt-1 w-full" type="text" id="curso" name="curso" for="curso"/>
                </div>
                <!-- Grupo -->
                {{-- <div class="mt-4">
                    <x-jet-label for="grupo" value="Grupo" />
                    <x-input.error readonly  wire:model="grupo" class="block mt-1 w-full" type="text" id="grupo" name="grupo" for="grupo"/>
                </div> --}}
                <!-- Participante -->
                <div class="mt-4">
                    <x-jet-label for="nombre" value="Participante" />
                    <x-input.error readonly wire:model="participante" class="block mt-1 w-full" type="text" id="participante" name="participante" for="participante" />
                </div>

                <!-- Calificación -->
                <div class="mt-4">
                    <x-jet-label for="calificacion" value="Calificación" />
                    <x-input.error wire:model.defer="calificacion" class="block mt-1 w-full" type="number" id="calificacion" name="calificacion" for="calificacion" required/>
                </div>

                </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('isOpen')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button wire:click.prevent="updateGrade()" class="ml-3"  wire:loading.attr="disabled" form="courseForm">
           Actualizar Calificación
        </x-jet-button>
        @if($confirmingSaveGrade)
                    @include('livewire.admin.grades.confirmation')
        @endif
    </x-slot>
</x-jet-dialog-modal>
