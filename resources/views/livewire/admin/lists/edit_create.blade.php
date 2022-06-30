<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditCreateModal">
    <x-slot name="title">
        {{$modo}} Participante
    </x-slot>
    <x-slot name="content">
        <form id="courseForm">
            <!-- Nombre -->
            <div class="mt-4">
                <x-jet-label for="nombre" value="Nombre"/>
                <x-input.error wire:model.defer="nombre" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="nombre" required/>
            </div>
            <!-- RFC -->
            <div class="sm:flex-1">
                <x-jet-label for="rfc" value="RFC"/>
                <x-input.error wire:model.defer="rfc" class="block mt-1 w-full" type="text" id="rfc" name="rfc" for="rfc" required/>
            </div>
        </form>
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
