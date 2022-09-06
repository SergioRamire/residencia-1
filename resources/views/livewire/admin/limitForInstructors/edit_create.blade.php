<x-jet-dialog-modal wire:ignore.self wire:model.defer="modal_edit">
    <x-slot name="title">
        Editar fecha límite
    </x-slot>
    @php
        $day= date("Y-m-d");
        $date= date("Y-m-d",strtotime($day."+ 1 days"));
    @endphp
    <x-slot name="content">
        <x-jet-label for="x" class="text-red-600" value="Los campos con * son obligatorios"/><br>
        <div class="col-start pr-1">
            <p class="text-lg">Fecha límite para cargar calificaciones. <span class="text-red-600">*</span></p>
            <x-input.error wire:model="period.fecha_limite_para_calificar" class="block mt-1 w-full border-[#1b396a] text-[#1b396a] active:text-sky-50 active:bg-sky-500"
                type="date" id="fecha_limite" name="period.fecha_limite_para_calificar" min="{{$date}}" for="period.fecha_limite_para_calificar" />
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modal_edit')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click="confirmar" wire:loading.attr="disabled" form="courseForm">
            Guardar
         </x-jet-button>
        @if($modal_confirmacion)
            @include('livewire.admin.limitForInstructors.confirmation')
        @endif
    </x-slot>
</x-jet-dialog-modal>
