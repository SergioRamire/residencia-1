<x-jet-dialog-modal wire:ignore.self wire:model.defer="showViewModal">
    <x-slot name="title">
        SSSS:
        <strong>{{'postt.title'}}</strong>
    </x-slot>
    <x-slot name="content">
        {{-- <form  id="courseForm"> --}}
            <div class="mt-4">
                <x-jet-label value="Descripción"/>
                <x-jet-input wire:model.defer="postt.description" class="block mt-1 w-full" type="text" disabled/>
            </div>
            <div class="mt-4">
                <x-jet-label value="title"/>
                <x-jet-input wire:model.defer="postt.title" class="block mt-1 w-full" type="text" disabled/>
            </div>
            <div class="mt-4">
                <x-jet-label value="role"/>
                <x-jet-input wire:model.defer="postt.role" class="block mt-1 w-full" type="text" disabled/>
            </div>
        {{-- </form> --}}
    </x-slot>

    <x-slot name="footer">
        <x-jet-button wire:click="$toggle('showViewModal')" wire:loading.attr="disabled" >
            Hecho
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
