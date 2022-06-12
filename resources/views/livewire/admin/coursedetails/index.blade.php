<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Detalles de cursos
        </h2>
    </x-slot>
    <div class="space-y-2">
        <!-- Botón de nuevo -->
        <div>
            <x-jet-secondary-button wire:click="create()" class="border-green-300 text-green-700 hover:text-green-500 active:text-green-800 active:bg-green-50">
                <x-icon.plus solid alt="sm" class="inline-block h-5 w-5"/>
                Aregar detalles de curso
            </x-jet-secondary-button>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
            <div class="mt-1 md:w-2/5">
                <x-jet-label for="periodo" value="Periodo"/>
                <x-input.select wire:model="classification.periodo" id="periodo" class="text-sm block mt-1 w-full" name="periodo" required>
                    <option   value="" >Selecciona el periodo...</option>
                    @foreach(\App\Models\Period::all() as $period)
                        <option value="{{ $period->id }}">{{date('d-m-Y', strtotime($period->fecha_inicio))}} a {{date('d-m-Y', strtotime($period->fecha_fin))}}</option>
                    @endforeach
                </x-input.select>
            </div>
    </div>


        <!-- Opciones de tabla -->
        <div class="md:flex md:justify-between space-y-2 md:space-y-0">
            <!-- Parte izquierda -->
            <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                <!-- Barra de búsqueda -->
                <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar curso...">
                    <x-icon.search solid class="h-5 w-5 text-gray-400"/>
                </x-input.icon>

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

                    <!-- Curso -->
                    <div class="block px-4 py-2 space-y-1">
                        <div>
                            <x-jet-label for="departamento_filter" value="Curso"/>
                            <x-input.select wire:model="filters.curso" id="departamento_filter" class="text-sm block mt-1 w-full" name="departamento_filter" required>
                                <option value="" disabled>Selecciona el curso...</option>
                                @foreach(\App\Models\CourseDetail::join('courses','courses.id','=','course_details.course_id')
                                    ->join('periods','periods.id','=', 'course_details.period_id')
                                    ->where('course_details.period_id','=',$classification['periodo'])
                                    ->select('course_details.course_id as id','courses.nombre')
                                    ->get() as $course)
                                    <option value="{{ $course->id }}">{{$course->nombre}}</option>
                                @endforeach
                            </x-input.select>
                        </div>
                    </div>
                    <!-- Modalidad -->
                    ¿<div class="block px-4 py-2 space-y-1">
                        <div>
                            <x-jet-label for="modalidad_filter" value="Modalidad del curso"/>
                                <x-input.select wire:model="filters.modalidad" id="modalidad_filter" class="text-sm block mt-1 w-full" name="modalidad_filter" required>
                                    <option value="" disabled>Selecciona modalidad...</option>
                                    <option value="Presencial" selected>Presencial</option>
                                    <option value="Semi-presencial">Semi-presencial</option>
                                    <option value="En linea">En linea</option>
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
                    <x-input.select wire:model="perPage" class="block w-full">
                        <option value=5>5</option>
                        <option value=10>10</option>
                        <option value=15>15</option>
                        <option value=25>25</option>
                    </x-input.select>
                </div>
            </div>
        </div>
        <!-- Tabla -->
        <div class="flex flex-col space-y-2">
            <x-table>
                <x-slot name="head">
                    <x-table.header wire:click="sortBy('curso')" sortable :direction="$sortField === 'curso' ? $sortDirection : null">
                        Curso
                    </x-table.header>
                    <x-table.header wire:click="sortBy('fecha_inicio')" sortable :direction="$sortField === 'fecha_inicio' ? $sortDirection : null">
                        Periodo
                    </x-table.header>
                    <x-table.header wire:click="sortBy('hora_inicio')" sortable :direction="$sortField === 'hora_inicio' ? $sortDirection : null">
                        Horario
                    </x-table.header>
                    <x-table.header wire:click="sortBy('lugar')" sortable :direction="$sortField === 'lugar' ? $sortDirection : null">
                        Lugar
                    </x-table.header>
                    <x-table.header wire:click="sortBy('capacidad')" sortable :direction="$sortField === 'capacidad' ? $sortDirection : null">
                        Capacidad
                    </x-table.header>
                    <x-table.header wire:click="sortBy('grupo')" sortable :direction="$sortField === 'grupo' ? $sortDirection : null">
                        Grupo
                    </x-table.header>
                    <x-table.header>acciones</x-table.header>
                </x-slot>

                @forelse($detalles as $d)
                    <tr wire:key="detalles-{{ $d->id }}" wire:loading.class.delay="opacity-50">
                        <x-table.cell>{{ $d->curso }}</x-table.cell>
                        <x-table.cell>{{ date('d-m-Y', strtotime($d->fecha_inicio)) }} -
                                      {{ date('d-m-Y', strtotime($d->fecha_fin)) }} </x-table.cell>
                        <x-table.cell>{{ $d->hora_inicio }} -
                                      {{ $d->hora_fin}}</x-table.cell>
                        <x-table.cell>{{ $d->lugar }}</x-table.cell>
                        <x-table.cell>{{ $d->capacidad }}</x-table.cell>
                        <x-table.cell>{{ $d->grupo }}</x-table.cell>
                        <x-table.cell>
                            <button wire:click="view({{ $d->id }})" type="button" class="text-indigo-600 hover:text-indigo-900">
                                <x-icon.eye class="h-6 w-6"/>
                            </button>
                            <button wire:click="edit({{ $d->id }})" type="button" class="text-amber-600 hover:text-amber-900">
                                <x-icon.pencil alt class="h-6 w-6"/>
                            </button>
                            <button wire:click="deleteDetails('{{ $d->id }}','{{ $d->curso }}')" type="button" class="text-red-600 hover:text-red-900">
                                <x-icon.trash class="h-6 w-6"/>
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
                                    No se encontraron registros ...
                                </span>
                            </div>
                        </x-table.cell>
                    </tr>
                @endforelse
            </x-table>
            <div>
                {{ $detalles->links() }}
            </div>
            @if($create)
            @include('livewire.admin.coursedetails.edit_create',['modo'=>'Crear'])
            @elseif($edit)
                        @include('livewire.admin.coursedetails.edit_create',['modo'=>'Actualizar'])
            @endif

            @if($confirmingDetailsDeletion)
                        @include('livewire.admin.coursedetails.destroy')
            @endif

            @if($showViewModal)
                @include('livewire.admin.coursedetails.show')
            @endif
        </div>
    </div>
</div>
