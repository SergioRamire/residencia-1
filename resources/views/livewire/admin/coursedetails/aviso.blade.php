{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="aviso">
    <x-slot name="title">
        Confirmación
    </x-slot>

    <x-slot name="content">
        No se pueden registrar estos detalles debido a que ya existe un curso ofertado en el período elegido,
        en el lugar <strong> {{$lugar}}</strong> y con un horario de <strong>{{$hora_inicio}}</strong> a <strong>{{$hora_fin}}</strong> hrs.
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('aviso')" wire:loading.attr="disabled">
            Aceptar
        </x-jet-secondary-button>
    </x-slot>
</x-jet-confirmation-modal>
