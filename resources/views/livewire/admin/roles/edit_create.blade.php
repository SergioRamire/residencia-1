<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditCreateModal">
    <x-slot name="title">
        {{ $edit ? 'Editar rol' : 'Crear rol' }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="confirmSave()" id="roleForm">
            <div>
                <x-jet-label for="nombre" value="Nombre" />
                <x-input.error wire:model.defer="role.name" class="block mt-1 w-full" type="text" id="clave" name="clave" for="role.name" required/>
            </div>
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
