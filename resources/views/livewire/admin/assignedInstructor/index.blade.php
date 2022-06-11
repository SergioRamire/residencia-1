
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Cursos con Instructores
        </h2>
    </x-slot>



    <div class="mt-4 flex-1">
        <div class="flex flex-col space-y-2">
            <div class="row">
                <label class="col-md-3 col-sm-3 text-[20px] ">Periodo</label>
                <div class="col-md-9 col-sm-9 ">
                    <?php $datos = App\Models\Period::find($classification['periodo']); ?>
                    <x-input.icon wire:model="busqPer" class="w-full" type="text"
                        placeholder="Buscar Periodo (ejemplo 31-12-2022) ...">
                        <x-icon.search solid class="h-5 w-5 text-gray-400" />
                    </x-input.icon>
                    @if (strlen($busqPer) > 0)
                        @if (count($datosPer) > 0)
                            <ul class="list-group">
                                @foreach ($datosPer as $period)
                                    <li class="list-group-item list-group-item-action">
                                        <span wire:click="selectPer({{ $period->id }})"
                                            class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                                            Del {{ date('d-m-Y', strtotime($period->fecha_inicio)) }} al {{ date('d-m-Y', strtotime($period->fecha_fin)) }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <span
                                        class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                                        No hay Resultados
                                    </span>
                                </li>
                            </ul>
                        @endif
                    @endif
                    @if (!is_null($datos))
                        
                    <div class="pt-6">
                        <span class="text-[20px]">Perido Elegido: </span>
                        <span>
                            {{-- @if (!is_null($datos)) --}}
                                <span class="text-[20px]">Del {{ date('d-m-Y', strtotime($datos->fecha_inicio)) }} al
                                    {{ date('d-m-Y', strtotime($datos->fecha_fin)) }}</span>
                            {{-- @endif --}}
                        </span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
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
                    {{-- <x-dropdown width="w-full" align="right" dropdownClasses="md:w-72" content-classes="py-4 bg-white divide-y">
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
                    </x-dropdown> --}}
                </div>

                <!-- Parte derecha -->
                <div class="md:flex md:items-center space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Selección de paginación -->
                    {{-- <div>
                        <x-input.select wire:model="perPage" class="block w-full border-green-300 text-green-700 hover:text-green-500 active:text-green-800 active:bg-green-50">
                            <option value=8>8 por página</option>
                            <option value=10>10 por página</option>
                            <option value=25>25 por página</option>
                            <option value=50>50 por página</option>
                            <option value=100>100 por página</option>
                        </x-input.select>
                    </div> --}}
                </div>
            </div>

            <!-- Tabla -->
            <div class="flex flex-col space-y-2">
                <x-table>
                    <x-slot name="head">
                        <x-table.header class="text-center">Curso</x-table.header>
                        <x-table.header class="text-center">Grupo</x-table.header>
                        <x-table.header class="text-center">Horario</x-table.header>
                        <x-table.header class="text-center">Lugar</x-table.header>
                        <x-table.header class="text-center">Instructor</x-table.header>
                        <x-table.header class="text-center">Accion</x-table.header>
                    </x-slot>

                    @forelse($datosTabla as $g)
                        <tr wire:key="instructor-{{$loop->index}}" wire:loading.class.delay="opacity-50">
                            <x-table.cell class="text-center">{{ $g->cnombre }}</x-table.cell>
                            <x-table.cell class="text-center">{{ $g->gnombre }}</x-table.cell>
                            <x-table.cell class="text-center">{{date('d-m-Y', strtotime($g->f1))}} a {{date('d-m-Y', strtotime($g->f2))}}</x-table.cell>
                            <x-table.cell class="text-center">{{ $g->lugar }}</x-table.cell>
                            <x-table.cell class="text-center">{{ $g->unombre }}{{' '}}{{ $g->ap1nombre }}{{' '}}{{ $g->ap1nombre }}</x-table.cell>
                            <x-table.cell class="text-center">Accion</x-table.cell>
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
                {{-- <div>
                    {{ $instructor->links()}}
                </div> --}}
            </div>
        </div>
    </div>
</div>



@if (false)
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Asignacion de Instructor
        </h2>
    </x-slot>

    <div class="space-y-2">
        <!-- Tabla -->
        <div class="flex flex-col space-y-2">
            <!-- Periodo -->
            <div class="mt-4">
                <x-jet-label for="periodo" value="Periodo"/>
                <x-input.select wire:model="classification.periodo" class="mt-1 w-full" id="id_period" name="id_period" required>
                    <option value="" >Selecciona el Periodo</option>
                    @foreach(\App\Models\Period::all() as $period)
                        <option value="{{ $period->id }}">{{date('d-m-Y', strtotime($period->fecha_inicio))}} a {{date('d-m-Y', strtotime($period->fecha_fin))}}</option>
                    @endforeach
                </x-input.select>
            </div>
            <!-- INstructor -->
            <div>
            <div class="mt-4 sm:items-baselin sm:gap-x-1.5">
                <x-jet-label for="instructor" value="Nombre del participante"/>
                <x-input.select wire:model="id_instructor" class="mt-1 w-full" id="instructor" name="instructor" required>
                    <option value="">Selecciona el Instructor </option>
                    @foreach($datosuser as $u)
                        <option value="{{ $u->id }}"> {{ $u->name }} {{ $u->apellido_paterno }} {{ $u->apellido_materno }} RFC: {{ $u->rfc }}</option>
                    @endforeach
                </x-input.select>
            </div>
            </div>
            <!-- Curso y Grupo -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Cyrso -->
                <div class="mt-4 sm:flex-1">

                <x-jet-label for="curso" value="Curso"/>
                <x-input.select wire:model="classification.curso" class="mt-1 w-full" id="curso" name="curso" required>
                    <option value="" >Selecciona el Curso</option>
                    @foreach(\App\Models\CourseDetail::join('courses','courses.id','=','course_details.course_id')
                                ->join('periods','periods.id','=', 'course_details.period_id')
                                ->where('course_details.period_id','=',$classification['periodo'])
                                ->select('course_details.course_id as id','courses.nombre')
                                ->distinct()
                                ->get() as $course)
                                <option value="{{ $course->id }}">{{$course->nombre}}</option>
                    @endforeach
                </x-input.select>
            </div>
            <!-- grupo -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label for="grupo" value="Grupo"/>
                <x-input.select wire:model="classification.grupo" class="mt-1 w-full" id="grupo" name="grupo" required>
                    <option value="" >Selecciona el Grupo</option>
                    @foreach(\App\Models\CourseDetail::join('groups','groups.id','=','course_details.group_id')
                                ->join('periods','periods.id','=', 'course_details.period_id')
                                ->where('course_details.period_id','=',$classification['periodo'])
                                ->where('course_details.course_id','=',$classification['curso'])
                                ->select('course_details.group_id as id','groups.nombre')
                                ->distinct()
                                ->get() as $group)
                                <option value="{{ $group->id }}">{{$group->nombre}}</option>
                    @endforeach
                </x-input.select>
            </div>
        </div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- lugar -->
                <div class="mt-4 flex-1">
                    <x-jet-label for="lugar" value="lugar" />
                    <x-jet-input wire:model="lugar" class="block mt-1 w-full" type="text" disabled/>
                </div>
                <!-- hora inicio -->
                <div class="mt-4 flex-1">
                    <x-jet-label for="horario1" value="Hora de inicio:" />
                    <x-jet-input wire:model="horai" class="block mt-1 w-full" type="time" disabled/>
                </div>
                <!-- hora fin -->
                <div class="mt-4 flex-1">
                    <x-jet-label for="horario2" value="Hora de fin:" />
                    <x-jet-input wire:model="horaf" class="block mt-1 w-full" type="time" disabled/>
                </div>
            </div>

            <div class="mt-4 flex justify-end">
                <x-jet-button wire:click="registrar()" type="button">
                    Asignar Instructor
                </x-jet-button>
            </div>
        </div>
    </div>
</div>
@endif