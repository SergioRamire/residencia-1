<!-- Modales -->
    <x-jet-dialog-modal wire:model="modalEdit">
        <x-slot name="title">
            <div class="bg-[#1b396a] text-white p-2">
                @if ($create)
                    Añadir Instructor
                @endif
                @if ($show)
                    Ver Instructore
                @endif
                @if ($delet)
                    Eliminar Instructores
                @endif
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <div id="Layer1" style="width:700px; height:400px; " class="mt-4 flex-1">
                    @if ($create)
                        <div class="mt-4 w-3/4">
                            <x-jet-label value="Seleccione el instructor" class="font-bold font text-lg"/>
                            @livewire('admin.instructor-select')
                        </div>
                    @endif
                    @if ($show)
                        {{-- <div class="flex flex-col space-y-2"> --}}
                            <x-table>
                                <x-slot name="head">
                                    <x-table.header class="text-center">Instructores</x-table.header>
                                    <x-table.header class="text-center">Accion</x-table.header>
                                </x-slot>

                                @forelse($listaIns as $item)
                                    <tr wire:key="instructor-{{ $loop->index }}" wire:loading.class.delay="opacity-50">
                                        <x-table.cell >{{ $item->n }} {{ $item->ap1 }} {{ $item->ap2 }}</x-table.cell>
                                        <x-table.cell class="text-center">
                                            <button wire:click="delete2({{$item->idi}})" type="button" class="text-red-600 hover:text-red-900">
                                                <x-icon.trash class="h-6 w-6"/>
                                            </button>
                                        </x-table.cell>
                                    </tr>
                                @empty
                                    <tr>
                                        <x-table.cell colspan="7">
                                            <div class="flex justify-center items-center space-x-2">
                                                <svg class="inline-block h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                                <span class="py-4 text-xl text-gray-400 font-medium">
                                                    No se encontraron registros ...
                                                </span>
                                            </div>
                                        </x-table.cell>
                                    </tr>
                                @endforelse
                            </x-table>
                        {{-- </div> --}}
                    @endif
                    @if ($delet)
                            <select wire:model="id_ins_delete" name="" id="">
                                <option value="">Seleccione un Instructor</option>
                                    @foreach ($listaIns as $item)
                                        <option value="{{$item->idi}}">{{ $item->n }} {{ $item->ap1 }} {{ $item->ap2 }}</option>
                                    @endforeach
                            </select>
                            @if (!is_null($id_ins_delete))
                                <x-jet-button class="ml-3 bg-[#1b396a]" wire:click="delete" wire:loading.attr="disabled" form="courseForm">
                                    Borrar Eleccion
                                </x-jet-button>
                            @endif
                    @endif
                </div>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal()" wire:loading.attr="disabled">
                Cancelar
            </x-jet-secondary-button>

            @if ($create)
                <x-jet-button class="ml-3 bg-[#1b396a]" wire:click.prevent="openConfirmacion()" wire:loading.attr="disabled" form="courseForm">
                    Asignar
                </x-jet-button>
            @endif
            @if ($show)
            @endif
            @if ($delet)
            @endif
            @include('livewire.admin.assignedInstructor.destroy')

        </x-slot>
    </x-jet-dialog-modal>
