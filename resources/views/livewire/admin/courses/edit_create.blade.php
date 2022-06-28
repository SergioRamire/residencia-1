<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditCreateModal">
    <x-slot name="title">
        {{ $edit ? 'Editar curso' : 'Crear curso' }}
    </x-slot>
    <x-slot name="content">
        <x-jet-label for="x"  value="{{_('Los campos con * son obligatorios')}}" />
        <form wire:submit.prevent="confirmSave()" id="courseForm">
            <!-- Clave y Periodo -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Clave -->
                <div class="sm:flex-1">
                    <x-jet-label for="clave" value="Clave*"/>
                    <x-input.error wire:model.defer="course.clave" class="block mt-1 w-full" type="text" id="clave" name="clave" for="course.clave" required/>
                </div>
                <!-- Perfil -->
                <div class="sm:flex-1">
                    <x-jet-label for="perfil" value="Perfil*"/>
                    <x-input.select wire:model.defer="course.perfil" id="perfil" class="mt-1 w-full" name="perfil" required>
                        <option value="" disabled>Selecciona perfil...</option>
                        <option value="Formación docente">Formación docente</option>
                        <option value="Actualización profesional">Actualización profesional</option>
                    </x-input.select>
                    <x-jet-input-error for="course.perfil"/>
                </div>
            </div>

            <!-- Nombre -->
            <div class="mt-4">
                <x-jet-label for="nombre" value="Nombre*"/>
                <x-input.error wire:model.defer="course.nombre" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="course.nombre" required/>
            </div>

            <!-- Objetivo -->
            <div class="mt-4">
                <x-jet-label for="objetivo" value="Objetivo*"/>
                <x-input.textarea wire:model.defer="course.objetivo" id="objetivo" class="block mt-1 w-full" name="objetivo" required/>
                <x-jet-input-error for="course.objetivo"/>
            </div>

            <!-- Duración y Modalidad -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Duración -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="duracion" value="Duración*"/>
                    <x-input.addon wire:model.defer="course.duracion" right addon="hrs" class="block mt-1 w-full" type="number" id="duracion" name="duracion" required/>
                    <x-jet-input-error for="course.duracion"/>
                </div>
                {{-- <!-- Modalidad -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="modalidad" value="Modalidad"/>
                    <x-input.select wire:model.defer="course.modalidad" id="modalidad" class="mt-1 w-full" name="modalidad" required>
                        <option value="" disabled>Selecciona modalidad...</option>
                        <option value="Presencial" selected>Presencial</option>
                        <option value="Semi-presencial">Semi-presencial</option>
                        <option value="En linea">En linea</option>
                    </x-input.select>
                    <x-jet-input-error for="course.modalidad"/>
                </div> --}}
            </div>

            <!-- Dirigido -->
            <div class="mt-4">
                <x-jet-label for="dirigido" value="Dirigido*"/>
                <x-input.select wire:model.defer="course.dirigido" multiple id="dirigido" class="mt-1 w-full" name="dirigido" required>
                    @foreach(App\Models\Area::all() as $area)
                        <option value="{{ $area->nombre }}">{{ $area->nombre }}</option>
                    @endforeach
                </x-input.select>
                <x-jet-input-error for="course.dirigido"/>
            </div>

            <!-- Observaciones -->
            <div class="mt-4">
                <x-jet-label for="observaciones" value="Observaciones"/>
                <x-input.textarea wire:model.defer="course.observaciones" id="observaciones" class="block mt-1 w-full" name="observaciones"/>
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
