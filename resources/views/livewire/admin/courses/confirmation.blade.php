<x-jet-confirmation-modal wire:model.defer="showConfirmationModal">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        @if($delete)
            ¿Seguro que desea eliminar el curso <strong>{{ $course->nombre }}</strong>?
        @else
            @if($edit)
                ¿Seguro que desea guardar los cambios del curso <strong>{{ $course->nombre }}</strong>?
            @else
                ¿Seguro que desea crear el curso <strong>{{ $course->nombre }}</strong>?
            @endif
        @endif
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showConfirmationModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        @unless($delete)
            <x-jet-button class="ml-3" wire:click.prevent="save()" wire:loading.attr="disabled">
                Confirmar
            </x-jet-button>
        @else
            <button wire:click.prevent="destroy()" wire:loading.attr="disabled" class="ml-3 inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
                Eliminar
            </button>
        @endunless
    </x-slot>
</x-jet-confirmation-modal>
