{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="showConfirmationEstatus">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        @if($confirming_course_active)
        ¿Seguro que desea habilitar el curso  <strong>
            {{$this->curso->nombre}}</strong>?
        @elseif($confirming_course_Inactive)
        ¿Seguro que desea inhabilitar el curso  <strong>
            {{$this->curso->nombre}}</strong>?
        @endif
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showConfirmationEstatus')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>
        @if($confirming_course_active)
        <x-jet-danger-button class="ml-3" wire:click="habilitar()" wire:loading.attr="disabled">
            Aceptar
        </x-jet-danger-button>
        @elseif($confirming_course_Inactive)
        <x-jet-danger-button class="ml-3" wire:click="inhabilitar()" wire:loading.attr="disabled">
            Aceptar
        </x-jet-danger-button>
        @endif
    </x-slot>
</x-jet-confirmation-modal>
