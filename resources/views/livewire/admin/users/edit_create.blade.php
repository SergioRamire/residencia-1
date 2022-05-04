<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditCreateModal">
    <x-slot name="title">
        {{ $edit ? 'Editar usuario' : 'Crear usuario' }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="confirmSave()" id="userForm">
            <!-- Nombre -->
            <div>
                <x-jet-label for="nombre" value="Nombre" />
                <x-input.error wire:model.defer="user.name" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="user.name" required/>
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
