<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
            Generación de Constancias.
        </h2>
    </x-slot>


    <div class="space-y-4">
        <div class="flex justify-between">
           <div>
            <x-input.icon wire:model="search" class="mt-2 sm:mt-0 sm:flex-1" type="text" placeholder="Buscar...">
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
                    {{-- filtro por cursos --}}
                    <div>
                        <x-input.select wire:model="filters.filtro_curso" class="mt-2" name="filtro_curso" required >
                            <option value="">Todos los cursos</option>
                                    @foreach($cursos as $i)
                                        <option value="{{$i->nombre}}">{{$i->nombre}}</option>
                                    @endforeach
                        </x-input.select>
                    </div>
                    <!-- Filtro Calificacion -->
                    <div class="block px-4 py-2 space-y-1">
                        <label class="text-center">Filtro por Tipo</label>
                        <x-input.select wire:model="filters.filtro_calificacion" class="mt-1" name="filtro_tipo" required >
                        <option value="">Todos los Tipos</option>
                        <option value=69>mayor 70</option>
                        <option value=70>menor 70</option>
                        </x-input.select>
                    </div>

                    <div class="block px-4 py-2 space-y-1">
                        <label class="text-center">Filtro por Tipo</label>
                        <x-input.select wire:model="filters.filtro_año" class="mt-1" name="filtro_tipo" required >
                        <option value="">Todos los años</option>
                        <option value=2020>2020</option>
                        <option value=2021>2021</option>
                        <option value=2022>2022</option>
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
                    <x-table.header class="text-center" >Participante</x-table.header>
                    {{-- <x-table.header class="text-center">grupo</x-table.header> --}}
                    <x-table.header class="text-center">curso</x-table.header>
                    <x-table.header class="text-center">Calificación</x-table.header>
                    <x-table.header class="text-center">Opcion</x-table.header>
                </x-slot>

                @forelse($calificaciones as $g)
                    <tr wire:key="calificaciones{{ $g->i }}" wire:loading.class.delay="opacity-50">
                        <x-table.cell>
                            {{ $g->name }}{{' '}}{{ $g->apellido_paterno }}{{' '}}{{ $g->apellido_materno }}
                        </x-table.cell>
                        <x-table.cell class="text-center">{{ $g->curso }}</x-table.cell>
                        <x-table.cell class="text-center">{{ $g->calificacion }}</x-table.cell>
                        <div>
                            @if($g->calificacion > 69)
                            <x-table.cell class="text-center">
                                <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                    <span>Download</span>
                                  </button>
                            </x-table.cell>
                            @else
                                <x-table.cell class="text-center  text-red-500">{{'No aprobó'}}</x-table.cell>
                            @endif
                        </div>
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
                                    No se encontraron registros ...
                                </span>
                            </div>
                        </x-table.cell>
                    </tr>
                @endforelse
            </x-table>
            <div>
                {{ $calificaciones->links()}}
            </div>

        </div>
    </div>
</div>
