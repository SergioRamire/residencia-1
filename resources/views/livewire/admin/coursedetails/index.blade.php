<div>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @endpush
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            DETALLES DE CURSOS
        </h2>
    </x-slot>

    <div class="space-y-2">

        <!-- Botón de nuevo -->
        <div>
            <x-jet-secondary-button wire:click="create()"
                class="border-[#1b396a] text-sky-700 hover:text-sky-500 active:text-[#1b396a] active:bg-sky-50">
                <x-icon.plus solid alt="sm" class="inline-block h-5 w-5" />
                Aregar detalles de curso
            </x-jet-secondary-button>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5 pb-6">
            <div class="mt-4 flex-1">
                <x-jet-label value="Seleccione el periodo"/>
                @livewire('admin.period-select')
            </div>
            <div class="mt-4 flex-1"></div>
        </div>
        <!-- Opciones de tabla -->
        <div class="md:flex md:justify-between space-y-2 md:space-y-0">
            <!-- Parte izquierda -->
            <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                <!-- Barra de búsqueda -->
                <div class="w-full">
                    <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar curso...">
                        <x-icon.search solid class="h-5 w-5 text-gray-400" />
                    </x-input.icon>
                    <label><p class="text-xs font-bold">Buscar por: Curso, periodo, horario, lugar, capacidad o grupo</p></label>
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
                    <x-table.header wire:click="sortBy('clave')" sortable :direction="$sortField === 'clave' ? $sortDirection : null">
                        Clave del curso
                    </x-table.header>
                    <x-table.header wire:click="sortBy('curso')" sortable :direction="$sortField === 'curso' ? $sortDirection : null">
                        Curso
                    </x-table.header>
                    <x-table.header wire:click="sortBy('hora_inicio')" sortable :direction="$sortField === 'hora_inicio' ? $sortDirection : null">
                        Horario
                    </x-table.header>
                    <x-table.header wire:click="sortBy('lugar')" sortable :direction="$sortField === 'lugar' ? $sortDirection : null">
                        Lugar
                    </x-table.header>
                    <x-table.header wire:click="sortBy('grupo')" sortable :direction="$sortField === 'grupo' ? $sortDirection : null">
                        Grupo
                    </x-table.header>
                    <x-table.header>acciones</x-table.header>
                </x-slot>

                @forelse($detalles as $d)
                    <tr wire:key="detalles-{{ $d->id }}" wire:loading.class.delay="opacity-50">
                        <x-table.cell>{{ $d->clave }}</x-table.cell>
                        <x-table.cell>{{ $d->curso }}</x-table.cell>
                        <x-table.cell>{{ $d->hora_inicio }} -
                            {{ $d->hora_fin }}</x-table.cell>
                        <x-table.cell>{{ $d->lugar }}</x-table.cell>
                        <x-table.cell>{{ $d->grupo }}</x-table.cell>
                        <x-table.cell>
                            <button  wire:click="view({{ $d->id }})" type="button" title="Ver más información" class="px-4 bg-white hover:text-white hover:bg-[#1b396a] text-black font-bold border border-sky-400 rounded shadow" >
                                Ver
                            </button>
                            <button  wire:click="edit({{ $d->id }})" type="button" title="Editar información" class="px-4 bg-white hover:text-white hover:bg-amber-500 text-black font-bold border border-amber-400 rounded shadow" >
                                Editar
                            </button>
                            <button wire:click="deleteDetails('{{ $d->id }}','{{ $d->curso }}')" type="button" title="Eliminar detalles" class="px-4 bg-white hover:text-white hover:bg-red-600 text-black font-bold border border-red-400 rounded shadow">
                                Eliminar
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
                {{ $detalles->links() }}
            </div>
            {{-- <div class="text-right min-h-full">
                @if($detalles->count() > 0)
                    <button wire:click="downloadPdf()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/>
                        </svg>
                        <span>Lista</span>
                    </button>
                @endif
            </div> --}}
            @if ($create)
                @include('livewire.admin.coursedetails.edit_create', ['modo' => 'Crear'])
            @elseif($edit)
                @include('livewire.admin.coursedetails.edit_create', ['modo' => 'Actualizar'])
            @endif

            @if ($confirmingDetailsDeletion)
                @include('livewire.admin.coursedetails.destroy')
            @endif

            @if ($showViewModal)
                @include('livewire.admin.coursedetails.show')
            @endif
        </div>
    </div>
</div>

