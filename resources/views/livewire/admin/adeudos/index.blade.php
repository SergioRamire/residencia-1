<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            ADEUDOS
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">


            <!-- Opciones de tabla -->
            <div class="md:flex md:justify-between space-y-2 md:space-y-0">

                <!-- Parte izquierda -->
                <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">

                    <!-- Barra de búsqueda -->
                    <div class="w-full">
                        <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar multa...">
                            <x-icon.search solid class="h-5 w-5 text-gray-400"/>
                        </x-input.icon>
                        {{-- <label><p class="text-xs font-bold">Buscar por: rfc, nombre, departamento, curso o grupo</p></label> --}}
                    </div>



                </div>


                <!-- Parte derecha -->
                <div class="md:flex md:items-center space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Selección de paginación -->
                    <div>
                        <x-input.select wire:model="perPage" class="block w-full">
                            <option value=8>8 por página</option>
                            <option value=10>10 por página</option>
                            <option value=25>25 por página</option>
                            <option value=50>50 por página</option>
                        </x-input.select>
                    </div>
                </div>
            </div>

            <!-- Tabla -->
            <div class="flex flex-col space-y-2">
                <x-table>
                    <x-slot name="head">
                        <x-table.header wire:click="sortBy('id')" sortable :direction="$sortField === 'id' ? $sortDirection : null">
                            CÓDIGO DE LA MULTA
                        </x-table.header>
                        <x-table.header wire:click="sortBy('date')" sortable :direction="$sortField === 'date' ? $sortDirection : null">
                            fecha
                        </x-table.header>
                        <x-table.header wire:click="sortBy('name')" sortable :direction="$sortField === 'name' ? $sortDirection : null">
                            nombre
                        </x-table.header>
                        <x-table.header wire:click="sortBy('description')" sortable :direction="$sortField === 'description' ? $sortDirection : null">
                            Descripción
                        </x-table.header>
                        <x-table.header wire:click="sortBy('cost')" sortable :direction="$sortField === 'cost' ? $sortDirection : null">
                            Costo
                        </x-table.header>
                        <x-table.header>
                            Estatus
                        </x-table.header>
                    </x-slot>

                    @forelse($datos as $l)
                        <tr wire:key="list-{{ $loop->index }}" wire:loading.class.delay="opacity-50">
                            <x-table.cell>{{ $l->id}} </x-table.cell>
                            <x-table.cell>{{ $l->date}} </x-table.cell>
                            <x-table.cell>{{ $l->name }} {{ $l->apellido_paterno }} {{ $l->apellido_materno }}</x-table.cell>
                            <x-table.cell>{{ $l->description }} </x-table.cell>
                            <x-table.cell>{{ $l->cost }} </x-table.cell>
                            <x-table.cell>{{ $l->paid }} </x-table.cell>

                        </tr>
                        @empty
                        <tr>
                            <x-table.cell colspan="7">
                                <div class="flex justify-center items-center space-x-2">
                                    <!-- Icono -->
                                    <svg class="inline-block h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <!-- Texto -->
                                    <span class="py-4 text-xl text-gray-400 font-medium">
                                        No se encontraron departamentos ...
                                    </span>
                                </div>
                            </x-table.cell>
                        </tr>
                    @endforelse
                </x-table>

                <div>
                    {{ $datos->links() }}
                </div>
                {{-- <div class="text-right min-h-full">
                    @if($lists->count() > 0)
                        <button wire:click="descarga()" title="Descargar lista en formato (.xlsx)" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                            Descargar lista
                        </button>
                    @endif
                </div> --}}


            </div>
        </div>
        {{-- @if ($create)
        @include('livewire.admin.lists.edit_create', ['modo' => 'Registrar'])
        @elseif($edit)
            @include('livewire.admin.lists.edit_create', ['modo' => 'Actualizar'])
        @endif
        @if ($confirming_participant_deletion)
            @include('livewire.admin.lists.destroy')
        @endif --}}
    <!-- Modales -->

</div>
