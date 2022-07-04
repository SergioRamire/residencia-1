<x-jet-dialog-modal wire:ignore.self wire:model="showViewModal">
    <x-slot name="title">
        <strong>Notificación {{$this->title}} enviada.</strong>
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
        {{-- </form> --}}
    </x-slot>

    <x-slot name="footer">
        <x-jet-button wire:click="$toggle('showViewModal')" wire:loading.attr="disabled" >
            Hecho
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
