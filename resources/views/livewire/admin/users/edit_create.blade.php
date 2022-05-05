<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditCreateModal">
    <x-slot name="title">
        {{ $edit ? 'Editar usuario' : 'Crear usuario' }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="confirmSave()" id="userForm">
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <div class="sm:flex-1">
                    <!-- Nombre -->
                    <x-jet-label for="nombre" value="Nombre"/>
                    <x-input.error wire:model.defer="user.name" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="user.name" required/>
                </div>
                <div class="sm:flex-1">
                    <!-- Apellido paterno -->
                    <x-jet-label for="apellido_paterno" value="Apellido paterno"/>
                    <x-input.error wire:model.defer="user.apellido_paterno" class="block mt-1 w-full" type="text" id="apellido_paterno" name="apellido_paterno" for="user.apellido_paterno"/>
                </div>
                <div class="sm:flex-1">
                    <!-- Apellido materno -->
                    <x-jet-label for="apellido_materno" value="Apellido materno"/>
                    <x-input.error wire:model.defer="user.apellido_materno" class="block mt-1 w-full" type="text" id="apellido_materno" name="apellido_materno" for="user.apellido_materno"/>
                </div>
            </div>

            <!-- Correo -->
            <div class="mt-4">
                <x-jet-label for="email" value="Correo" />
                <x-input.error wire:model.defer="user.email" class="block mt-1 w-full" type="email" id="email" name="email" for="user.email" required/>
            </div>

            <!-- Contraseña -->
            <div class="mt-4">
                <x-jet-label for="contraseña" value="{{ $edit ? 'Contraseña nueva' : 'Contraseña' }}" />
                <x-input.error wire:model.defer="password" class="block mt-1 w-full" type="password" id="contraseña" name="contraseña" for="password"/>
            </div>

            <!-- Confirmación de contraseña -->
            <div class="mt-4">
                <x-jet-label for="contraseña_confirmation" value="Confirmación de contraseña" />
                <x-input.error wire:model.defer="password_confirmation" class="block mt-1 w-full" type="password" id="contraseña_confirmation" name="contraseña_confirmation" for="password_confirmation"/>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEditCreateModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:loading.attr="disabled" form="userForm">
            {{ $edit ? 'Editar' : 'Crear' }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>