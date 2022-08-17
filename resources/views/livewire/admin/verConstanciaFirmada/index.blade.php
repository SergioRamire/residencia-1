<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            CONSTANCIAS FIRMADAS
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">

            <!-- Opciones de tabla -->
            <div class="md:flex md:justify-between space-y-2 md:space-y-0">
                <!-- Parte izquierda -->
                <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Barra de búsqueda -->

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
                        {{-- <x-table.header wire:click="sortBy('size')" sortable :direction="$sortField === 'size' ? $sortDirection : null"> --}}
                        {{--     grupo --}}
                        {{-- </x-table.header> --}}
                        <x-table.header>
                            nombre
                        </x-table.header>
                        <x-table.header>
                            curso
                        </x-table.header>
                        <x-table.header>
                            grupo
                        </x-table.header>
                        <x-table.header>
                            periodo
                        </x-table.header>
                        <x-table.header>
                            fecha
                        </x-table.header>
                        <x-table.header>
                            hora
                        </x-table.header>
                        <x-table.header>acciones</x-table.header>
                    </x-slot>

{{--                    {{ dd($consulta) }}--}}

                    @forelse($constancias as $constancia)
                        <tr wire:key="backup-{{ $loop->index }}" wire:loading.class.delay="opacity-50">
                            <x-table.cell>{{ "$constancia->nombre $constancia->apellido_paterno $constancia->apellido_materno" }}</x-table.cell>
                            <x-table.cell>{{ $constancia->curso_nombre }}</x-table.cell>
                            <x-table.cell>{{ $constancia->grupo_nombre }}</x-table.cell>
                            <x-table.cell>{{ $constancia->periodo_clave }}</x-table.cell>
                            <x-table.cell>{{ "$constancia->fecha_inicio - $constancia->fecha_fin" }}</x-table.cell>
                            <x-table.cell>{{ "$constancia->hora_inicio - $constancia->hora_fin" }}</x-table.cell>
                            <x-table.cell width='200' class="whitespace-nowrap">
                                <button wire:click="descargar_constancia_firmada('{{ $constancia->url_cedula }}')" type="button" title="Descargar constancia firmada" class="mr-1 px-2 bg-white hover:text-white hover:bg-amber-500 text-black font-bold border border-amber-400 rounded shadow" >
                                    Descargar
                                </button>
                                <button wire:click="ver_constancia_firmada('{{ $constancia->url_cedula }}')" type="button" title="Ver constancia firmada" class="ml-1 px-2 bg-white hover:text-white hover:bg-green-600 text-black font-bold border border-green-400 rounded shadow">
                                    Ver
                                </button>
                            </x-table.cell>
                        </tr>
                    @empty
                        <tr>
                             Cambia el número según el numero de columnas
                            <x-table.cell colspan="5">
                                <div class="flex justify-center items-center space-x-2">
                                    <!-- Icono -->
                                    <svg class="inline-block h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <!-- Texto -->
                                    <span class="py-4 text-xl text-gray-400 font-medium">
                                    No hay constancias firmadas ...
                                </span>
                                </div>
                            </x-table.cell>
                        </tr>
                    @endforelse
                </x-table>
                <div>
{{--                    {{ $backups->links() }}--}}
                </div>

            </div>
        </div>
    </div>

</div>