<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Cursos con Instructores
        </h2>
    </x-slot>

    <div wire:ignore>
        <x-input.select wire:model="filters.fecha_inicio" id="periodo_id" class="text-sm block mt-1 w-full" required>
            <option value="">Todas las Fechas</option>
            @foreach(\App\Models\Period::all() as $period)
              <option value="{{$period->fecha_inicio}}">{{date('d-m-Y', strtotime($period->fecha_inicio))}}</option>
            @endforeach
        </x-input.select>
    </div>
    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">
            <!-- Opciones de tabla -->
            <div class="md:flex md:justify-between space-y-2 md:space-y-0">
                <!-- Parte izquierda -->
                <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Barra de búsqueda -->
                    <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar...">
                        <x-icon.search solid class="h-5 w-5 text-gray-400"/>
                    </x-input.icon>


                    <!-- Filtros -->
                    <x-dropdown width="w-full" align="right" dropdownClasses="md:w-72" content-classes="py-4 bg-white divide-y">
                        <x-slot name="trigger">
                            <button class="inline-flex justify-center w-full rounded-md border hover:border-gray-400 shadow-sm px-2.5 py-2.5 bg-white font-medium focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" :class="open ? 'text-indigo-400 hover:text-indigo-500 border-sky-800' : 'text-gray-400 hover:text-gray-500 border-sky-800'">
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
                                <button wire:click="resetFilters2()" @click="open = false" type="button" title="Reiniciar fitros"
                                        class="inline-flex justify-center w-full rounded-md border hover:border-red-400 shadow-sm px-2 py-2 bg-white text-gray-400 hover:text-red-400 font-medium focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                    <x-icon.trash class="h-5 w-5"/>
                                </button>
                            </div>

                            <!-- Cursos -->
                            <div class="block px-4 py-2 space-y-1">
                                <div>
                                    <x-jet-label for="filtro_curso" value="Curso"/>
                                    <x-input.select wire:model="filters.filtro_curso" name="filtro_curso" id="filtro_curso" class="text-sm block mt-1 w-full" required>
                                        <option value="" disabled>Selecciona curso...</option>
                                        @foreach(\App\Models\Course::all() as $course)
                                            <option value="{{$course->nombre}}">{{$course->nombre}}</option>
                                        @endforeach
                                    </x-input.select>
                                </div>
                            </div>

                            <!-- fecha inicio -->
                            <div class="block px-4 py-2 space-y-1">
                                <div>
                                    <x-jet-label for="fecha_inicio" value="Fecha Inicio"/>
                                    <x-input.select wire:model="filters.fecha_inicio" name="fecha_inicio" id="fecha_inicio" class="text-sm block mt-1 w-full" required>
                                        <option value="">Todas las Fechas</option>
                                        @foreach(\App\Models\Period::all() as $period)
                                          <option value="{{$period->fecha_inicio}}">{{date('d-m-Y', strtotime($period->fecha_inicio))}}</option>
                                        @endforeach
                                    </x-input.select>
                                </div>
                            </div>

                            <!-- fehc fin -->
                            <div class="block px-4 py-2 space-y-1">
                                <div>
                                    <x-jet-label for="fecha_fin" value="Fecha Fin"/>
                                    <x-input.select wire:model="filters.fecha_fin" name="fecha_fin" id="fecha_fin" class="text-sm block mt-1 w-full" required>
                                        <option value="">Todas las Fechas</option>
                                        @foreach(\App\Models\Period::all() as $period)
                                          <option value="{{$period->fecha_fin}}">{{date('d-m-Y', strtotime($period->fecha_fin))}}</option>
                                        @endforeach
                                    </x-input.select>
                                </div>
                            </div>

                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Parte derecha -->
                <div class="md:flex md:items-center space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Selección de paginación -->
                    <div>
                        <x-input.select wire:model="perPage" class="block w-full border-green-300 text-green-700 hover:text-green-500 active:text-green-800 active:bg-green-50">
                            <option value=8>8 por página</option>
                            <option value=10>10 por página</option>
                            <option value=25>25 por página</option>
                            <option value=50>50 por página</option>
                            <option value=100>100 por página</option>
                        </x-input.select>
                    </div>
                </div>
            </div>

            <!-- Tabla -->
            <div class="flex flex-col space-y-2">
                <x-table>
                    <x-slot name="head">
                        <x-table.header class="text-center">Instructor</x-table.header>
                        <x-table.header class="text-center">Curso</x-table.header>
                        <x-table.header class="text-center">Grupo</x-table.header>
                        <x-table.header class="text-center">Fecha</x-table.header>
                    </x-slot>

                    @forelse($instructor as $g)
                        <tr wire:key="instructor-{{$loop->index}}" wire:loading.class.delay="opacity-50">
                            <x-table.cell>{{ $g->name }} {{ $g->apellido_paterno }} {{ $g->apellido_materno }}</x-table.cell>
                            <x-table.cell class="text-center">{{ $g->curso }}</x-table.cell>
                            <x-table.cell class="text-center">{{ $g->nombregrupo }}</x-table.cell>
                            <x-table.cell class="text-center">{{date('d-m-Y', strtotime($g->fi))}} a {{date('d-m-Y', strtotime($g->ff))}}</x-table.cell>
                        </tr>
                    @empty
                        <tr>
                            <x-table.cell colspan="7">
                                <div class="flex justify-center items-center space-x-2">
                                    <!-- Icono -->
                                    <svg class="inline-block h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
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
                    {{ $instructor->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('livewire:load', function() {
        $('#periodo_id').select2();
        $('#periodo_id').on('change', function() {
            @this.set('filters.fecha_inicio', this.value);
        });
    });
</script>
