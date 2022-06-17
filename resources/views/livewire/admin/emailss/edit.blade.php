<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditModal">
    <x-slot name="title">
       Enviar notificacion
    </x-slot>
    <x-slot name="content">
        <form  id="courseForm">

            <!-- Nombre -->
            <div class="mt-4">
                <x-jet-label for="title"  value="{{ __('Titulo') }}" />
                <x-input.error wire:model="arr.title" class="block mt-1 w-full" type="text" id="title" name="title" for="title" required/>
                <x-jet-input-error for="arr.title"/>
            </div>

            <!-- Descripcion -->
            <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Descripción') }}"/>
                <x-input.textarea wire:model.defer="arr.description" id="arr.description" class="block mt-1 w-full" name="arr.description" required/>
                <x-jet-input-error for="arr.description"/>
            </div>

            {{-- <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Descripción') }}" />
                <x-input.error wire:model="arr.description" class="block mt-1 w-full" type="text" id="description" name="description" for="description" required/>
                <x-jet-input-error for="arr.description"/>
            </div> --}}

            {{-- <div class="mt-4 sm:flex-1">
                <x-jet-label for="rol" value="Destinatario"/>
                <x-input.select wire:model.defer="arr.role" id="rol" class="mt-1 w-full" name="rol">
                        <option value="" disabled>Selecciona</option>
                        <option value="Participante">Participantes</option>
                        <option value="Instructor">Instructores</option>
                        <option value="Todos">Todos</option>
                </x-input.select>
                <x-jet-input-error for="arr.role"/>
            </div> --}}

        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEditModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent="store()" wire:loading.attr="disabled" form="courseForm">
            enviar
        </x-jet-button>
        {{-- @if($confirmingSaveParti)
                @include('livewire.admin.participante.confirCreate')
        @endif --}}
    </x-slot>
</x-jet-dialog-modal>
