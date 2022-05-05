<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditModal">
    <x-slot name="title">
       {{$modo}} Participante
    </x-slot>
    <x-slot name="content">
        <form  id="courseForm">
            <!-- rfc y curp -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- rfc -->
                <div class="sm:flex-1">
                    <x-jet-label for="rfc" value="{{ __('RFC') }}" />
                    <x-input.error  wire:model="rfc" class="block mt-1 w-full" type="text" id="rfc" name="rfc" for="rfc" required/>
                    {{-- @error('rfc') <span class="text-red-500">{{ $message }}</span>@enderror --}}

                </div>
                <!-- curp -->
                <div class="sm:flex-1">
                    <x-jet-label for="curp" value="{{ __('CURP') }}" />
                    <x-input.error wire:model="curp" class="block mt-1 w-full" type="text" id="curp" name="curp" for="curp" required/>
                </div>
            </div>

            <!-- Nombre -->
            <div class="mt-4">
                <x-jet-label for="name" value="{{ __('Nombre') }}" />
                <x-input.error wire:model="name" class="block mt-1 w-full" type="text" id="name" name="name" for="name" required/>
            </div>

            <!-- Apellido_p y Apellido_m -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Apellido p -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="apellido_paterno" value="{{ __('Apellido Paterno') }}" />
                    <x-input.error wire:model="apellido_paterno" class="block mt-1 w-full" type="text" id="apellido_paterno" name="apellido_paterno" for="apellido_paterno" required/>
                </div>
                <!-- apellido_materno -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="apellido_materno" value="{{ __('Apellido Materno') }}" />
                    <x-input.error wire:model="apellido_materno" class="block mt-1 w-full" type="text" id="apellido_materno" name="apellido_materno" for="apellido_materno" required/>
                </div>
            </div>

            <!-- Sexo, Tipo y clave -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- sexo -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="sexo" value="{{ __('Sexo') }}" />
                    <x-input.select wire:model="sexo" class="mt-1 w-full" name="sexo" required >
                    <option value="">Selecciona el Sexo</option>
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                </x-input.select>
                <x-jet-input-error for="sexo"/>
                </div>
                <!-- Tipo -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="tipo" value="{{ __('Tipo') }}" />
                    <x-input.select wire:model="tipo" class="mt-1 w-full" name="tipo" required >
                    <option value="">Selecciona el Tipo</option>
                    <option value="Base">Base</option>
                    <option value="Interinato">Interinato</option>
                    <option value="Honorarios">Honorarios</option>
                     </x-input.select>
                    <x-jet-input-error for="tipo"/>
                </div>
                <!-- Clave -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="clave_presupuestal" value="{{ __('Clave Presupuestal') }}" />
                    <x-input.error wire:model="clave_presupuestal" class="block mt-1 w-full" type="text" id="clave_presupuestal" name="clave" for="clave_presupuestal" required/>
                </div>
            </div>

            <!-- Estudios Maximos -->
            <div class="mt-4">
                <x-jet-label for="estudio_maximo" value="{{ __('Estudios Maximos') }}" />
                <x-input.error wire:model="estudio_maximo" class="block mt-1 w-full" type="text" id="estudio_maximo" name="estudio_maximo" for="estudio_maximo" required/>
            </div>

             <!-- Carrera-->
            <div class="mt-4">
                <x-jet-label for="carrera" value="{{ __('Carrera') }}" />
                <x-input.error wire:model="carrera" class="block mt-1 w-full" type="text" id="carrera" name="carrera" for="carrera" required/>
            </div>

            <!-- Correo ITO y TECNM -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- correo_ito -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="email" value="{{ __('Correo extension ITO') }}" />
                    <x-input.error wire:model="email" class="block mt-1 w-full" type="text" id="email" name="email" for="email" required/>
                </div>
                <!-- correo_tecnm -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="correo_tecnm" value="{{ __('Correo extension TECNM') }}" />
                    <x-input.error wire:model="correo_tecnm" class="block mt-1 w-full" type="text" id="correo_tecnm" name="correo_tecnm" for="correo_tecnm" required/>
                </div>
            </div>

             <!-- PUESTO, HORA ENTRADA y HORA SALIDA -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- puesto -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="puesto" value="{{ __('Puesto') }}" />
                    <x-input.error wire:model="puesto" class="block mt-1 w-full" type="text" id="puesto" name="puesto" for="puesto" required/>
                </div>
                <!-- hora_entrada -->
                <div class="mt-4 sm:flex-2">
                    <x-jet-label for="Hora entrada" value="{{ __('Hora entrada') }}" />
                    <input type="time" id="hora_entrada" placeholder="hora_entrada" wire:model="hora_entrada">
                </div>
                <!-- hora_salida -->
                <div class="mt-4 sm:flex-2">
                    <x-jet-label for="hora_salida" value="{{ __('Hora salida') }}" />
                    <input type="time" id="hora_salida" placeholder="hora_salida" wire:model="hora_salida">
                </div>
            </div>

            <!-- Carrera -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label for="area_id" value="{{ __('Area de adscripción') }}" />
                <x-input.select wire:model="area_id" class="mt-1 w-full" name="area_id" required >
                    <option value="">Selecciona la Areas</option>
                            @foreach($areas as $i)
                                <option value="{{$i->id}}">{{$i->nombre}}</option>
                            @endforeach
                 </x-input.select>
                 <x-jet-input-error for="area_id"/>
            </div>

            <!-- Correo Organización_Origen y cuenta moodle -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- correo_ito -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="organizacion_origen" value="{{ __('Organizacion de origen') }}" />
                    <x-input.error wire:model="organizacion_origen" class="block mt-1 w-full" type="text" id="organizacion_origen" name="organizacion_origen" for="organizacion_origen" required/>
                </div>
                <!-- cuenta_moodle -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="cuenta_moodle" value="{{ __('Cuenta Moodle') }}" />
                    <x-input.select wire:model="cuenta_moodle" class="mt-1 w-full" name="cuenta_moodle" required >
                    <option value="">Selecciona el Sexo</option>
                    <option value="1">Tiene cuenta moodle</option>
                    <option value="0">No tiene cuenta moodle</option>
                </x-input.select>
                <x-jet-input-error for="cuenta_moodle"/>
                </div>
            </div>

        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEditModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent=" updateParti()" wire:loading.attr="disabled" form="courseForm">
            {{$modo}} Datos
        </x-jet-button>
        @if($confirmingSaveParti)
                @include('livewire.admin.participante.confirCreate')
        @endif
    </x-slot>
</x-jet-dialog-modal>
