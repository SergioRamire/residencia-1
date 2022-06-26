<x-jet-confirmation-modal wire:model="confirminNotificacion">
    <x-slot name="title">
        {{ __('Eliminar Notificaciones enviadas') }}
    </x-slot>

    <x-slot name="content">
        ¿Seguro que desea eliminar las notificaciones enviadas?
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        {{-- boton de cancelar --}}
        <x-jet-secondary-button wire:click="$toggle('confirmingPartDeletion')" wire:loading.attr="disabled">
            {{ __('Cancelar') }}
        </x-jet-secondary-button>
        {{-- boton de eliminar--}}
        <x-jet-danger-button class="ml-3" wire:click="deleteNotifications()" wire:loading.attr="disabled">
            {{ __('Eliminar') }}
        </x-jet-danger-button>
    </x-slot>
</x-jet-confirmation-modal>
