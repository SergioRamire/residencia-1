<x-jet-dialog-modal wire:ignore.self wire:model.defer.defer="show_edit_create_modal">
    <x-slot name="title">
        {{ $edit ? 'Editar usuario' : 'Crear usuario' }}
    </x-slot>
    <x-slot name="content">
        <x-jet-label for="x" class="text-red-600" value="Los campos con * son obligatorios"/>

        <form wire:submit.prevent="confirm_save()" id="userForm">
            <!-- Nombre y Apellidos -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">

                <!-- Nombre -->
                <div class="sm:flex-1">
                    {{-- <x-jet-label for="nombre" value="Nombre"/> --}}
                    <x-jet-label for="nombre">Nombre <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model.defer="user.name" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="user.name" required/>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Apellido paterno -->
                <div class="mt-4 sm:mt-0 sm:flex-1">
                    <x-jet-label for="apellido_paterno">Apellido paterno <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model.defer="user.apellido_paterno" class="block mt-1 w-full" type="text" id="apellido_paterno" name="apellido_paterno" for="user.apellido_paterno"/>
                </div>

                <!-- Apellido materno -->
                <div class="mt-4 sm:mt-0 sm:flex-1">
                    <x-jet-label for="apellido_materno">Apellido materno <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model.defer="user.apellido_materno" class="block mt-1 w-full" type="text" id="apellido_materno" name="apellido_materno" for="user.apellido_materno"/>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <div class="sm:flex-1">
                    <label class="items-center m-2">
                        <input wire:model.defer="no_ap1" name="noape" value="1" id="noape" type="checkbox"  class="text-[#1b396a] bg-gray-100 border-gray-300 focus:ring-sky-700 focus:ring-2 ">
                        <span class="ml-2 text-sm font-medium text-gray-900 ">No Aplica</span>
                    </label>
                </div>
                <div class="sm:flex-1">
                    <label class="items-center m-2">
                        <input wire:model.defer="no_ap2" name="noape" value="1" id="noape" type="checkbox" class="text-[#1b396a] bg-gray-100 border-gray-300 focus:ring-sky-700 focus:ring-2">
                        <span class="ml-2 text-sm font-medium text-gray-900 ">No Aplica</span>
                    </label>
                </div>
            </div>

            <!-- Correo y rol -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Correo -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="email" >Correo <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model.defer="user.email" class="block mt-1 w-full" type="email" id="email" name="email" for="user.email" required/>
                </div>

                <!-- Rol -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="rol" >Rol <span class="text-red-600">*</span></x-jet-label>
                    <x-input.select wire:model.defer="role" id="rol" class="mt-1 w-full" name="rol">
                        <option value="" disabled>Selecciona rol...</option>
                        @foreach(\Spatie\Permission\Models\Role::all() as $role)
                            <option value="{{ $role->name }}">{{ ucwords($role->name) }}</option>
                        @endforeach
                    </x-input.select>
                </div>
            </div>

            <!-- Contraseñas -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Contraseña -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="contraseña" :value="$edit ? 'Contraseña nueva *'  : 'Contraseña *'"/>
                    <x-input.error wire:model="password_confirmation" class="block mt-1 w-full" type="password" id="contraseña" name="contraseña" for="password_confirmation"/>
                </div>

                <!-- Confirmación de contraseña -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="contraseña_confirmation" >Confirmación de contraseña <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model="password" class="block mt-1 w-full" type="password" id="contraseña_confirmation" name="contraseña_confirmation" for="password"/>
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('show_edit_create_modal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:loading.attr="disabled" form="userForm">
            {{ $edit ? 'Editar' : 'Crear' }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
