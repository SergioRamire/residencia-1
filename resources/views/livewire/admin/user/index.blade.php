<div>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto pt-5 pb-10 text-center bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col items-center">
                <img class="mb-3 w-24 h-24 rounded-full shadow-lg" src="{{ Auth::user()->profile_photo_url }} " alt="Bonnie image" />
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white" > 
                    {{ auth()->user()->name }}
                    {{ auth()->user()->apellido_paterno }}
                    {{ auth()->user()->apellido_materno }}
                </h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</span>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-5">
        <div class="space-y-2">
            <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 ">
                <h5 class="text-xl font-medium text-gray-800 ">Datos Personales</h5>
                <form id="courseForm">
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        {{-- Nombre --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="nombre" value="Nombre" />
                            <x-input.error wire:model.defer="user.name" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="user.name" required />
                        </div>
                        <!-- paterno -->
                        <div class="mt-4 flex-1">
                            <x-jet-label for="apellido_paterno" value="Apellido Paterno" />
                            <x-input.error wire:model.defer="user.apellido_paterno" class="block mt-1 w-full" type="text" id="apellido_paterno" name="apellido_paterno" for="user.apellido_paterno" required />
                        </div>
                        {{-- materno --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="apellido_materno" value="Apellido Materno" />
                            <x-input.error wire:model.defer="user.apellido_materno" class="block mt-1 w-full" type="text" id="apellido_materno" name="apellido_materno" for="user.apellido_materno" required />
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        <!-- rfc -->
                        <div class="mt-4 flex-1">
                            <x-jet-label for="rfc" value="RFC" />
                            <x-input.error wire:model.defer="user.rfc" class="block mt-1 w-full" type="text" id="rfc" name="rfc" for="user.rfc" required />
                        </div>
                        {{-- Curp --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="curp" value="CURP" />
                            <x-input.error wire:model.defer="user.curp" class="block mt-1 w-full" type="text" id="curp" name="curp" for="user.curp" required />
                        </div>
                        {{-- sexo --}}
                        <div>
                            <x-jet-label for="sexo" value="Sexo" />
                            <x-input.select wire:model.defer="user.sexo" id="sexo" class="mt-1 w-full" name="sexo" for="user.sexo" required>
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
                            <x-input.error wire:model.defer="user.email" class="block mt-1 w-full" type="email" id="email" name="email" for="user.email" required />
                        </div>
                        {{-- tecnm --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="correo_tecnm" value="Correo @oaxaca.tecnm.mx" />
                            <x-input.error wire:model.defer="user.correo_tecnm" class="block mt-1 w-full" type="email" id="correo_tecnm" name="correo_tecnm" for="user.correo_tecnm" required />
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        {{-- estudios maximos --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="estudio_maximo" value="Estudios Maximos" />
                            <x-input.error wire:model.defer="user.estudio_maximo" class="block mt-1 w-full" type="text" id="estudio_maximo" name="estudio_maximo" for="user.estudio_maximo" required />
                        </div>
                        {{-- carrera --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="carrera" value="Carrera" />
                            <x-input.error wire:model.defer="user.carrera" class="block mt-1 w-full" type="text" id="carrera" name="carrera" for="user.carrera" required />
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <x-jet-button wire:click="confirmSave()" type="button">
                            Guardar Cambios
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto pt-5 pb-5">
        <div class="space-y-2">
            <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 ">
                <h5 class="text-xl font-medium text-gray-800 ">Datos Laborales</h5>
                <form id="courseForm">
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        {{-- Nombre de area --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="areanombre" value="Nombre de Area" />
                                <x-jet-input :value="$user->area->nombre ?? ''" class="mt-1 w-full" type="text" disabled/>
                        </div>
                        {{-- clave_presupuestal --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="clave_presupuestal" value="Clave Presupuestal" />
                            <x-jet-input wire:model="user.clave_presupuestal" class="block mt-1 w-full" type="text" disabled/>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5"> 
                        {{-- jefe --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="jefe_inmediato" value="Nombre del Jefe inmediato" />
                            <x-jet-input wire:model="user.jefe_inmediato" class="block mt-1 w-full" type="text" disabled/>
                        </div>
                        {{-- telefono --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="telefono" value="Telefono" />
                            <x-jet-input wire:model="area.telefono" class="block mt-1 w-full" type="number" disabled/>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        <!-- puesto_en_area -->
                        <div class="mt-4 flex-1">
                            <x-jet-label for="puesto_en_area" value="Puesto en Area" />
                            <x-jet-input wire:model="user.puesto_en_area" class="block mt-1 w-full" type="text" disabled/>
                        </div>       
                        {{-- hora_entrada --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="hora_entrada" value="Hora de Entrada" />
                            <x-jet-input wire:model="user.hora_entrada" class="block mt-1 w-full" type="time" disabled/>
                        </div>
                        {{-- hora_salida --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="hora_salida" value="Hora de Salida" />
                            <x-jet-input wire:model="user.hora_entrada" class="block mt-1 w-full" type="time" disabled/>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        {{-- tipo --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="tipo" value="Tipo" />
                            <x-jet-input :value="$user->tipo ?? ''" class="mt-1 w-full" type="text" disabled/>
                        </div>
                        {{-- organizacion_origen --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="organizacion_origen" value="Organizacion de Origen" />
                            <x-jet-input wire:model="user.organizacion_origen" class="block mt-1 w-full" type="text" disabled/>
                        </div>
                        {{-- cuenta_moodle --}}
                        <div class="mt-4 flex-1">
                            <x-jet-label for="cuenta_moodle" value="Cuenta Moodle" />
                            <x-jet-input :value="$user->cuenta_moodle ? 'Tiene' : 'No Tiene'" class="mt-1 w-full" type="text" disabled/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('livewire.admin.user.confirmation')
</div>
