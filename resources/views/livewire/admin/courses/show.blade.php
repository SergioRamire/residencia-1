<x-jet-dialog-modal wire:ignore.self wire:model.defer="showViewModal">
    <x-slot name="title">
        Course: <strong>{{ $course->field }}</strong>
    </x-slot>
    <x-slot name="content">
        {{-- Recuerda omitir los 'id', 'name' y poner 'disabled' --}}
        <!-- Clave y Periodo -->
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
            <!-- Clave -->
            <div class="sm:flex-1">
                <x-jet-label value="Clave"/>
                <x-jet-input wire:model.defer="course.clave" class="block mt-1 w-full" type="text" disabled/>
            </div>
            <!-- Perfil -->
            <div class="sm:flex-1">
                <x-jet-label value="Perfil"/>
                <x-jet-input wire:model.defer="course.perfil" class="mt-1 w-full" type="text" disabled/>
            </div>
        </div>

        <!-- Nombre -->
        <div class="mt-4">
            <x-jet-label value="Nombre"/>
            <x-jet-input wire:model.defer="course.nombre" class="block mt-1 w-full" type="text" disabled/>
        </div>

        <!-- Objetivo -->
        <div class="mt-4">
            <x-jet-label value="Objetivo"/>
            <x-input.textarea wire:model.defer="course.objetivo" class="block mt-1 w-full" disabled/>
        </div>

        <!-- Duración y Modalidad -->
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
            <!-- Duración -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Duración"/>
                <x-input.addon wire:model.defer="course.duracion" right addon="hrs" class="block mt-1 w-full" type="number" disabled/>
            </div>
            <!-- Modalidad -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Modalidad"/>
                <x-jet-input wire:model.defer="course.modalidad" class="mt-1 w-full" type="text" disabled/>
            </div>
        </div>

        <!-- Dirigido -->
        <div class="mt-4">
            <x-jet-label value="Dirigido"/>
            <x-input.textarea wire:model.defer="course.dirigido" class="mt-1 w-full" disabled/>
        </div>

        <!-- Observaciones -->
        <div class="mt-4">
            <x-jet-label value="Observaciones"/>
            <x-input.textarea wire:model.defer="course.observaciones" class="block mt-1 w-full" disabled/>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-button wire:click="$toggle('showViewModal')" wire:loading.attr="disabled">
            Hecho
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
