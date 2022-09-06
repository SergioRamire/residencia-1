<x-jet-dialog-modal wire:ignore.self wire:model.defer="show_edit_modal">
    <x-slot name="title">
        Editar Participante
    </x-slot>
    <x-slot name="content">
        <x-jet-label for="x" class="text-red-600" value="Los campos con * son obligatorios"/>
        <br>
        <form wire:submit.prevent="confirm_save()" id="participantForm">
            <!-- RFC y CURP -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- RFC -->
                <div class="sm:flex-1">
                    <x-jet-label for="rfc">RFC <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="user.rfc" class="block mt-1 w-full" type="text" id="rfc" name="rfc" for="user.rfc" required/>
                </div>

                <!-- CURP -->
                <div class="sm:flex-1">
                    <x-jet-label for="curp">CURP <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="user.curp" class="block mt-1 w-full" type="text" id="curp" name="curp" for="user.curp" required/>
                </div>
            </div>

            <!-- Nombre -->
            <div class="mt-4">
                <x-jet-label for="nombre">Nombre <span class="text-red-600">*</span></x-jet-label>
                <x-input.error wire:model="user.name" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="user.name" required/>
            </div>

            <!-- Apellidos -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Apellido paterno -->

                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="apellido_paterno">Apellido paterno <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="user.apellido_paterno" class="block mt-1 w-full" type="text" id="apellido_paterno" name="apellido_paterno" for="user.apellido_paterno"/>
                </div>

                <!-- Apellido materno -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="apellido_materno">Apellido materno <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="user.apellido_materno" class="block mt-1 w-full" type="text" id="apellido_materno" name="apellido_materno" for="user.apellido_materno"/>
                </div>

            </div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <div class="sm:flex-1">
                    <label class="items-center m-2">
                        <input wire:model="no_ap1" name="noape" value="1" id="noape" type="checkbox" class="text-[#1b396a] bg-gray-100 border-gray-300 focus:ring-sky-700 focus:ring-2 ">
                        <span class="ml-2 text-sm font-medium text-gray-900 ">No Aplica</span>
                    </label>
                </div>
                <div class="sm:flex-1">
                    <label class="items-center m-2">
                        <input wire:model="no_ap2" name="noape" value="1" id="noape" type="checkbox" class="text-[#1b396a] bg-gray-100 border-gray-300 focus:ring-sky-700 focus:ring-2">
                        <span class="ml-2 text-sm font-medium text-gray-900 ">No Aplica</span>
                    </label>
                </div>
            </div>

            <!-- Sexo, Tipo y Clave presupuestal -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Sexo -->
                <div class="mt-4">
                    <x-jet-label for="sexo">Género <span class="text-red-600">*</span></x-jet-label>
                    <x-input.select wire:model="user.sexo" class="mt-1 w-full" id="sexo" name="sexo" required>
                        <option value="" disabled>Selecciona el género</option>
                        <option value="F">Femenino</option>
                        <option value="M">Masculino</option>
                    </x-input.select>
                    <x-jet-input-error for="user.sexo"/>
                </div>

                <!-- Estudios máximos -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="estudio_maximo">Estudios máximos <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="user.estudio_maximo" class="block mt-1 w-full" type="text" id="estudio_maximo" name="estudio_maximo" for="user.estudio_maximo" required/>
                </div>
            </div>

            <!-- Organización de origen -->
            <div class="mt-4">
                <x-jet-label for="organizacion_origen">Organización de origen <span class="text-red-600">*</span></x-jet-label>
                <x-input.error wire:model="user.organizacion_origen" class="block mt-1 w-full" type="text" id="organizacion_origen" name="organizacion_origen" for="user.organizacion_origen" required/>
            </div>

            <!-- Correo ITO y TECNM -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Correo ITO -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="email">Correo extension ITO <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="user.email" class="block mt-1 w-full" type="email" id="email" name="email" for="user.email" required/>
                </div>

                <!-- Correo TECNM -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="correo_tecnm" value="Correo extension TECNM"/>
                    <x-input.error wire:model="user.correo_tecnm" class="block mt-1 w-full" type="email" id="correo_tecnm" name="correo_tecnm" for="user.correo_tecnm" required/>
                </div>
            </div>

            <!-- Cuenta moodle -->
            <div class="mt-4">
                <x-jet-label for="cuenta_moodle">Cuenta moodle <span class="text-red-600">*</span></x-jet-label>
                <x-input.select wire:model="user.cuenta_moodle" class="mt-1 w-full" id="cuenta_moodle" name="cuenta_moodle" required>
                    <option value="" disabled>Selecciona la opción</option>
                    <option value="1">Tiene</option>
                    <option value="0">No tiene</option>
                </x-input.select>
                <x-jet-input-error for="user.cuenta_moodle"/>
            </div>

            <!-- Carrera-->
            <div class="mt-4">
                <x-jet-label for="carrera">Carrera <span class="text-red-600">*</span></x-jet-label>
                <x-input.error wire:model="user.carrera" class="block mt-1 w-full" type="text" id="carrera" name="carrera" for="user.carrera" required/>
            </div>

            <!-- Tipo y Clave-->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Tipo -->
                <div class="mt-4">
                    <x-jet-label for="tipo">Tipo <span class="text-red-600">*</span></x-jet-label>
                    <x-input.select wire:model="user.tipo" class="mt-1 w-full" id="tipo" name="tipo" required>
                        <option value="" disabled>Selecciona el tipo</option>
                        <option value="Base">Base</option>
                        <option value="Interinato">Interinato</option>
                        <option value="Honorarios">Honorarios</option>
                    </x-input.select>
                    <x-jet-input-error for="user.tipo"/>
                </div>

                <!-- Clave -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="clave_presupuestal">Clave presupuestal <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="user.clave_presupuestal" class="block mt-1 w-full" type="text" id="clave_presupuestal" name="clave" for="user.clave_presupuestal" required/>
                </div>
            </div>

            <!-- Area -->
            <div class="mt-4">
                <x-jet-label for="area" value="Área de adscripción"/>
                <x-input.select wire:model="user.area_id" class="mt-1 w-full" id="area_id" name="area_id" required>
                    <option value="" disabled>Selecciona el área</option>
                    @foreach(\App\Models\Area::where('estatus','1')->get() as $area)
                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                    @endforeach
                </x-input.select>
                <x-jet-input-error for="user.area_id"/>
            </div>

            <!-- Jefe Inmediato -->
            <div class="mt-4">
                <x-jet-label for="jefe">Jefe Inmediato <span class="text-red-600">*</span></x-jet-label>
                <x-input.error wire:model="user.jefe_inmediato" class="block mt-1 w-full" type="text" id="jefe" name="jefe" for="user.jefe_inmediato" required/>
            </div>

            <!-- Puesto, Hora entrada y Hora salida -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Puesto -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="puesto">Puesto <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="user.puesto_en_area" class="block mt-1 w-full" type="text" id="puesto" name="puesto" for="user.puesto" required/>
                </div>

                <!-- Hora entrada -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="hora_entrada">Hora entrada <span class="text-red-600">*</span></x-jet-label>
                    <x-datepicker wire:model="user.hora_entrada" class="block mt-1 w-full" ref="hora_entrada" name="hora_entrada"
                                  :config="['enableTime' => true, 'noCalendar' => true, 'dateFormat' => 'H:i', 'time_24hr' => true]"/>
                    <x-jet-input-error for="user.hora_entrada"/>
                </div>

                <!-- Hora salida -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="hora_salida">Hora salida <span class="text-red-600">*</span></x-jet-label>
                    <x-datepicker wire:model="user.hora_salida" class="block mt-1 w-full" ref="hora_salida" name="hora_salida"
                                  :config="['enableTime' => true, 'noCalendar' => true, 'dateFormat' => 'H:i', 'time_24hr' => true]"/>
                    <x-jet-input-error for="user.hora_salida"/>
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('show_edit_modal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:loading.attr="disabled" form="participantForm">
            Editar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
