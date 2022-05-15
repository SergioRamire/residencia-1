<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            CALIFICACIONES
        </h2>
    </x-slot>
    <div class="space-y-2">
        <div class="flex justify-between">
        <p class="left-6 text-xl text-gray-800">
            <b> Curso:  {{$curso}}</b>
        </p>

        <p class="right-0 text-xl text-gray-800">
            <b> Grupo: {{$grupo}}</b>
        </p>
    </div>
    </div>

    <div class="space-y-2">
        <!-- Opciones de tabla -->
        <div class="md:flex md:justify-between space-y-2 md:space-y-0">
            <!-- Parte izquierda -->
            <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                <!-- Barra de búsqueda -->
                <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar usuarios...">
                    <x-icon.search solid class="h-5 w-5 text-gray-400"/>
                </x-input.icon>

                <!-- Filtros -->
            </div>

            <!-- Parte derecha -->
            <div class="md:flex md:items-center space-y-2 md:space-y-0 md:space-x-2">
                <!-- Exportar y eliminar -->

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
{{$grads}}
      {{--   <!-- Tabla -->
        <div class="flex flex-col space-y-2">
            <x-table>
                <x-slot name="head">
                    <x-table.header >Participante</x-table.header>
                    <x-table.header >Calificación</x-table.header>
                    <x-table.header>acciones</x-table.header>
                </x-slot>

                @forelse($grades as $g)
                    <tr wire:key="grade-{{ $g->id }}" wire:loading.class.delay="opacity-50">
                        <x-table.cell>{{ $g->name }}
                                      {{ $g->apellido_paterno }}
                                      {{ $g->apellido_materno }}</x-table.cell>
                        <x-table.cell>{{ $g->calificacion }}</x-table.cell>
                        <x-table.cell>
                            <button wire:click="edit( {{$g->id }})" type="button" class="text-amber-600 hover:text-amber-900">
                                <x-icon.pencil alt class="h-6 w-6"/>
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
                {{ $grades->links() }}
            </div>
            @if($isOpen)
                @include('livewire.admin.grades.edit')
            @endif --}}
        </div>
    </div>
</div>
