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
                            {{-- <x-jet-label for="nombre" value="Nombre" />
                            <x-jet-input wire:model="user.name" class="block mt-1 w-full" type="text" disabled/> --}}
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->name}}</dd>
                            </div>
                        </div>
                        <!-- paterno -->
                        <div class="mt-4 flex-1">
                            {{-- <x-jet-label for="apellido_paterno" value="Apellido Paterno" />
                            <x-jet-input wire:model="user.apellido_paterno" class="block mt-1 w-full" type="text" disabled/> --}}
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Apellido Paterno</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->apellido_paterno}}</dd>
                            </div>
                        </div>
                        {{-- materno --}}
                        <div class="mt-4 flex-1">
                            {{-- <x-jet-label for="apellido_materno" value="Apellido Materno" />
                            <x-jet-input wire:model="user.apellido_materno" class="block mt-1 w-full" type="text" disabled/> --}}
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Apellido Materno</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->apellido_materno}}</dd>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        <!-- rfc -->
                        <div class="mt-4 flex-1">
                            {{-- <x-jet-label for="rfc" value="RFC" />
                            <x-jet-input wire:model="user.rfc" class="block mt-1 w-full" type="text" disabled/> --}}
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">RFC</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->rfc}}</dd>
                            </div>
                        </div>
                        {{-- Curp --}}
                        <div class="mt-4 flex-1">
                            {{-- <x-jet-label for="curp" value="CURP" />
                            <x-jet-input wire:model="user.curp" class="block mt-1 w-full" type="text" disabled/> --}}
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">CURP</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->curp}}</dd>
                            </div>
                        </div>
                        {{-- sexo --}}
                        <div>
                            {{-- <x-jet-label for="sexo" value="Sexo" />
                            <x-input.select wire:model.defer="user.sexo" id="sexo" class="mt-1 w-full" name="sexo" for="user.sexo" required>
                                <option value="" disabled>Selecciona Sexo...</option>
                                <option value="M" disabled>Masculino</option>
                                <option value="F" disabled>Femenino</option>
                            </x-input.select> --}}
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Sexo</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    @if ($user->sexo == 'F')
                                    Femenino
                                    @endif
                                    @if ($user->sexo == 'M')
                                    Masculino
                                    @endif
                                    {{-- {{$user->sexo}} --}}
                                </dd>
                              </div>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        {{-- ito --}}
                        <div class="mt-4 flex-1">
                            {{-- <x-jet-label for="email" value="Correo @itoaxaca.edu.mx" />
                            <x-jet-input wire:model="user.email" class="block mt-1 w-full" type="text" disabled/> --}}
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Correo @itoaxaca.edu.mx</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->email}}</dd>
                            </div>
                        </div>
                        {{-- tecnm --}}
                        <div class="mt-4 flex-1">
                            {{-- <x-jet-label for="correo_tecnm" value="Correo @oaxaca.tecnm.mx" />
                            <x-jet-input wire:model="user.correo_tecnm" class="block mt-1 w-full" type="text" disabled/> --}}
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Correo @oaxaca.tecnm.mx</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->correo_tecnm}}</dd>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        {{-- estudios maximos --}}
                        <div class="mt-4 flex-1">
                            {{-- <x-jet-label for="estudio_maximo" value="Estudios Maximos" />
                            <x-jet-input wire:model="user.estudio_maximo" class="block mt-1 w-full" type="text" disabled/> --}}
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Estudios Maximos</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->estudio_maximo}}</dd>
                            </div>
                        </div>
                        {{-- carrera --}}
                        <div class="mt-4 flex-1">
                            {{-- <x-jet-label for="carrera" value="Carrera" />
                            <x-jet-input wire:model="user.carrera" class="block mt-1 w-full" type="text" disabled/> --}}
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Carrera</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->carrera}}</dd>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex justify-end">
                        <x-jet-button wire:click="editInfo()" type="button">
                            Editar Informacion
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @if (!is_null($user->area))
        <div class="max-w-7xl mx-auto pt-5 pb-5">
            <div class="space-y-2">
                <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 ">
                    <h5 class="text-xl font-medium text-gray-800 ">Datos Laborales</h5>
                    <form id="courseForm">
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                            {{-- Nombre de area --}}
                            <div class="mt-4 flex-1">
                                {{-- <x-jet-label for="areanombre" value="Nombre de Area" />
                                <x-jet-input :value="$user->area->nombre ?? ''" class="mt-1 w-full" type="text" disabled/> --}}
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Nombre de Area</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->area->nombre ?? ''}}</dd>
                                </div>
                            </div>
                            {{-- clave_presupuestal --}}
                            <div class="mt-4 flex-1">
                                {{-- <x-jet-label for="clave_presupuestal" value="Clave Presupuestal" />
                                <x-jet-input wire:model="user.clave_presupuestal" class="block mt-1 w-full" type="text" disabled/> --}}
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Clave Presupuestal</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->clave_presupuestal}}</dd>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5"> 
                            {{-- jefe --}}
                            <div class="mt-4 flex-1">
                                {{-- <x-jet-label for="jefe_inmediato" value="Nombre del Jefe inmediato" />
                                <x-jet-input wire:model="user.jefe_inmediato" class="block mt-1 w-full" type="text" disabled/> --}}
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Nombre del Jefe inmediato</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->jefe_inmediato}}</dd>
                                </div>
                            </div>
                            {{-- telefono --}}
                            <div class="mt-4 flex-1">
                                {{-- <x-jet-label for="telefono" value="Telefono" />
                                <x-jet-input wire:model="area.telefono" class="block mt-1 w-full" type="number" disabled/> --}}
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Telefono</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$area->telefono}}</dd>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                            <!-- puesto_en_area -->
                            <div class="mt-4 flex-1">
                                {{-- <x-jet-label for="puesto_en_area" value="Puesto en Area" />
                                <x-jet-input wire:model="user.puesto_en_area" class="block mt-1 w-full" type="text" disabled/> --}}
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Puesto en Area</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->puesto_en_area}}</dd>
                                </div>
                            </div>       
                            {{-- hora_entrada --}}
                            <div class="mt-4 flex-1">
                                {{-- <x-jet-label for="hora_entrada" value="Hora de Entrada" />
                                <x-jet-input wire:model="user.hora_entrada" class="block mt-1 w-full" type="time" disabled/> --}}
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Hora de Entrada</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->hora_entrada}}</dd>
                                </div>
                            </div>
                            {{-- hora_salida --}}
                            <div class="mt-4 flex-1">
                                {{-- <x-jet-label for="hora_salida" value="Hora de Salida" />
                                <x-jet-input wire:model="user.hora_entrada" class="block mt-1 w-full" type="time" disabled/> --}}
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Hora de Salida</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->hora_entrada}}</dd>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                            {{-- tipo --}}
                            <div class="mt-4 flex-1">
                                {{-- <x-jet-label for="tipo" value="Tipo" />
                                <x-jet-input :value="$user->tipo ?? ''" class="mt-1 w-full" type="text" disabled/> --}}
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Tipo</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->tipo ?? ''}}</dd>
                                </div>
                            </div>
                            {{-- organizacion_origen --}}
                            <div class="mt-4 flex-1">
                                {{-- <x-jet-label for="organizacion_origen" value="Organizacion de Origen" />
                                <x-jet-input wire:model="user.organizacion_origen" class="block mt-1 w-full" type="text" disabled/> --}}
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Organizacion de Origen</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->organizacion_origen}}</dd>
                                </div>
                            </div>
                            {{-- cuenta_moodle --}}
                            <div class="mt-4 flex-1">
                                {{-- <x-jet-label for="cuenta_moodle" value="Cuenta Moodle" />
                                <x-jet-input :value="$user->cuenta_moodle ? 'Tiene' : 'No Tiene'" class="mt-1 w-full" type="text" disabled/> --}}
                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">Cuenta Moodle</dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{$user->cuenta_moodle ? 'Tiene' : 'No Tiene'}}</dd>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @include('livewire.admin.users.profileConfirmation')
    @include('livewire.admin.users.profileEdit')
</div>
