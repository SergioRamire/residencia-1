<div>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto pt-5 pb-10 text-center bg-orange-300 border-[#1b396a] rounded-lg border shadow-md sm:p-8">
            <div class="flex flex-col items-center">
                <img class="mb-3 w-h-28 h-28 rounded-full shadow-lg" src="{{ Auth::user()->profile_photo_url }} " alt="Bonnie image" />
                <h5 class="mb-1 text-2xl font-medium text-gray-900" >
                    {{ auth()->user()->name }}
                    {{ auth()->user()->apellido_paterno }}
                    {{ auth()->user()->apellido_materno }}
                </h5>
                <span class="text-xl text-black">{{ auth()->user()->email }}</span>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-5">
        <div class="space-y-2">
            <div class="p-4 bg-blue-100 rounded-lg border border-[#1b396a] shadow-md sm:p-6 lg:p-8 ">
                <h5 class="text-xl font-medium text-gray-800 ">Datos Personales</h5> 

                <form id="courseForm">
                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">

                        {{-- Nombre --}}
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dt class="text-base font-bold text-gray-900">Nombre: </dt>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->name}}</dd>
                            </div>
                        </div>

                       <!-- paterno -->
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dt class="text-base font-bold text-gray-900">Apellido Paterno: </dt>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->apellido_paterno}}</dd>
                            </div>
                        </div>
                        {{-- materno --}}
                        <div class="mt-4 flex-1">
                            <div class=" bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dt class="text-base font-bold text-gray-900">Apellido Materno: </dt>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->apellido_materno}}</dd>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        <!-- rfc -->
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dt class="text-base font-bold text-gray-900">RFC: </dt>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->rfc}}</dd>
                            </div>
                        </div>
                        {{-- Curp --}}
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dt class="text-base font-bold text-gray-900">CURP: </dt>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->curp}}</dd>
                            </div>
                        </div>
                        {{-- Género --}}
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dt class="text-base font-bold text-gray-900">Género: </dt>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2">
                                    @if ($user->sexo == 'F')
                                        Femenino
                                    @endif
                                    @if ($user->sexo == 'M')
                                        Masculino
                                    @endif
                                </dd>
                              </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        {{-- ito --}}
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dt class="text-base font-bold text-gray-900">Correo @itoaxaca.edu.mx: </dt>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->email}}</dd>
                            </div>
                        </div>
                        {{-- tecnm --}}
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dt class="text-base font-bold text-gray-900">Correo @oaxaca.tecnm.mx: </dt>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->correo_tecnm}}</dd>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                        {{-- estudios maximos --}}
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dt class="text-base font-bold text-gray-900">Estudios Maximos: </dt>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->estudio_maximo}}</dd>
                            </div>
                        </div>
                        {{-- carrera --}}
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dt class="text-base font-bold text-gray-900">Carrera: </dt>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->carrera}}</dd>
                            </div>
                        </div>
                    </div>

                    <div class="my-4 flex justify-end">
                        @if ($vali)
                            <p class="rounded-md text-lg text-red-700 pr-4">Recuerde reller su informacion faltante.</p>
                        @endif
                        <x-jet-button wire:click="editInfo()" type="button" class="bg-[#1b396a]">
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
                <div class="p-4 bg-blue-100 rounded-lg border border-[#1b396a] shadow-md sm:p-6 lg:p-8 ">
                    <h5 class="text-xl font-medium text-black-800 ">Datos Laborales</h5>
                    <form id="courseForm">
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                            {{-- Nombre de area --}}
                            <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                    <dt class="text-base font-bold text-gray-900">Nombre de Área: </dt>
                                    <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->area->nombre ?? ''}}</dd>
                                </div>
                            </div>
                            {{-- clave_presupuestal --}}
                            <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                    <dt class="text-base font-bold text-gray-900">Clave Presupuestal: </dt>
                                    <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->clave_presupuestal}}</dd>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                            {{-- jefe --}}
                            <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                    <dt class="text-base font-bold text-gray-900">Nombre del jefe inmediato: </dt>
                                    <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->jefe_inmediato}}</dd>
                                </div>
                            </div>
                            {{-- telefono --}}
                            <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                    <dt class="text-base font-bold text-gray-900">Teléfono: </dt>
                                    <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$area->telefono}}</dd>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                            <!-- puesto_en_area -->
                            <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                    <dt class="text-base font-bold text-gray-900">Puesto en Área: </dt>
                                    <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->puesto_en_area}}</dd>
                                </div>
                            </div>
                            {{-- hora_entrada --}}
                            <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                    <dt class="text-base font-bold text-gray-900">Hora de Entrada: </dt>
                                    <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{ date("H:i", strtotime($user->hora_entrada)) }} hrs.</dd>
                                </div>
                            </div>
                            {{-- hora_salida --}}
                            <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                    <dt class="text-base font-bold text-gray-900">Hora de Salida: </dt>
                                    <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{ date("H:i", strtotime($user->hora_salida)) }} hrs.</dd>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                            {{-- tipo --}}
                            <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                    <dt class="text-base font-bold text-gray-900">Tipo: </dt>
                                    <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->tipo ?? ''}}</dd>
                                </div>
                            </div>
                            {{-- organizacion_origen --}}
                            <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                    <dt class="text-base font-bold text-gray-900">Organización origen: </dt>
                                    <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->organizacion_origen}}</dd>
                                </div>
                            </div>
                            {{-- cuenta_moodle --}}
                            <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                    <dt class="text-base font-bold text-gray-900">Cuenta Moodle: </dt>
                                    <dd class="text-lg font-medium text-gray-900 lg:col-span-2">{{$user->cuenta_moodle ? 'Tiene' : 'No Tiene'}}</dd>
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
