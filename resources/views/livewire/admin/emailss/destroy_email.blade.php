<x-jet-confirmation-modal wire:model="confirmin_part_deletion">
    <x-slot name="title">
        {{ __('Eliminar Post.') }}
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea eliminar el email
        <span class="font-bold text-red-900">{{ $title }}</span>?
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        {{-- boton de cancelar --}}
        <x-jet-secondary-button wire:click="$toggle('confirmin_part_deletion')" wire:loading.attr="disabled">
            {{ __('Cancelar') }}
        </x-jet-secondary-button>
        {{-- boton de eliminar--}}
        <x-jet-danger-button class="ml-3" wire:click="delete()" wire:loading.attr="disabled">
            {{ __('Eliminar') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
