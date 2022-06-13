<!-- Modales -->
<x-jet-dialog-modal wire:model="modalEdit">
    <x-slot name="title">
        Área
    </x-slot>
    <x-slot name="content">

        Ins: {{ $id_ins }}, Cur: {{ $id_detalle_curso }}
        <div wire:ignore>
            <select id="eleccion2" model wire:model.defer='id_ins'>
                <option value=''>Seleccionar un Instructor</option>
                @foreach ($datosuser as $user)
                    <option value='{{ $user->id }}'>{{ $user->name }} {{ $user->apellido_paterno }} {{ $user->apellido_materno }} </option>
                @endforeach
            </select>
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
