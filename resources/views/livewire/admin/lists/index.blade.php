<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Lista de participantes
        </h2>
    </x-slot>

        <div class="space-y-2">
            <div class="md:flex md:justify-between space-y-2 md:space-y-0">
            <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
            <!-- Filtros -->
            <x-dropdown width="w-full" align="right" dropdownClasses="md:w-72" content-classes="py-1 bg-white divide-y">
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
                    <!-- Reiniciar filtros -->
                    <div class="block px-4 py-2 space-y-1">
                        <button wire:click="resetFilters()" @click="open = false" type="button" title="Reiniciar fitros"
                                class="inline-flex justify-center w-full rounded-md border hover:border-red-400 shadow-sm px-2 py-2 bg-white text-gray-400 hover:text-red-400 font-medium focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                            <x-icon.trash class="h-5 w-5"/>
                        </button>
                    </div>

                    <!-- Periodo -->
                    <div class="block px-4 py-2 space-y-1">
                        <div>
                            <x-jet-label for="periofo_filter" value="Periodo"/>
                            <x-input.select wire:model="filters.periodo" id="periodo_filter" class="text-sm block mt-1 w-full" name="periodo_filter" required>
                                <option value="" disabled>Selecciona el periodo...</option>
                                @foreach(\App\Models\Period::all() as $period)
                                    <option value="{{ $period->id }}">{{date('d-m-Y', strtotime($period->fecha_inicio))}} a {{date('d-m-Y', strtotime($period->fecha_fin))}}</option>
                                @endforeach
                            </x-input.select>
                        </div>
                    </div>

                    <!-- Curso -->
                    <div class="block px-4 py-2 space-y-1">
                        <div>
                            <x-jet-label for="curso_filter" value="Curso"/>
                            <x-input.select wire:model="filters.curso" id="curso_filter" class="text-sm block mt-1 w-full" name="curso_filter" required>
                                <option value="" disabled>Selecciona el curso...</option>
                                @foreach(\App\Models\Course::all() as $course)
                            <option value="{{ $course->id }}">{{$course->nombre}}</option>
                        @endforeach
                            </x-input.select>
                        </div>
                    </div>

                    <!-- Grupo -->
                    <div class="block px-4 py-2 space-y-1">
                        <div>
                            <x-jet-label for="grupo_filter" value="Grupo"/>
                            <x-input.select wire:model="filters.grupo" id="grupo_filter" class="text-sm block mt-1 w-full" name="grupo_filter" required>
                                <option value="" disabled>Selecciona el grupo...</option>
                                @foreach(\App\Models\Group::all() as $group)
                            <option value="{{ $group->id }}">{{$group->nombre}}</option>
                        @endforeach
                            </x-input.select>
                        </div>
                    </div>
                </x-slot>
            </x-dropdown>
            </div>

            {{-- <div class="block px-4 py-2 space-y-1">
                <div>
                    <x-jet-label for="periodo" value="Periodo"/>
                    <x-input.select wire:model="periodo" id="periodo" class="text-sm block mt-1 w-full" name="periodo" required>
                        <option value="" disabled>Selecciona el periodo...</option>
                        @foreach(\App\Models\Period::all() as $period)
                            <option value="{{ $period->id }}">{{date('d-m-Y', strtotime($period->fecha_inicio))}} a {{date('d-m-Y', strtotime($period->fecha_fin))}}</option>
                        @endforeach
                    </x-input.select>
                </div>
            </div>

            <!-- Curso -->
            <div class="block px-4 py-2 space-y-1">
                <div>
                    <x-jet-label for="curso_filter" value="Curso"/>
                    <x-input.select wire:model="curso" id="curso" class="text-sm block mt-1 w-full" name="curso" required>
                        <option value="" disabled>Selecciona el curso...</option>
                        @foreach(\App\Models\Course::all() as $course)
                            <option value="{{ $course->id }}">{{$course->nombre}}</option>
                        @endforeach
                    </x-input.select>
                </div>
            </div>

            <!-- Grupo -->
            <div class="block px-4 py-2 space-y-1">
                <div>
                    <x-jet-label for="grupo_filter" value="Grupo"/>
                    <x-input.select wire:model="grupo" id="grupo" class="text-sm block mt-1 w-full" name="grupo" required>
                        <option value="" disabled>Selecciona el grupo...</option>
                        @foreach(\App\Models\Group::all() as $group)
                            <option value="{{ $group->id }}">{{$group->nombre}}</option>
                        @endforeach
                    </x-input.select>
                </div>
            </div> --}}
        </div>

            <!-- Opciones de tabla -->
            <div class="md:flex md:justify-between space-y-2 md:space-y-0">

                <!-- Filtros -->
                <!-- Periodo -->
                {{-- <div class="block px-4 py-2 space-y-1">
                    <div>
                        <x-jet-label for="periodo_filter" value="Periodo"/>
                        <x-input.select wire:model.defer="periodo" id="periodo" class="text-sm block mt-1 w-full" name="periodo" required>
                            <option value="" disabled>Selecciona el periodo...</option>
                            @foreach(\App\Models\Period::all() as $period)
                                <option value="{{ $period->id }}">{{date('d-m-Y', strtotime($period->fecha_inicio))}} a {{date('d-m-Y', strtotime($period->fecha_fin))}}</option>
                            @endforeach
                        </x-input.select>
                    </div>
                </div>

                <!-- Curso -->
                <div class="block px-4 py-2 space-y-1">
                    <div>
                        <x-jet-label for="curso_filter" value="Curso"/>
                        <x-input.select wire:model.defer="curso" id="curso" class="text-sm block mt-1 w-full" name="curso" required>
                            <option value="" disabled>Selecciona el curso...</option>
                            @foreach(\App\Models\Course::all() as $course)
                                <option value="{{ $course->id }}">{{$course->nombre}}</option>
                            @endforeach
                        </x-input.select>
                    </div>
                </div>

                <!-- Grupo -->
                <div class="block px-4 py-2 space-y-1">
                    <div>
                        <x-jet-label for="grupo_filter" value="Grupo"/>
                        <x-input.select wire:model.defer="grupo" id="grupo" class="text-sm block mt-1 w-full" name="grupo" required>
                            <option value="" disabled>Selecciona el grupo...</option>
                            @foreach(\App\Models\Group::all() as $group)
                                <option value="{{ $group->id }}">{{$group->nombre}}</option>
                            @endforeach
                        </x-input.select>
                    </div>
                </div> --}}

                <!-- Parte izquierda -->
                <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Barra de búsqueda -->
                    <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar participante...">
                        <x-icon.search solid class="h-5 w-5 text-gray-400"/>
                    </x-input.icon>
                </div>

                <!-- Parte derecha -->
                <div class="md:flex md:items-center space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Selección de paginación -->
                    <div>
                        <x-input.select wire:model="perPage" class="block w-full">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
                        </x-input.select>
                    </div>
                </div>
            </div>

            <!-- Tabla -->
            <div class="flex flex-col space-y-2">
                <x-table>
                    <x-slot name="head">
                        <x-table.header >Participante</x-table.header>
                        <x-table.header >Departamento</x-table.header>
                        <x-table.header >Curso</x-table.header>
                        <x-table.header >Grupo</x-table.header>
                    </x-slot>

                    @forelse($lists as $l)
                        <tr wire:key="list-{{ $l->id }}" wire:loading.class.delay="opacity-50">
                            <x-table.cell>{{ $l->name }}
                                          {{ $l->apellido_paterno }}
                                          {{ $l->apellido_materno }}</x-table.cell>
                            <x-table.cell>{{ $l->area }} </x-table.cell>
                            <x-table.cell>{{ $l->curso }} </x-table.cell>
                            <x-table.cell>{{ $l->grupo }} </x-table.cell>
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
                    {{ $lists->links() }}
                </div>
            </div>
        </div>

    <!-- Modales -->

</div>
