<x-jet-confirmation-modal wire:model="deletetodasnotifi">
    <x-slot name="title">
        {{ __('Eliminar Notificaciones') }}
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea eliminar todas sus notificaciones?
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        {{-- boton de cancelar --}}
        <x-jet-secondary-button wire:click="$toggle('deletetodasnotifi')" wire:loading.attr="disabled">
            {{ __('Cancelar') }}
        </x-jet-secondary-button>
        {{-- boton de eliminar--}}
        <x-jet-danger-button class="ml-3" wire:click="deleteNotificationsleidas()" wire:loading.attr="disabled">
            {{ __('Eliminar') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
