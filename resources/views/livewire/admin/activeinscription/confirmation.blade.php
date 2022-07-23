<x-jet-confirmation-modal wire:model="confirming_change">
    <x-slot name="title">
        Confirmación
    </x-slot>
    <x-slot name="content">
        @if ($flag)
            <p>¿Seguro que desea publicar el periodo?</p>
        @else
            <p>¿Seguro que desea ocultar el periodo?</p>            
        @endif
    </x-slot>
    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirming_change')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-danger-button class="ml-3" wire:click="publicar()" wire:loading.attr="disabled">
            Guardar
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>