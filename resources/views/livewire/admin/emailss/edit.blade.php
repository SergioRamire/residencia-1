<x-jet-dialog-modal wire:ignore.self wire:model.defer="show_edit_modal">
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

        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('show_edit_modal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent="confirmation()" wire:loading.attr="disabled" form="courseForm">
            enviar
        </x-jet-button>
        @if($confirming_save_email)
                @include('livewire.admin.emailss.confirSend')
        @endif
    </x-slot>
</x-jet-dialog-modal>
