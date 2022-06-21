<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            PERIODOS DE CURSOS
        </h2>
    </x-slot>
    <div class="space-y-2">
        <!-- Botón de nuevo -->
        <div>
            <x-jet-secondary-button wire:click="create()" class="border-sky-800 text-sky-700 hover:text-sky-500 active:text-sky-800 active:bg-sky-50">
                <x-icon.plus solid alt="sm" class="inline-block h-5 w-5" />
                Nuevo Periodo
            </x-jet-secondary-button>
        </div>
        <!-- Opciones de tabla -->
        <span class="mx-4 text-gray-500"></span>
        <div class="md:flex md:justify-between space-y-2 md:space-y-0">
            <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                <div>
                    <x-jet-label for="desde" value="Desde" class="text-lg" />
                    <x-input.error wire:model="filters" class="block mt-1 w-full" type="date" id="fecha_inicio" name="fecha_inicio" for="fecha_inicio" required />
                </div>
                <div>
                    <x-jet-label for="hasta" value="Hasta" class="text-lg" />
                    <x-input.error wire:model="filters2" class="block mt-1 w-full" type="date" id="fecha_fin" name="fecha_fin" for="fecha_fin" required />
                </div>
                <div class="flex items-end">
                    <x-jet-secondary-button wire:click="resetFilters()" title="Reiniciar fitros" class="border-red-300 text-red-700 hover:text-red-500 active:text-red-800 active:bg-green-50">
                        <x-icon.trash solid alt="sm" class="inline-block h-5 w-5" />
                    </x-jet-secondary-button>
                </div>
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
                    {{-- <x-table.header >Número</x-table.header> --}}
                    <x-table.header wire:click="sortBy('clave')" sortable :direction="$sortField === 'clave' ? $sortDirection : null">
                        Clave
                    </x-table.header>
                    <x-table.header wire:click="sortBy('fecha_inicio')" sortable :direction="$sortField === 'fecha_inicio' ? $sortDirection : null">
                        Fecha de inicio
                    </x-table.header>
                    <x-table.header wire:click="sortBy('fecha_fin')" sortable :direction="$sortField === 'fecha_fin' ? $sortDirection : null">
                        Fecha de finalización</x-table.header>
                    <x-table.header>Estado</x-table.header>
                    <x-table.header>acciones</x-table.header>

                </x-slot>

                @forelse($periods as $p)
                    <tr wire:key="period-{{ $p->id }}" wire:loading.class.delay="opacity-50">
                        <x-table.cell>{{ $p->clave }}</x-table.cell>
                        <x-table.cell>{{ date('d-m-Y', strtotime($p->fecha_inicio)) }}</x-table.cell>
                        <x-table.cell>{{ date('d-m-Y', strtotime($p->fecha_fin)) }}</x-table.cell>
                        <x-table.cell>
                            @if($p->estado === 1)
                                <x-badge.basic value="Activo" color="green" large/>
                            @elseif($p->estado === 0)
                                <x-badge.basic value="Inactivo" color="red" large/>
                            @endif
                        </x-table.cell>
                        <x-table.cell>
                            <button wire:click="edit({{ $p->id }})" type="button" title="Editar Periodo" class="text-amber-600 hover:text-amber-900">
                                <x-icon.pencil alt class="h-6 w-6" />
                            </button>
                            <button
                                wire:click="deletePeriod('{{ $p->id }}','{{ $p->fecha_inicio }}','{{ $p->fecha_fip }}')" type="button" title="Eliminar Periodo" class="text-red-600 hover:text-red-900">
                                <x-icon.trash class="h-6 w-6" />
                            </button>
                            <button wire:click="periodoActivar({{ $p->id }})" type="button" title="Activar Periodo" class="text-green-900 hover:text-sky-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                  </svg>
                            <button wire:click="periodoDesactivar({{ $p->id }})" type="button" title="Desactivar Periodo" class="text-stone-900 hover:text-sky-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                  </svg>
                            <button wire:click="cambiodeRol()" type="button" title="Desactivar Periodo" class="text-stone-900 hover:text-sky-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                      </svg>
                        </x-table.cell>
                    </tr>
                    {{-- @php $numero=$numero+1 @endphp --}}
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
                {{ $periods->links() }}
            </div>
            @if ($create)
                @include('livewire.admin.periodCourses.edit_create', ['modo' => 'Crear'])
            @elseif($edit)
                @include('livewire.admin.periodCourses.edit_create', [ 'modo' => 'Actualizar', ])
            @endif
            @if ($confirmingPeriodDeletion)
                @include('livewire.admin.periodCourses.destroy')
            @endif
            @if ($confirmingPeriodActive)
                @include('livewire.admin.periodCourses.confirmationActive')
            @elseif($confirmingPeriodInactive)
                @include('livewire.admin.periodCourses.confirmationInactive')
            @endif
        </div>
    </div>
</div>
