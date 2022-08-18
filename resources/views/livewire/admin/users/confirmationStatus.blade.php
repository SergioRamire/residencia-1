{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="confirmationStatus">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        @if($confirming_user_active)
            ¿Seguro que desea habilitar el usuario <strong> {{$this->user->name }} {{$this->user->apellido_paterno}} {{" "}}{{$this->user->apellido_materno}}</strong>?
        @elseif($confirming_user_Inactive)
            ¿Seguro que desea inhabilitar el usuario <strong> {{$this->user->name }} {{$this->user->apellido_paterno}}{{" "}}{{$this->user->apellido_materno}}</strong>?
        @endif
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('confirmationStatus')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        @if($confirming_user_active)
        <x-jet-danger-button class="ml-3" wire:click="habilitar()" wire:loading.attr="disabled">
            Aceptar
        </x-jet-danger-button>
        @elseif($confirming_user_Inactive)
        <x-jet-danger-button class="ml-3" wire:click="inhabilitar" wire:loading.attr="disabled">
            Aceptar
        </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-confirmation-modal>
