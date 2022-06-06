<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Asignacion de Instructor
        </h2>
    </x-slot>

    <div class="space-y-2">
        <!-- Tabla -->
        <div class="flex flex-col space-y-2">
            <!-- Curso -->
            <div class="mt-4">
                <x-jet-label for="curso" value="Curso"/>
                <x-input.select wire:model.defer="curso" class="mt-1 w-full" id="curso" name="curso" required>
                    <option value="" >Selecciona un curso</option>
                    @foreach($datoscurso as $c)
                        <option value="{{ $c->id }}">{{ $c->nombre_curso }}</option>
                    @endforeach
                </x-input.select>
            </div>
            <!-- grupo -->
            <div class="mt-4">
                <x-jet-label for="grupo" value="Grupo"/>
                <x-input.select wire:model="grupo" class="mt-1 w-full" id="grupo" name="grupo" required>
                    <option value="" >Selecciona el Grupo</option>
                    @foreach($datosgrupo as $g)
                        <option value="{{ $g->id }}">{{ $g->nombre_grupo }}</option>
                    @endforeach
                </x-input.select>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- rfc -->
                <div class="mt-4 flex-1">
                    <x-jet-label for="lugar" value="lugar" />
                    <x-jet-input wire:model="lugar" class="block mt-1 w-full" type="text" disabled/>
                </div>
                
                <div class="mt-4 flex-1">
                    <x-jet-label for="horario1" value="Desde:" />
                    <x-jet-input wire:model="horario1" class="block mt-1 w-full" type="time" disabled/>
                </div>
                <div class="mt-4 flex-1">
                    <x-jet-label for="horario2" value="Hasta:" />
                    <x-jet-input wire:model="horario2" class="block mt-1 w-full" type="time" disabled/>
                </div>
            </div>
            <!-- INstructor -->
            <div class="mt-4">
                <x-jet-label for="instructor" value="Instructor"/>
                <x-input.select wire:model="instructor" class="mt-1 w-full" id="instructor" name="instructor" required>
                    <option value="">Selecciona el Instructor </option>
                    @foreach($datosuser as $u)
                        <option value="{{ $u->id }}">{{ $u->name }} {{ $u->rfc }} {{ $u->curp }}</option>
                    @endforeach
                </x-input.select>
            </div>
            <div class="mt-4 flex justify-end">
                <x-jet-button wire:click="" type="button">
                    Asignar Instructor
                </x-jet-button>
            </div>

        </div>
    </div>
</div>
