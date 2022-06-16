<!-- Modales -->
<x-jet-dialog-modal wire:model="modalEdit">
    <x-slot name="title">
        Área
    </x-slot>
    <x-slot name="content">

        {{-- Per: {{ $classification['periodo']}}, Cur: {{ $id_detalle_curso  }}, Ins: {{$id_instructor}} --}}
        <div id="Layer1" style="width:600px; height:500px; overflow: scroll;">
            @livewire('admin.instructor-select')
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
