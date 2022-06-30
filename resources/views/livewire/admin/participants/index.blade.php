<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            PARTICIPANTES
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">

            <!-- Opciones de tabla -->
            <div class="md:flex md:justify-between space-y-2 md:space-y-0">
                <!-- Parte izquierda -->
                <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Barra de búsqueda -->
                    <div class="w-full">
                        <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar participante...">
                            <x-icon.search solid class="h-5 w-5 text-gray-400"/>
                        </x-input.icon>
                        <label><p class="text-xs font-bold">Buscar por: Nombre, rfc o área</p></label>
                    </div>

                    <!-- Filtros -->
                    <x-dropdown width="w-full" align="right" dropdownClasses="md:w-72" content-classes="py-1 bg-white divide-y">
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
                                <button wire:click="resetFilters()" @click="open = false" type="button" title="Reiniciar fitros"
                                        class="inline-flex justify-center w-full rounded-md border hover:border-red-400 shadow-sm px-2 py-2 bg-white text-gray-400 hover:text-red-400 font-medium focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                    <x-icon.trash class="h-5 w-5"/>
                                </button>
                            </div>

                            <!-- Areas -->
                            <div class="block px-4 py-2 space-y-1">
                                <div>
                                    <x-jet-label for="area_filter" value="Area"/>
                                    <x-input.select wire:model="filters.area" id="area_filter" class="text-sm block mt-1 w-full" name="area_filter" required>
                                        <option value="" disabled>Selecciona el área</option>
                                        @foreach(\App\Models\Area::all() as $area)
                                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                        @endforeach
                                    </x-input.select>
                                </div>
                            </div>

                            <!-- Tipo -->
                            <div class="block px-4 py-2 space-y-1">
                                <div>
                                    <x-jet-label for="tipo_filter" value="Tipo"/>
                                    <x-input.select wire:model="filters.tipo" id="tipo_filter" class="text-sm block mt-1 w-full" name="tipo_filter" required>
                                        <option value="" disabled>Selecciona el tipo</option>
                                        <option value="Base">Base</option>
                                        <option value="Interinato">Interinato</option>
                                        <option value="Honorarios">Honorarios</option>
                                    </x-input.select>
                                </div>
                            </div>

                            <!-- Sexo -->
                            <div class="block px-4 py-2 space-y-1">
                                <div>
                                    <x-jet-label for="sexo_filter" value="Sexo"/>
                                    <x-input.select wire:model="filters.sexo" id="sexo_filter" class="text-sm block mt-1 w-full" name="sexo_filter" required>
                                        <option value="" disabled>Selecciona el sexo</option>
                                        <option value="F">Femenino</option>
                                        <option value="M">Masculino</option>
                                    </x-input.select>
                                </div>
                            </div>

                            <!-- Cuenta moodle -->
                            <div class="block px-4 py-2 space-y-1">
                                <div>
                                    <x-jet-label for="moodle_filter" value="Cuenta moodle"/>
                                    <x-input.select wire:model="filters.cuenta_moodle" id="moodle_filter" class="text-sm block mt-1 w-full" name="moodle_filter" required>
                                        <option value="" disabled>Selecciona la opción</option>
                                        <option value="Si">Tiene</option>
                                        <option value="No">No tiene</option>
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
                        <x-table.header wire:click="sortBy('rfc')" sortable :direction="$sortField === 'rfc' ? $sortDirection : null">
                            rfc
                        </x-table.header>
                        <x-table.header wire:click="sortBy('nombre_completo')" sortable :direction="$sortField === 'nombre_completo' ? $sortDirection : null">
                            nombre completo
                        </x-table.header>
                        <x-table.header wire:click="sortBy('area_nombre')" sortable :direction="$sortField === 'area_nombre' ? $sortDirection : null">
                            area
                        </x-table.header>
                        <x-table.header wire:click="sortBy('cuenta_moodle')" sortable :direction="$sortField === 'cuenta_moodle' ? $sortDirection : null">
                            cuenta moodle
                        </x-table.header>
                        <x-table.header>acciones</x-table.header>
                    </x-slot>

                    @forelse($users as $u)
                        <tr wire:key="user-{{ $loop->index }}" wire:loading.class.delay="opacity-50">
                            <x-table.cell>{{ $u->rfc }}</x-table.cell>
                            <x-table.cell>{{ $u->nombre_completo }}</x-table.cell>
                            <x-table.cell>{{ $u->area->nombre ?? '' }}</x-table.cell>
                            <x-table.cell>
                                @if($u->cuenta_moodle === 1)
                                    <x-badge.basic value="Tiene" color="green" large/>
                                @elseif($u->cuenta_moodle === 0)
                                    <x-badge.basic value="No tiene" color="red" large/>
                                @endif
                            </x-table.cell>
                            <x-table.cell>
                                <button wire:click="view({{ $u->id }})" type="button" class="text-indigo-600 hover:text-indigo-900">
                                    <x-icon.eye class="h-6 w-6"/>
                                </button>
                                <button wire:click="edit({{ $u->id }})" type="button" class="text-amber-600 hover:text-amber-900">
                                    <x-icon.pencil alt class="h-6 w-6"/>
                                </button>
                                {{-- <button wire:click="delete({{ $u->id }})" type="button" class="text-red-600 hover:text-red-900"> --}}
                                {{--     <x-icon.trash class="h-6 w-6"/> --}}
                                {{-- </button> --}}
                            </x-table.cell>
                        </tr>
                    @empty
                        <tr>
                            <x-table.cell colspan="5">
                                <div class="flex justify-center items-center space-x-2">
                                    <!-- Icono -->
                                    <svg class="inline-block h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <!-- Texto -->
                                    <span class="py-4 text-xl text-gray-400 font-medium">
                                    No se encontraron resultados ...
                                </span>
                                </div>
                            </x-table.cell>
                        </tr>
                    @endforelse
                </x-table>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modales -->
    @include('livewire.admin.participants.edit')
    @include('livewire.admin.participants.show')
    @include('livewire.admin.participants.confirmation')
</div>
