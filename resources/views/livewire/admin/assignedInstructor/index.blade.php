<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            ASIGNACIÓN DE INSTRUCTORES A CURSOS
        </h2>
    </x-slot>

    <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
        <div class="mt-4 flex-1">
            <x-jet-label value="Seleccione el periodo"/>
            @livewire('admin.period-select')
        </div>
        <div class="mt-4 flex-1">
            <x-jet-label value="Seleccione el curso"/>
            @livewire('admin.course-details-select')
        </div>
    </div>

    <div class="max-w-7xl mx-auto pt-6 pb-10">
        <div class="space-y-2">
            <!-- Opciones de tabla -->
            <div class="md:flex md:justify-between space-y-2 md:space-y-0">
                <!-- Parte izquierda -->
                <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Barra de búsqueda -->
                    <div class="w-full">
                        <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar...">
                            <x-icon.search solid class="h-5 w-5 text-gray-400" />
                        </x-input.icon>
                        <label><p class="text-xs font-bold">Buscar por: Curso, grupo, lugar y horario</p></label>
                    </div>

                
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
                        <x-table.header class="text-center">Lugar</x-table.header>
                        <x-table.header class="text-center">Horario</x-table.header>
                        <x-table.header class="text-center">Accion</x-table.header>
                    </x-slot>

                    @forelse($datosTabla as $g)
                        <tr wire:key="instructor-{{ $loop->index }}" wire:loading.class.delay="opacity-50">
                            <x-table.cell >{{ $g->cnombre }}</x-table.cell>
                            <x-table.cell class="text-center">{{ $g->gnombre }}</x-table.cell>
                            <x-table.cell class="text-center">{{ $g->lugar }}</x-table.cell>
                            <x-table.cell class="text-center">{{ date('d-m-Y', strtotime($g->f1)) }} a
                                {{ date('d-m-Y', strtotime($g->f2)) }}</x-table.cell>
                            <x-table.cell class="text-center">
                                <button wire:click="openModalCreate({{ $g->idcurdet }})" type="button" title="Agregar instructor" class="text-green-600 hover:text-green-900">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                                    </svg>
                                </button>
                                <button wire:click="openModalShow({{ $g->idcurdet }})" type="button" title="Ver instructor" class="text-blue-600 hover:text-blue-900">
                                    <x-icon.eye alt class="h-6 w-6"/>
                                </button>


                            </x-table.cell>
                        </tr>
                    @empty
                        <tr>
                            <x-table.cell colspan="7">
                                <div class="flex justify-center items-center space-x-2">
                                    <!-- Icono -->
                                    <svg class="inline-block h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
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
                    {{ $datosTabla->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('livewire.admin.assignedInstructor.edit')
    @include('livewire.admin.assignedInstructor.confirmation')
</div>
