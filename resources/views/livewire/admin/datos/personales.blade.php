<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Perfil de Usuario
        </h2>
    </x-slot>


    <div
        class="max-w-7xl mx-auto pt-5 pb-10 text-center bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col items-center">

            {{-- IMAGNE DE PERFIL --}}
            {{-- <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="/docs/images/people/profile-picture-3.jpg" alt="Bonnie image" /> --}}

            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">
                {{ auth()->user()->name }}
                {{ auth()->user()->apellido_materno }}
                {{ auth()->user()->apellido_paterno }}
            </h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</span>

        </div>
    </div>

    <div class="max-w-7xl mx-auto pt-5 pb-5">
        <div class="space-y-2">
            <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 ">
                <h5 class="text-xl font-medium text-gray-800 ">Datos Personales</h5>

                <form wire:submit.prevent="confirmSave()" id="courseForm">
                    
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        {{-- Nombre --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="nombre" value="Nombre" />
                            <x-input.error wire:model.defer="user.name" class="block mt-1 w-full" type="text"
                                id="nombre" name="nombre" for="nombre" required />
                        </div>
                        <!-- paterno -->
                        <div class="mt-4 flex-1">
                            <x-jet-label for="apellido_paterno" value="Apellido Paterno" />
                            <x-input.error wire:model.defer="user.apellido_paterno" class="block mt-1 w-full"
                                type="text" id="apellido_paterno" name="apellido_paterno" for="apellido_paterno"
                                required />
                        </div>
                        {{-- materno --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="apellido_materno" value="Apellido Materno" />
                            <x-input.error wire:model.defer="user.apellido_materno" class="block mt-1 w-full"
                                type="text" id="apellido_materno" name="apellido_materno" for="apellido_materno"
                                required />
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        <!-- rfc -->
                        <div class="mt-4 flex-1">
                            <x-jet-label for="rfc" value="RFC" />
                            <x-input.error wire:model.defer="user.rfc" class="block mt-1 w-full" type="text" id="rfc"
                                name="rfc" for="rfc" required />
                        </div>
                        {{-- Curp --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="curp" value="CURP" />
                            <x-input.error wire:model.defer="user.curp" class="block mt-1 w-full" type="text" id="curp"
                                name="curp" for="curp" required />
                        </div>
                        {{-- sexo --}}
                        <div>
                            <x-jet-label for="sexo" value="Sexo" />
                            <x-input.select wire:model.defer="user.sexo" id="sexo" class="mt-1 w-full" name="sexo"
                                required>
                                <option value="" disabled>Selecciona Sexo...</option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </x-input.select>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        {{-- ito --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="email" value="Correo @itoaxaca.edu.mx" />
                            <x-input.error wire:model.defer="user.email" class="block mt-1 w-full" type="email"
                                id="email" name="email" for="email" required />
                        </div>
                        {{-- tecnm --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="correo_tecnm" value="Correo @oaxaca.tecnm.mx" />
                            <x-input.error wire:model.defer="user.correo_tecnm" class="block mt-1 w-full" type="email"
                                id="correo_tecnm" name="correo_tecnm" for="correo_tecnm" required />
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        {{-- estudios maximos --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="estudio_maximo" value="Estudios Maximos" />
                            <x-input.error wire:model.defer="user.estudio_maximo" class="block mt-1 w-full" type="text"
                                id="estudio_maximo" name="estudio_maximo" for="estudio_maximo" required />
                        </div>

                        {{-- carrera --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="carrera" value="Carrera" />
                            <x-input.error wire:model.defer="user.carrera" class="block mt-1 w-full" type="text"
                                id="carrera" name="carrera" for="carrera" required />
                        </div>
                    </div>
                    <div class="flex flex-row-reverse">
                        <div class="mt-4 flex-1">
                            <x-jet-button class="ml-3" wire:click="save()" type="button">
                                Guardar Cambios
                            </x-jet-button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto pt-5 pb-5">
        <div class="space-y-2">
            <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 ">
                <h5 class="text-xl font-medium text-gray-800 ">Datos Laborales</h5>

                <form wire:submit.prevent="confirmSave()" id="courseForm">
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        {{-- Nombre de area --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="areanombre" value="Nombre de Area" />
                            
                                <x-input.select wire:model.defer="user.area_id" id="areanombre" class="mt-1 w-full" name="areanombre" required>
                                    @foreach(App\Models\Area::all() as $area)
                                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                    @endforeach
                                </x-input.select>
                        </div>
                        {{-- clave presupuestal --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="puesto" value="Clave Presupuestal" />
                            <x-input.error wire:model.defer="user.clave_presupuestal" class="block mt-1 w-full"
                                type="text" id="puesto" name="puesto" for="puesto" required />
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        <!-- puesto -->
                        <div class="mt-4 flex-1">
                            <x-jet-label for="puesto" value="Puesto" />
                            <x-input.error wire:model.defer="user.puesto" class="block mt-1 w-full" type="text"
                                id="puesto" name="puesto" for="puesto" required />
                        </div>
                        {{-- jefe --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="jefe" value="Nombre del Jefe inmediato" />
                            <x-input.error wire:model.defer="area.jefe" class="block mt-1 w-full" type="text" id="jefe" name="jefe" for="jefe" readonly />
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">

                        {{-- telefono --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="telefono" value="Telefono" />
                            <x-input.error wire:model.defer="area.telefono" class="block mt-1 w-full" type="number" id="telefono" name="telefono" for="telefono" readonly />
                        </div>
                        {{-- hora_entrada --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="hora_entrada" value="Hora de Entrada" />
                            <x-input.error wire:model.defer="user.hora_entrada" class="block mt-1 w-full" type="time" 
                                id="hora_entrada" name="hora_entrada" for="hora_entrada" required />
                        </div>
                        {{-- hora_salida --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="hora_salida" value="Hora de Salida" />
                            <x-input.error wire:model.defer="user.hora_salida" class="block mt-1 w-full" type="time" 
                                id="hora_salida" name="hora_salida" for="hora_salida" required />
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        {{-- tipo --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="tipo" value="Tipo" />
                            <x-input.select wire:model.defer="user.tipo" id="sexo" class="mt-1 w-full" name="sexo"
                                required>
                                <option value="" disabled>Selecciona Tipo...</option>
                                <option value="Base">Base</option>
                                <option value="Interinato">Interinato</option>
                                <option value="Contrato">Contrato</option>
                            </x-input.select>
                        </div>
                        {{-- organizacion_origen --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="organizacion_origen" value="Organizacion de Origen" />
                            <x-input.error wire:model.defer="user.organizacion_origen" class="block mt-1 w-full"
                                type="text" id="organizacion_origen" name="organizacion_origen"
                                for="organizacion_origen" required />
                        </div>
                        {{-- cuenta_moodle --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="cuenta_moodle" value="Cuenta Moodle" />
                            <x-input.select wire:model.defer="user.cuenta_moodle" id="cuenta_moodle"
                                class="mt-1 w-full" name="cuenta_moodle" required>
                                <option value="" disabled>Selecciona si Tiene Cuenta...</option>
                                <option value="0">No Tiene</option>
                                <option value="1">Si Tiene</option>
                            </x-input.select>
                        </div>
                    </div>
                    
                    <div class="flex flex-row-reverse">
                        <div class="mt-4 flex-1">
                            <x-jet-button class="ml-3" wire:click="save()" type="button">
                                Guardar Cambios
                            </x-jet-button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modales -->
    {{-- @include('livewire.admin.instructor.edit_create') --}}
    {{-- @include('livewire.admin.instructor.show') --}}
    {{-- @include('livewire.admin.instructor.confirmation') --}}
</div>
