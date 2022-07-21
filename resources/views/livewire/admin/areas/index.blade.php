<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#1b396a] leading-tight mb-4">
            DEPARTAMENTOS
        </h2>
    </x-slot>

    <div class="space-y-2">
        <!-- Botón de nuevo -->
        <div class="mb-6">
            <x-jet-secondary-button wire:click="create()" class="border-[#1b396a] text-sky-700 hover:text-sky-500 active:text-[#1b396a] active:bg-sky-50">
                <x-icon.plus solid alt="sm" class="inline-block h-5 w-5"/>
                Nuevo Departamento
            </x-jet-secondary-button>
        </div>
        <!-- Opciones de tabla -->
        <div class="md:flex md:justify-between space-y-2 md:space-y-0">
            <!-- Parte izquierda -->
            <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                <!-- Barra de búsqueda -->
                <div class="w-full">
                    <x-input.icon wire:model="search" class="w-full " type="text" placeholder="Buscar departamentos...">
                        <x-icon.search solid class="h-5 w-5 text-gray-400"/>
                    </x-input.icon>
                    <label><p class="text-xs font-bold">Buscar por: clave de área, área, jefe, teléfono o extensión</p></label>
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
                <x-slot name="head" class="text-white-800">
                    <x-table.header class="text-gray-100" wire:click="sortBy('clave')" sortable :direction="$sortField === 'clave' ? $sortDirection : null">
                        clave
                    </x-table.header>
                    <x-table.header wire:click="sortBy('nombre')" sortable :direction="$sortField === 'nombre' ? $sortDirection : null">
                        Área o Departamento
                    </x-table.header>
                    <x-table.header wire:click="sortBy('jefe_area')" sortable :direction="$sortField === 'jefe_area' ? $sortDirection : null">
                        Jefe
                    </x-table.header>
                    <x-table.header wire:click="sortBy('telefono')" sortable :direction="$sortField === 'telefono' ? $sortDirection : null">
                        Teléfono
                    </x-table.header>
                    <x-table.header >Extensión</x-table.header>
                    <x-table.header>acciones</x-table.header>
                </x-slot>

                @forelse($datosareas as $a)
                    <tr wire:key="area-{{ $loop->index}}" wire:loading.class.delay="opacity-50">
                        <x-table.cell>{{ $a->clave }}</x-table.cell>
                        <x-table.cell>{{ $a->nombre }}</x-table.cell>
                        <x-table.cell>{{ $a->jefe_area }}</x-table.cell>
                        <x-table.cell>{{ $a->telefono }}</x-table.cell>
                        <x-table.cell>{{ $a->extension}}</x-table.cell>
                        <x-table.cell width='200' class="whitespace-nowrap">
                            <button  wire:click="edit({{ $a->id }})" type="button" title="Editar información" class="mr-1 px-4 bg-white hover:text-white hover:bg-amber-500 text-black font-bold border border-amber-400 rounded shadow" >
                                Editar
                            </button>
                            <button wire:click="delete_area('{{ $a->id }}')" type="button" title="Eliminar área" class="ml-1 px-4 bg-white hover:text-white hover:bg-red-600 text-black font-bold border border-red-400 rounded shadow">
                                Eliminar
                            </button>
                        </x-table.cell>
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
                {{ $datosareas->links() }}
            </div>
            @if($create)
                        @include('livewire.admin.areas.edit_create',['modo'=>'Crear'])

            @elseif($edit)
                        @include('livewire.admin.areas.edit_create',['modo'=>'Actualizar'])
            @endif
            @if($confirmingAreaDeletion)
                        @include('livewire.admin.areas.destroy')
            @endif

        </div>
    </div>
</div>
