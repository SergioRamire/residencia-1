<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditCreateModal">
    <x-slot name="title">
        {{ $edit ? 'Editar rol' : 'Crear rol' }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="confirmSave()" id="roleForm">
            <!-- Nombre -->
            <div>
                <x-jet-label for="nombre" value="Nombre"/>
                @unless(in_array($role->name, ['Super admin', 'Administrador', 'Participante', 'Instructor']))
                    <x-input.error wire:model.defer="role.name" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="role.name" required/>
                @else
                    <x-input.error wire:model.defer="role.name" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="role.name" readonly/>
                @endunless
            </div>

            <!-- Permisos -->
            <fieldset class="mt-4">
                <p class="block font-medium text-sm text-gray-700">Permisos</p>
                <div class="divide-y divide-gray-200">
                    <div class="mt-1 grid grid-cols-2 md:grid-cols-4 gap-x-2 gap-y-4">
                        @foreach(\Spatie\Permission\Models\Permission::all() as $permission)
                            <x-checkbox wire:model.defer="permissions" :value="$permission->id" :for="$permission->name" :label="$permission->human_name"/>
                        @endforeach
                    </div>
                </div>
            </fieldset>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEditCreateModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:loading.attr="disabled" form="roleForm">
            {{ $edit ? 'Editar' : 'Crear' }}
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
