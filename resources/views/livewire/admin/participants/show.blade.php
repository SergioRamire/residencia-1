<x-jet-dialog-modal wire:ignore.self wire:model.defer="showViewModal">
    <x-slot name="title">
        Participante: <strong>{{ $user->name }}</strong>
    </x-slot>
    <x-slot name="content">
        <!-- RFC y CURP -->
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
            <!-- RFC -->
            <div class="sm:flex-1">
                <x-jet-label value="RFC"/>
                <x-jet-input wire:model="user.rfc" class="block mt-1 w-full" type="text" disabled/>
            </div>

            <!-- CURP -->
            <div class="sm:flex-1">
                <x-jet-label value="CURP"/>
                <x-jet-input wire:model="user.curp" class="block mt-1 w-full" type="text" disabled/>
            </div>
        </div>

        <!-- Nombre -->
        <div class="mt-4">
            <x-jet-label value="Nombre"/>
            <x-jet-input wire:model.defer="user.name" class="block mt-1 w-full" type="text" disabled/>
        </div>

        <!-- Apellidos -->
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
            <!-- Apellido paterno -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Apellido paterno"/>
                <x-jet-input wire:model.defer="user.apellido_paterno" class="block mt-1 w-full" type="text" disabled/>
            </div>

            <!-- Apellido materno -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Apellido materno"/>
                <x-jet-input wire:model.defer="user.apellido_materno" class="block mt-1 w-full" type="text" disabled/>
            </div>
        </div>

        <!-- Sexo, Tipo y Clave presupuestal -->
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
            <!-- Sexo -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Sexo"/>
                <x-jet-input :value="$user->sexo === 'F' ? 'Femenino' : 'Masculino'" class="mt-1 w-full" type="text" disabled/>
            </div>

            <!-- Tipo -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Tipo"/>
                <x-jet-input wire:model="user.tipo" class="mt-1 w-full" type="text" disabled/>
            </div>

            <!-- Clave -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Clave presupuestal"/>
                <x-jet-input wire:model="user.clave_presupuestal" class="block mt-1 w-full" type="text" disabled/>
            </div>
        </div>

        <!-- Estudios máximos -->
        <div class="mt-4">
            <x-jet-label value="Estudios máximos"/>
            <x-jet-input wire:model.defer="user.estudio_maximo" class="block mt-1 w-full" type="text" disabled/>
        </div>

        <!-- Carrera-->
        <div class="mt-4">
            <x-jet-label value="Carrera"/>
            <x-jet-input wire:model="user.carrera" class="block mt-1 w-full" type="text" disabled/>
        </div>

        <!-- Correo ITO y TECNM -->
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
            <!-- Correo ITO -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Correo extension ITO"/>
                <x-jet-input wire:model="user.email" class="block mt-1 w-full" type="email" disabled/>
            </div>

            <!-- Correo TECNM -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Correo extension TECNM"/>
                <x-jet-input wire:model="user.correo_tecnm" class="block mt-1 w-full" type="email" disabled/>
            </div>
        </div>

        <!-- Puesto, Hora entrada y Hora salida -->
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
            <!-- Puesto -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Puesto"/>
                <x-jet-input wire:model="user.puesto_en_area" class="block mt-1 w-full" type="text" disabled/>
            </div>

            <!-- Hora entrada -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Hora entrada"/>
                <x-jet-input wire:model="user.hora_entrada" class="block mt-1 w-full" type="time"/>
            </div>

            <!-- Hora salida -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Hora salida"/>
                <x-jet-input wire:model="user.hora_salida" class="block mt-1 w-full" type="time"/>
            </div>
        </div>

        <!-- Area -->
        <div class="mt-4">
            <x-jet-label value="Área de adscripción"/>
            <x-jet-input :value="$user->area->nombre ?? ''" class="mt-1 w-full" type="text" disabled/>
        </div>

        <!-- Organización de origen y Cuenta moodle -->
        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
            <!-- Organización de origen -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Organización de origen"/>
                <x-jet-input wire:model="user.organizacion_origen" class="block mt-1 w-full" type="text" disabled/>
            </div>

            <!-- Cuenta moodle -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label value="Cuenta moodle"/>
                <x-jet-input :value="$user->cuenta_moodle ? 'Si tiene' : 'No tiene'" class="mt-1 w-full" type="text" disabled/>
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-button wire:click="$toggle('showViewModal')" wire:loading.attr="disabled" >
            Hecho
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
