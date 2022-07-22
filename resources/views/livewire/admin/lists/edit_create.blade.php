<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEdit_create_modal">
    <x-slot name="title">
        {{$modo}} Participante
    </x-slot>
    <x-slot name="content">
        <div style="height: 400px">
            @if ($create)
                <div class="mt-4 flex-1">
                    <x-jet-label value="Seleccione el participante"/>
                    @livewire('admin.participante-select')
                </div>
                <div class="mt-4 flex-1">
                    <x-jet-label value="Seleccione el periodo"/>
                    @livewire('admin.period-select2')
                </div>
            @endif
            @if ($edit)

                <div class="mt-4 flex-1">
                    <x-jet-label value="Participante"/>
                    <p class="text-black pt-2">RFC: {{$participante->rfc}}</p>
                    <p class="text-black pb-2">Nombre: {{$participante->name}} {{$participante->apellido_paterno}} {{$participante->apellido_materno}}</p>

                </div>
                <div class="mt-4 flex-1">
                    <x-jet-label value="Periodo"/>
                    <p class="text-black py-2">{{$periodo->clave}}</p>
                </div>
            @endif

            <div class="mt-4 flex-1">
                <x-jet-label value="Seleccione el Curso"/>
                @livewire('admin.course-grupo-select')
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEdit_create_modal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent=" update_participant()" wire:loading.attr="disabled" form="courseForm">
            {{$modo}} Datos
         </x-jet-button>
        @if($confirming_save_participant)
            @include('livewire.admin.lists.confirmation')
        @endif
    </x-slot>
</x-jet-dialog-modal>
