<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditCreateModal">
    <x-slot name="title">
        {{ $edit ? 'Editar rol' : 'Crear rol' }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="confirmSave()" id="roleForm">
            <!-- Nombre -->
            <div>
                <x-jet-label for="nombre" value="Nombre"/>
                <x-input.error wire:model.defer="role.name" class="block mt-1 w-full" type="text" id="clave" name="clave" for="role.name" required/>
            </div>

            <!-- Permisos -->
            <fieldset class="mt-4">
                <p class="block font-medium text-sm text-gray-700">Permisos</p>
                <div class="divide-y divide-gray-200">
                    {{-- <div class="border-t border-gray-200 bg-gray-50 px-6 py-1 text-sm font-medium text-indigo-500"> --}}
                    {{--     <p>Usuario</p> --}}
                    {{-- </div> --}}
                    <div class="py-4 grid grid-cols-3 gap-2">
                        @foreach(\Spatie\Permission\Models\Permission::all() as $permission)
                            <x-checkbox wire:model.defer="permissions" :value="$permission->id" :for="$permission->name" :label="$permission->name"/>
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
