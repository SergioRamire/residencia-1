<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditModal">
    <x-slot name="title">
       Enviar notificación
    </x-slot>
    <x-slot name="content">
        <x-jet-label for="x" class="text-red-600" value="Los campos con * son obligatorios" />

        <form  id="courseForm">

            <!-- Nombre -->
            <div class="mt-4">
                <x-jet-label for="title">Asunto <span class="text-red-600">*</span></x-jet-label>
                <x-input.error wire:model="arr.title" class="block mt-1 w-full" type="text" id="title" name="title" for="title" required/>
                <x-jet-input-error for="arr.title"/>
            </div>

            <!-- Descripcion -->
            <div class="mt-4">
                <x-jet-label for="description">Cuerpo <span class="text-red-600">*</span></x-jet-label>
                <x-input.textarea wire:model="arr.description" id="arr.description" class="block mt-1 w-full" name="arr.description" required/>
                <x-jet-input-error for="arr.description"/>
            </div>

            <div class="mt-4 sm:flex-1">
                <x-jet-label for="rol">Destinatario <span class="text-red-600">*</span></x-jet-label>
                <x-input.select wire:model="arr.role" id="rol" class="mt-1 w-full" name="rol">
                        <option value="" disabled>Selecciona</option>
                        <option value="Participante">Participantes</option>
                        <option value="Instructor">Instructores</option>
                        <option value="Todos">Todos</option>
                </x-input.select>
                <x-jet-input-error for="arr.role"/>
            </div>

        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEditModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent="confirmation()" wire:loading.attr="disabled" form="courseForm">
            enviar
        </x-jet-button>
        @if($confirmingSaveEmail)
                @include('livewire.admin.emailss.confirSend')
        @endif
    </x-slot>
</x-jet-dialog-modal>
