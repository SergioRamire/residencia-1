<!-- Modales -->
<x-jet-dialog-modal wire:model="modalEdit">
    <x-slot name="title">
        Instructor
    </x-slot>
    <x-slot name="content">
    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
        <div id="Layer1" style="width:700px; height:400px; " class="mt-4 flex-1">
            <x-jet-label value="Seleccione el instructor"/>
            @livewire('admin.instructor-select')
        </div>
    </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="closeModal()" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent="asignar()" wire:loading.attr="disabled" form="courseForm">
            Asignar
        </x-jet-button>

    </x-slot>
</x-jet-dialog-modal>
