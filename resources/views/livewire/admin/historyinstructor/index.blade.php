<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Historial de Instructores
        </h2>
    </x-slot>
    <div class="space-y-2">


        <div class="space-y-2">
            <div class="flex flex-wrap">
                <div class="md:w-1/2 max-w-xs col-start pr-1">
                    <x-jet-label for="desde" value="Desde" class="text-lg" />
                    <x-input.error wire:model="filters1" class="block mt-1 w-full border-[#1b396a] text-[#1b396a] hover:text-white hover:bg-[#1b396a] active:text-sky-50 active:bg-sky-500" type="date" id="fecha_inicio" name="fecha_inicio" for="fecha_inicio" required />
                </div>
                <div class="md:w-1/2 max-w-xs col-start pr-1">
                    <x-jet-label for="hasta" value="Hasta" class="text-lg" />
                    <x-input.error wire:model="filters2" class="block mt-1 w-full border-[#1b396a] text-[#1b396a] hover:text-white hover:bg-[#1b396a] active:text-sky-50 active:bg-sky-500" type="date" id="fecha_fin" name="fecha_fin" for="fecha_fin" required />
                </div>
                <div class="w-auto pr-2 flex items-end">
                    <x-dropdown width="w-full h-11" align="right" dropdownClasses="md:w-72" content-classes="py-4 bg-white divide-y">
                        <x-slot name="trigger">
                            <button class="inline-flex justify-center w-full rounded-md border hover:border-[#1b396a] shadow-sm px-2.5 py-2.5 bg-white font-medium focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" :class="open ? 'text-indigo-400 hover:text-indigo-500 border-[#1b396a]' : 'text-gray-400 hover:text-gray-500 border-[#1b396a]'">
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
                                        class="inline-flex justify-center w-full rounded-md border hover:border-[#1b396a] shadow-sm px-2 py-2 bg-white text-gray-400 hover:text-red-400 font-medium focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                    <x-icon.trash class="h-5 w-5"/>
                                </button>
                            </div>

                            <!-- Cursos -->
                            <div class="block px-4 py-2 space-y-1">
                                <div>
                                    <x-jet-label for="filtro_curso" value="Curso"/>
                                    @livewire('admin.course-select')
                                </div>
                            </div>
                            <div class="block px-4 py-2 space-y-1">
                                <div>
                                    <x-jet-label for="perfil" value="Perfil"/>

                                    <x-input.select wire:model="filters.filtro_perfil" id="perfil" class="mt-1 w-full" name="perfil" required>
                                        <option value="" disabled>Selecciona perfil...</option>
                                        <option value="Formación docente">Formación docente</option>
                                        <option value="Actualización profesional">Actualización profesional</option>
                                    </x-input.select>
                                </div>
                            </div>
                            <div class="block px-4 py-2 space-y-1">
                                <div>
                                    <x-jet-label for="perfil" value="Organización"/>
                                    <x-input.select wire:model="filters.filtro_organizacion" id="perfil" class="mt-1 w-full" name="perfil" required>
                                        <option value="" disabled>Selecciona perfil...</option>
                                        @foreach (App\Models\User::select('users.organizacion_origen')->distinct()->get() as $item)
                                            <option value="{{$item->organizacion_origen}}">{{$item->organizacion_origen}}</option>
                                        @endforeach
                                    </x-input.select>
                                </div>
                            </div>

                        </x-slot>
                    </x-dropdown>
                </div>
                <div class="w-auto pr-2 flex items-end">
                    <x-jet-secondary-button wire:click="resetFilters()" title="Reiniciar fitros" class="h-11 border-red-300 text-red-700 hover:text-red-500 active:text-red-800 active:bg-green-50">
                        borrar filtro
                    </x-jet-secondary-button>
                </div>

            </div>

            <!-- Parte derecha -->
            <div class="flex justify-end">
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
                    <x-table.header wire:click="sortBy('nombre')" sortable :direction="$sortField === 'nombre' ? $sortDirection : null">
                        RFC
                    </x-table.header>
                    <x-table.header wire:click="sortBy('cl')" sortable :direction="$sortField === 'cl' ? $sortDirection : null">
                        Nombre
                    </x-table.header>
                    <x-table.header wire:click="sortBy('cl')" sortable :direction="$sortField === 'cl' ? $sortDirection : null">
                        Clave
                    </x-table.header>
                    <x-table.header wire:click="sortBy('perfil')" sortable :direction="$sortField === 'perfil' ? $sortDirection : null">
                        Nombre Curso
                    </x-table.header>
                    <x-table.header wire:click="sortBy('gnom')" sortable :direction="$sortField === 'perfil' ? $sortDirection : null">
                        Grupo
                    </x-table.header>
                    <x-table.header wire:click="sortBy('clave')" sortable :direction="$sortField === 'gnom' ? $sortDirection : null">
                        Periodo
                    </x-table.header>

                </x-slot>

                @forelse($history as $h)
                    <tr wire:key="period-{{$loop->index}}" wire:loading.class.delay="opacity-50">

                        <x-table.cell>{{ $h->rfc }}</x-table.cell>
                        <x-table.cell>{{ $h->name }} {{ $h->ap1 }} {{ $h->ap2 }}</x-table.cell>
                        <x-table.cell>{{ $h->cl }}</x-table.cell>
                        <x-table.cell>{{ $h->nom }}</x-table.cell>
                        <x-table.cell>{{ $h->gnom }}</x-table.cell>
                        <x-table.cell>{{ $h->clave }}</x-table.cell>

                    </tr>
                @empty
                    <tr>
                        <x-table.cell colspan="7">
                            <div class="flex justify-center items-center space-x-2">
                                <svg class="inline-block h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <span class="py-4 text-xl text-gray-400 font-medium">
                                    No se encontraron registros ...
                                </span>
                            </div>
                        </x-table.cell>
                    </tr>
                @endforelse
            </x-table>
            <div>
                {{ $history->links() }}
            </div>
        </div>
    </div>
</div>
