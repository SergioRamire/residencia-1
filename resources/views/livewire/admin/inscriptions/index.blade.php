<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Proceso de Inscripción
        </h2>
    </x-slot>
</div>

<div>

    <div class="mt-4 flex-1">
        <div class="max-w-7xl mx-auto pt-5">
            <div class="space-y-2">
                <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 ">
                    <h5 class="text-xl font-medium text-blue-800">Cursos Elegidos</h5>
                    <x-table>
                        <x-slot name="head">
                            <x-table.header>id</x-table.header>
                            {{-- <x-table.header>Nombre</x-table.header>
                            <x-table.header>Perfil</x-table.header>
                            <x-table.header>Dirigido al departamento</x-table.header>
                            <x-table.header>acciones</x-table.header> --}}
                        </x-slot>

                        @forelse($elegidos as $c)
                            <tr wire:loading.class.delay="opacity-50">
                                <x-table.cell>{{ $c }} </x-table.cell>
                                {{-- <x-table.cell>{{ $c->nombre }} </x-table.cell>
                                <x-table.cell>{{ $c->perfil }} </x-table.cell>
                                <x-table.cell>{{ $c->dirigido }} </x-table.cell> --}}
                                {{-- <x-table.cell>{{ $c->fecha_inicio }} al {{ $c->fecha_fin }}</x-table.cell0 --}}
                                <x-table.cell>
                                    <button wire:click="delete" type="button" class="text-amber-600 hover:text-amber-900">
                                        <x-icon.trash class="h-6 w-6"/>
                                    </button>
                                </x-table.cell>
                            </tr>
                        @empty
                            <tr>
                                <x-table.cell colspan="4">
                                    <div class="flex justify-center items-center space-x-2">
                                        <!-- Icono -->
                                        <svg class="inline-block h-8 w-8 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <!-- Texto -->
                                        <span class="py-4 text-xl text-gray-400 font-medium">
                                            Aun no se han Seleccionado Cursos ...
                                        </span>
                                    </div>
                                </x-table.cell>
                            </tr>
                        @endforelse
                    </x-table>
                    <div>
                        {{-- {{ $elegidos->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 flex-1">
        {{-- Tabala de cursos SEMANA 1 --}}
        <div class="max-w-7xl mx-auto pt-5">
            <div class="space-y-2">
                <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 ">
                    <h5 class="text-xl font-medium text-blue-800">Cursos Disponibles Semana 1</h5>
                    <div class="flex flex-col space-y-2">
                        <x-table>
                            <x-slot name="head">
                            <x-table.header>course_id</x-table.header>
                            <x-table.header>Nombre</x-table.header>
                            <x-table.header>Perfil</x-table.header>
                            <x-table.header>Dirigido al departamento</x-table.header>
                            <x-table.header>Fechas</x-table.header>
                            <x-table.header>acciones</x-table.header>
                        </x-slot>
                        @forelse($semana1 as $c)
                            <tr wire:key="semana1-{{ $c->id }}" wire:loading.class.delay="opacity-50">
                                <x-table.cell>{{ $c->course_id}} </x-table.cell>
                                <x-table.cell>{{ $c->nombre}} </x-table.cell>
                                <x-table.cell>{{ $c->perfil}} </x-table.cell>
                                <x-table.cell>{{ $c->dirigido}} </x-table.cell>
                                <x-table.cell>{{ $c->fecha_inicio }} al {{ $c->fecha_fin }}</x-table.cell>
                                <x-table.cell>
                                    <button wire:click="registro({{ $c->course_id }})" type="button" class="text-indigo-600 hover:text-indigo-900">
                                        Seleccionar Curso <x-icon.plus class="h-6 w-6" />
                                    </button>
                                </x-table.cell>
                            </tr>
                            @empty
                                <tr>
                                    <x-table.cell colspan="4">
                                        <div class="flex justify-center items-center space-x-2">
                                            <svg class="inline-block h-8 w-8 text-gray-400"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <span class="py-4 text-xl text-gray-400 font-medium">
                                                No se encontraron resultados ...
                                            </span>
                                        </div>
                                    </x-table.cell>
                                </tr>
                            @endforelse
                        </x-table>
                        <div>
                            {{ $semana1->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 flex-1">
        {{-- Tabala de cursos SEMANA 2 --}}
        <div class="max-w-7xl mx-auto pt-5">
            <div class="space-y-2">
                <div class="p-4 bg-white rounded-lg border border-gray-200 shadow-md sm:p-6 lg:p-8 ">
                    <h5 class="text-xl font-medium text-blue-800">Cursos Disponibles Semana 2</h5>
                    <x-table>
                        <x-slot name="head">

                            <x-table.header>course_id</x-table.header>
                            <x-table.header>Nombre</x-table.header>
                            <x-table.header>Perfil</x-table.header>
                            <x-table.header>Dirigido al departamento</x-table.header>
                            <x-table.header>Fechas</x-table.header>
                            <x-table.header>acciones</x-table.header>
                        </x-slot>
                        @forelse($semana2 as $c)
                            <tr wire:key="semana1-{{ $c->id }}" wire:loading.class.delay="opacity-50">
                                <x-table.cell>{{ $c->course_id }} </x-table.cell>
                                <x-table.cell>{{ $c->nombre }} </x-table.cell>
                                <x-table.cell>{{ $c->perfil }} </x-table.cell>
                                <x-table.cell>{{ $c->dirigido }} </x-table.cell>
                                <x-table.cell>{{ $c->fecha_inicio }} al {{ $c->fecha_fin }}</x-table.cell>
                                <x-table.cell>
                                    <button wire:click="registro({{ $c->course_id }})" type="button" class="text-indigo-600 hover:text-indigo-900">
                                        Seleccionar Curso <x-icon.plus class="h-6 w-6" />
                                    </button>
                                </x-table.cell>
                            </tr>

                        @empty
                            <tr>
                                <x-table.cell colspan="4">
                                    <div class="flex justify-center items-center space-x-2">
                                        <svg class="inline-block h-8 w-8 text-gray-400"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <span class="py-4 text-xl text-gray-400 font-medium">
                                            No se encontraron resultados ...
                                        </span>
                                    </div>
                                </x-table.cell>
                            </tr>
                        @endforelse
                    </x-table>
                    <div>
                        {{ $semana2->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    @include('livewire.admin.inscriptions.anuncio')