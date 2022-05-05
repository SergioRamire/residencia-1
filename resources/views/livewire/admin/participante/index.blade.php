<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Participantes
        </h2>
    </x-slot>

    @if (session()->has('message'))
        <div class="mt-3">
            <x-alert.info border duration="7000">{{session('message') }}</x-alert.info>
        </div>
    @endif

    <div class="space-y-2">

        <div class="md:flex md:justify-between space-y-2 md:space-y-0">
                <!-- Parte izquierda -->
                <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Barra de búsqueda -->
                    <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar participante...">
                        <x-icon.search solid class="h-5 w-5 text-gray-400"/>
                    </x-input.icon>
                </div>
                <!-- Parte de Filtros -->
                <div class="md:w-1/2 md:flex md:space md:space">
                    <x-dropdown width="w" align="right" dropdownClasses="md:w-72" content-classes="py-4 bg-white divide-y">
                        <x-slot name="trigger">
                            <button class="inline-flex justify-center w-full rounded-md border hover:border-gray-400 shadow-sm px-2.5 py-2.5 bg-white font-medium focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" :class="open ? 'text-indigo-400 hover:text-indigo-500 border-indigo-500' : 'text-gray-400 hover:text-gray-500 border-gray-300'">
                                @if(in_array(true, $filters))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                    </svg>
                                @endif
                            </button>
                        </x-slot>

                        <x-slot name="content">

                            <!-- Filtro Area -->
                            <div class="px-3 py-2">
                                <label class="text-rigth">Filtro por Area</label>
                                <x-input.select wire:model="filters.filtro_area" class="mt-2" name="filtro_area" required >
                                    <option value="">Todas las areas</option>
                                            @foreach($areas as $i)
                                                <option value="{{$i->id}}">{{$i->nombre}}</option>
                                            @endforeach
                                 </x-input.select>
                            </div>

                            <!-- Filtro tipo -->
                            <div class="block px-4 py-2 space-y-1">
                                <label class="text-center">Filtro por Tipo</label>
                                <x-input.select wire:model="filters.filtro_tipo" class="mt-1" name="filtro_tipo" required >
                                <option value="">Todos los Tipos</option>
                                <option value="Base">Base</option>
                                <option value="Interinato">Interinato</option>
                                <option value="Honorarios">Honorarios</option>
                                 </x-input.select>
                            </div>

                            <!-- Filtro sexo -->
                            <div class="block px-4 py-2 space-y-1">
                                <label class="text-center">Filtro por Sexo</label>
                                <x-input.select wire:model="filters.filtro_sexo" class="mt-1" name="filtro_sexo" required >
                                <option value="">Todos los Sexos</option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                                 </x-input.select>
                            </div>

                            <!-- Filtro CuentaMoodle -->
                            <div class="block px-4 py-2 space-y-1">
                                <label class="text-center">Filtro por Cuenta Moodle</label>
                                <x-input.select wire:model="filters.filtro_cuentamoodle" class="mt-1" name="filtro_cuentamoodle" required >
                                <option value="">Todos</option>
                                <option value="1">Tiene</option>
                                <option value="0">No tiene</option>
                                 </x-input.select>
                            </div>

                            <!-- Reinciar filtros -->
                            <div class="block px-4 py-2 space-y-1">
                                <button wire:click="resetFilters2()" @click="open = false" type="button" title="Reiniciar fitros"
                                        class="inline-flex justify-center w-full rounded-md border hover:border-red-400 shadow-sm px-2 py-2 bg-white text-gray-400 hover:text-red-400 font-medium focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                    <x-icon.trash class="h-5 w-5"/>
                                </button>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Parte derecha -->
                <div>
                    <x-input.select wire:model="perPage" class="border-green-300 text-green-700 hover:text-green-500 active:text-green-800 active:bg-green-50">
                        <option value=8>8 por página</option>
                        <option value=10>10 por página</option>
                        <option value=25>25 por página</option>
                        <option value=50>50 por página</option>
                        <option value=100>100 por página</option>
                    </x-input.select>
                </div>
            </div>


        <!-- Tabla -->
        <div class="flex flex-col space-y-2">
            <x-table>
                <x-slot name="head">
                    <x-table.header class="text-center">Rfc</x-table.header>
                    <x-table.header class="text-center">Nombre</x-table.header>
                    <x-table.header class="text-center">Area</x-table.header>
                    <x-table.header class="text-center">Cuenta moodle</x-table.header>
                    <x-table.header class="text-center">Acción</x-table.header>
                </x-slot>

                @forelse($view as $part)
                    <tr class="text-center">
                        <x-table.cell >{{ $part->rfc }}</x-table.cell>
                        <x-table.cell>
                            {{ $part->name}}{{' '}}{{ $part->apellido_paterno}}{{' '}}{{ $part->apellido_materno}}
                        </x-table.cell>
                        <x-table.cell>{{ $part->area }}</x-table.cell>
                        <x-table.cell>
                            @if ($part->cuenta_moodle == true)
                                Si tiene
                            @endif
                            @if($part->cuenta_moodle == false)
                                No tiene
                            @endif
                        </x-table.cell>
                        <x-table.cell>
                            <button wire:click="inspeccionar({{ $part->id }})" type="button" class="text-indigo-600 hover:text-indigo-900">
                                <x-icon.eye class="h-6 w-6"/>
                            </button>
                            <button wire:click="edit({{ $part->id }})" type="button" class="text-amber-600 hover:text-amber-900">
                                <x-icon.pencil alt class="h-6 w-6"/>
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
                                    No se encontraron Participantes ...
                                </span>
                            </div>
                        </x-table.cell>
                    </tr>
                @endforelse
            </x-table>
            <div>
                {{ $view->links() }}
            </div>
        </div>
    </div>

    @if($edit)
        @include('livewire.admin.participante.edit',['modo'=>'Actualizar'])
    @elseif($ins)
        @include('livewire.admin.participante.show')
    @endif


</div>
