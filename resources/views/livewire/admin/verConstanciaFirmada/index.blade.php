<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            CONSTANCIAS FIRMADAS
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5 pb-6">
                <div class="mt-4 flex-1">
                    <x-jet-label value="Seleccione el período"/>
                    @livewire('admin.period-select')
                </div>
                <div class="mt-4 flex-1">
                    <x-jet-label value="Seleccione el curso"/>
                    @livewire('admin.course-details-select')
                </div>
            </div>

            <!-- Opciones de tabla -->
            <div class="md:flex md:justify-between space-y-2 md:space-y-0">
                <!-- Parte izquierda -->
                <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                     <!-- Barra de búsqueda -->
                     <div class="w-full">
                        <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar participante...">
                           <x-icon.search solid class="h-5 w-5 text-gray-400"/>
                        </x-input.icon>
                        <label><p class="text-xs font-bold">Buscar por: nombre del participante o grupo</p></label>
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
                        <x-table.header class="text-center"> nombre</x-table.header>
                        <x-table.header class="text-center">curso</x-table.header>
                        <x-table.header>grupo</x-table.header>
                        <x-table.header class="text-center">periodo</x-table.header>
                        <x-table.header class="text-center">fecha</x-table.header>
                        <x-table.header class="text-center">hora</x-table.header>
                        <x-table.header class="text-center">acciones</x-table.header>
                    </x-slot>

                    @forelse($constancias as $constancia)
                        <tr wire:key="backup-{{ $loop->index }}" wire:loading.class.delay="opacity-50">
                            <x-table.cell>{{ "$constancia->nombre $constancia->apellido_paterno $constancia->apellido_materno" }}</x-table.cell>
                            <x-table.cell>{{ $constancia->curso_nombre }}</x-table.cell>
                            <x-table.cell class="text-center">{{ $constancia->grupo_nombre }}</x-table.cell>
                            <x-table.cell class="text-center">{{ $constancia->periodo_clave }}</x-table.cell>
                            <x-table.cell>{{ "$constancia->fecha_inicio - $constancia->fecha_fin" }}</x-table.cell>
                            <x-table.cell>{{ "$constancia->hora_inicio - $constancia->hora_fin" }}</x-table.cell>
                            <x-table.cell width='200' class="whitespace-nowrap text-center">
                                <button wire:click="descargar_constancia_firmada('{{ $constancia->url_cedula }}')" type="button" title="Descargar constancia firmada" class="mr-1 px-2 bg-white hover:text-white hover:bg-amber-500 text-black font-bold border border-amber-400 rounded shadow" >
                                    Descargar
                                </button>
                                {{-- <button wire:click="ver_constancia_firmada('{{ $constancia->url_cedula }}')" type="button" title="Ver constancia firmada" class="ml-1 px-2 bg-white hover:text-white hover:bg-green-600 text-black font-bold border border-green-400 rounded shadow">
                                    Ver
                                </button> --}}
                                <a href="/storage/{{$constancia->url_cedula }}" target="_blank" type="button" title="Ver constancia firmada" class="ml-1 px-2 bg-white hover:text-white hover:bg-green-600 text-black font-bold border border-green-400 rounded shadow">
                                    Ver
                                </a>
                                {{-- <a href="/storage/{{$constancia->url_cedula }}" target="_blank">Mi PDF</a> --}}
                            </x-table.cell>
                        </tr>
                    @empty
                        <tr
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
