<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditModal">
    <x-slot name="title">
        Editar user
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="confirmSave()" id="participantForm">
            <!-- RFC y CURP -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- RFC -->
                <div class="sm:flex-1">
                    <x-jet-label for="rfc" value="RFC"/>
                    <x-input.error wire:model="user.rfc" class="block mt-1 w-full" type="text" id="rfc" name="rfc" for="user.rfc" required/>
                </div>

                <!-- CURP -->
                <div class="sm:flex-1">
                    <x-jet-label for="curp" value="CURP"/>
                    <x-input.error wire:model="user.curp" class="block mt-1 w-full" type="text" id="curp" name="curp" for="user.curp" required/>
                </div>
            </div>

            <!-- Nombre -->
            <div class="mt-4">
                <x-jet-label for="nombre" value="Nombre"/>
                <x-input.error wire:model.defer="user.name" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="user.name" required/>
            </div>

            <!-- Apellidos -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Apellido paterno -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="apellido_paterno" value="Apellido paterno"/>
                    <x-input.error wire:model.defer="user.apellido_paterno" class="block mt-1 w-full" type="text" id="apellido_paterno" name="apellido_paterno" for="user.apellido_paterno"/>
                </div>

                <!-- Apellido materno -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="apellido_materno" value="Apellido materno"/>
                    <x-input.error wire:model.defer="user.apellido_materno" class="block mt-1 w-full" type="text" id="apellido_materno" name="apellido_materno" for="user.apellido_materno"/>
                </div>
            </div>

            <!-- Sexo, Tipo y Clave presupuestal -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Sexo -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="sexo" value="Sexo"/>
                    <x-input.select wire:model="user.sexo" class="mt-1 w-full" id="sexo" name="sexo" required>
                        <option value="" disabled>Selecciona el sexo</option>
                        <option value="F">Femenino</option>
                        <option value="M">Masculino</option>
                    </x-input.select>
                    <x-jet-input-error for="user.sexo"/>
                </div>

                <!-- Tipo -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="tipo" value="Tipo"/>
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
                    <x-jet-label for="clave_presupuestal" value="Clave presupuestal"/>
                    <x-input.error wire:model="user.clave_presupuestal" class="block mt-1 w-full" type="text" id="clave_presupuestal" name="clave" for="user.clave_presupuestal" required/>
                </div>
            </div>

            <!-- Estudios máximos -->
            <div class="mt-4">
                <x-jet-label for="estudio_maximo" value="Estudios máximos"/>
                <x-input.error wire:model.defer="user.estudio_maximo" class="block mt-1 w-full" type="text" id="estudio_maximo" name="estudio_maximo" for="user.estudio_maximo" required/>
            </div>

            <!-- Carrera-->
            <div class="mt-4">
                <x-jet-label for="carrera" value="Carrera"/>
                <x-input.error wire:model="user.carrera" class="block mt-1 w-full" type="text" id="carrera" name="carrera" for="user.carrera" required/>
            </div>

            <!-- Correo ITO y TECNM -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Correo ITO -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="email" value="Correo extension ITO"/>
                    <x-input.error wire:model="user.email" class="block mt-1 w-full" type="email" id="email" name="email" for="user.email" required/>
                </div>

                <!-- Correo TECNM -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="correo_tecnm" value="Correo extension TECNM"/>
                    <x-input.error wire:model="user.correo_tecnm" class="block mt-1 w-full" type="email" id="correo_tecnm" name="correo_tecnm" for="user.correo_tecnm" required/>
                </div>
            </div>

            <!-- Puesto, Hora entrada y Hora salida -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Puesto -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="puesto" value="Puesto"/>
                    <x-input.error wire:model="user.puesto_en_area" class="block mt-1 w-full" type="text" id="puesto" name="puesto" for="user.puesto" required/>
                </div>

                <!-- Hora entrada -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="hora_entrada" value="Hora entrada"/>
                    <x-jet-input wire:model="user.hora_entrada" class="block mt-1 w-full" type="time" id="hora_entrada" name="hora_entrada"/>
                    <x-jet-input-error for="user.hora_entrada"/>
                </div>

                <!-- Hora salida -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="hora_salida" value="Hora salida"/>
                    <x-jet-input wire:model="user.hora_salida" class="block mt-1 w-full" type="time" id="hora_salida" name="hora_salida"/>
                    <x-jet-input-error for="user.hora_salida"/>
                </div>
            </div>

            <!-- Area -->
            <div class="mt-4">
                <x-jet-label for="area" value="Área de adscripción"/>
                <x-input.select wire:model="user.area_id" class="mt-1 w-full" id="area_id" name="area_id" required>
                    <option value="" disabled>Selecciona el área</option>
                    @foreach(\App\Models\Area::all() as $area)
                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                    @endforeach
                </x-input.select>
            </div>

            <!-- Organización de origen y Cuenta moodle -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Organización de origen -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="organizacion_origen" value="Organización de origen"/>
                    <x-input.error wire:model="user.organizacion_origen" class="block mt-1 w-full" type="text" id="organizacion_origen" name="organizacion_origen" for="user.organizacion_origen" required/>
                </div>

                <!-- Cuenta moodle -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="cuenta_moodle" value="Cuenta moodle"/>
                    <x-input.select wire:model="user.cuenta_moodle" class="mt-1 w-full" id="cuenta_moodle" name="cuenta_moodle" required>
                        <option value="" disabled>Selecciona la opción</option>
                        <option value="1">Si tiene</option>
                        <option value="0">No tiene</option>
                    </x-input.select>
                    <x-jet-input-error for="user.cuenta_moodle"/>
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEditModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:loading.attr="disabled" form="participantForm">
            Editar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
