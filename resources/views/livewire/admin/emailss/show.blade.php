<x-jet-dialog-modal wire:ignore.self wire:model="show_view_modal">
    <x-slot name="title">
        <strong>Email {{$this->title}} enviado.</strong>
    </x-slot>
    <x-slot name="content">
        {{-- <form  id="courseForm"> --}}
            <div class="mt-4">
                <x-jet-label value="Título"/>
                <x-jet-input wire:model='title' class="block mt-1 w-full" type="text" disabled/>
            </div>

            <!-- Descripcion -->
            <div class="mt-4">
                <x-jet-label for="description" value="{{ __('Descripción') }}"/>
                <x-input.textarea wire:model="description" id="description" class="block mt-1 w-full" name="description" disabled/>
            </div>
            <div class="mt-4">
                <x-jet-label value="Destinatario"/>
                <x-jet-input wire:model.defer="role" class="block mt-1 w-full" type="text" disabled/>
            </div>
        {{-- </form> --}}
    </x-slot>

    <x-slot name="footer">
        <x-jet-button wire:click="$toggle('show_view_modal')" wire:loading.attr="disabled" >
            Hecho
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
