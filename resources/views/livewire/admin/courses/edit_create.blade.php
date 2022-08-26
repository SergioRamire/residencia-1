<x-jet-dialog-modal wire:ignore.self wire:model="showEditCreateModal">
    <x-slot name="title">
        {{ $edit ? 'Editar curso' : 'Crear curso' }}
    </x-slot>
    <x-slot name="content">
        <x-jet-label for="x" class="text-red-600" value="Los campos con * son obligatorios" /><br>
        <form wire:submit.prevent="confirm_save()" id="courseForm">
            <!-- Clave y Periodo -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Clave -->
                <div class="sm:flex-1">
                    <x-jet-label for="clave">Clave <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="course.clave" class="block mt-1 w-full" type="text" id="clave" name="clave" for="course.clave" required/>
                </div>
                <!-- Perfil -->
                <div class="sm:flex-1">
                    <x-jet-label for="perfil">Perfil <span class="text-red-600">*</span></x-jet-label>
                    <x-input.select wire:model="course.perfil" id="perfil" class="mt-1 w-full" name="perfil" required>
                        <option value="" disabled>Selecciona perfil...</option>
                        <option value="Formación docente">Formación docente</option>
                        <option value="Actualización profesional">Actualización profesional</option>
                    </x-input.select>
                    <x-jet-input-error for="course.perfil"/>
                </div>
            </div>

            <!-- Nombre -->
            <div class="mt-4">
                <x-jet-label for="nombre">Nombre <span class="text-red-600">*</span></x-jet-label>
                <x-input.error wire:model="course.nombre" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="course.nombre" required/>
            </div>

            <!-- Objetivo -->
            <div class="mt-4">
                <x-jet-label for="objetivo">Objetivo <span class="text-red-600">*</span></x-jet-label>
                <x-input.textarea wire:model="course.objetivo" id="objetivo" class="block mt-1 w-full" name="objetivo" required/>
                <x-jet-input-error for="course.objetivo"/>
            </div>

            <!-- Duración-->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Duración -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="duracion">Duración <span class="text-red-600">*</span></x-jet-label>
                    <x-input.addon wire:model="course.duracion" right addon="hrs" class="block mt-1 w-full" type="number" id="duracion" name="duracion" required/>
                    <x-jet-input-error for="course.duracion"/>
                </div>
            </div>

            <!-- Dirigido -->
            <div class="mt-4">
                <x-jet-label for="dirigido">Dirigido <span class="text-red-600">*</span></x-jet-label>
                <x-input.select wire:model="course.dirigido" multiple id="dirigido" class="mt-1 w-full" name="dirigido" required>
                    @foreach(App\Models\Area::all() as $area)
                        <option value="{{ $area->nombre }}">{{ $area->nombre }}</option>
                    @endforeach
                </x-input.select>
                <x-jet-input-error for="course.dirigido"/>
            </div>

            <!-- Observaciones -->
            <div class="mt-4">
                <x-jet-label for="observaciones" value="Observaciones"/>
                <x-input.textarea wire:model="course.observaciones" id="observaciones" class="block mt-1 w-full" name="observaciones"/>
                <x-jet-input-error for="course.observaciones"/>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEditCreateModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:loading.attr="disabled" form="courseForm">
            {{ $edit ? 'Editar' : 'Crear' }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
