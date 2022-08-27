{{-- mensage de confimacion de eliminar registro con jetstream --}}
<x-jet-confirmation-modal wire:model="inscripcion_denegada">
    <x-slot name="title">
        AVISO
    </x-slot>

    <x-slot name="content">
        @if($aceptado==false)
            No se puede inscribir a este participante debido a que ya está registrado en este periodo
               como "INSTRUCTOR" o "PARTICIPANTE" en el curso <strong>{{$nombre_curso}}</strong>
               con el horario de <strong>{{$hora_inicio}}</strong> a <strong>{{$hora_fin}}</strong> hrs.
        @endif
    </x-slot>

    {{-- botones --}}
    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('inscripcion_denegada')" wire:loading.attr="disabled">
            Aceptar
        </x-jet-secondary-button>
    </x-slot>
</x-jet-confirmation-modal>
