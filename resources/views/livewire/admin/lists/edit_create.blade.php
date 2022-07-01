<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditCreateModal">
    <x-slot name="title">
        {{$modo}} Participante
    </x-slot>
    <x-slot name="content">
        <div style="height: 400px">
            <div class="mt-4 flex-1">
                <x-jet-label value="Seleccione el participante"/>
                @livewire('admin.participante-select')
            </div>
            <div class="mt-4 flex-1">
                <x-jet-label value="Seleccione el periodo"/>
                @livewire('admin.period-select2')
            </div>
            <div class="mt-4 flex-1">
                <x-jet-label value="Seleccione el Curso"/>
                @livewire('admin.course-grupo-select')
            </div>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEditCreateModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent=" updateParticipant()" wire:loading.attr="disabled" form="courseForm">
            {{$modo}} Datos
         </x-jet-button>
        @if($confirmingSaveParticipant)
            @include('livewire.admin.lists.confirmation')
        @endif
    </x-slot>
</x-jet-dialog-modal>
