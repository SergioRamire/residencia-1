<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Historial de cursos
        </h2>
    </x-slot>
    <div class="space-y-2">

        <!-- Opciones de tabla -->
        <div class="space-y-2">
            <div class="flex flex-wrap">
                <div class="md:w-1/2 max-w-xs col-start pr-1">
                    <x-jet-label for="desde" value="Desde" class="text-lg" />
                    <x-input.error wire:model="filters" class="block mt-1 w-full border-[#1b396a] text-[#1b396a] hover:text-white hover:bg-[#1b396a] active:text-sky-50 active:bg-sky-500" type="date" id="fecha_inicio" name="fecha_inicio" for="fecha_inicio" required />
                </div>
                <div class="md:w-1/2 max-w-xs col-start pr-1">
                    <x-jet-label for="hasta" value="Hasta" class="text-lg" />
                    <x-input.error wire:model="filters2" class="block mt-1 w-full border-[#1b396a] text-[#1b396a] hover:text-white hover:bg-[#1b396a] active:text-sky-50 active:bg-sky-500" type="date" id="fecha_fin" name="fecha_fin" for="fecha_fin" required />
                </div>
            </div>

            <!-- Parte derecha -->
            <div class="flex justify-between">
                <div>
                    <x-jet-secondary-button wire:click="resetFilters()" title="Reiniciar fitros" class="border-red-300 text-red-700 hover:text-red-500 active:text-red-800 active:bg-green-50">
                        borrar filtro
                    </x-jet-secondary-button>
                </div>
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
                    <x-table.header wire:click="sortBy('cl')" sortable :direction="$sortField === 'cl' ? $sortDirection : null">
                        clave
                    </x-table.header>
                    <x-table.header wire:click="sortBy('nombre')" sortable :direction="$sortField === 'nombre' ? $sortDirection : null">
                        nombre
                    </x-table.header>
                    <x-table.header wire:click="sortBy('perfil')" sortable :direction="$sortField === 'perfil' ? $sortDirection : null">
                        perfil
                    </x-table.header>
                    <x-table.header wire:click="sortBy('percla')" sortable :direction="$sortField === 'percla' ? $sortDirection : null">
                        Periodo
                    </x-table.header>

                </x-slot>

                @forelse($history as $h)
                    <tr wire:key="period-{{$loop->index}}" wire:loading.class.delay="opacity-50">

                        <x-table.cell>{{ $h->cl }}</x-table.cell>
                        <x-table.cell>{{ $h->nom }}</x-table.cell>
                        <x-table.cell>{{ $h->per }}</x-table.cell>
                        <x-table.cell>{{ $h->percla }}</x-table.cell>

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
