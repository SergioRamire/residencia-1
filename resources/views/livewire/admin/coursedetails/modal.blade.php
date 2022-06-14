<x-jet-dialog-modal wire:model="modal">
    <x-slot name="title">
        Detaller curso
    </x-slot>
    <x-slot name="content">
        {{ $curso }}
        {{-- <div wire:ignore>
            <select id="id_cur" wire:model.defer='curso'>
                <option value="">Selecciones un Curso x...</option>
                @foreach ($busqueda as $c)
                    <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                @endforeach
            </select>
        </div> --}}
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        <x-jet-button class="ml-3" wire:click.prevent="" wire:loading.attr="disabled" form="courseForm">
            Modificar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
