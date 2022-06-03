<x-w-modal wire:ignore.self wire:model.defer="showSemana">
    <x-slot name="title">
        <h5 class="text-xl font-medium text-blue-800">Cursos Disponibles Semana 1</h5>
    </x-slot>
    <x-slot name="content">
        <div class="max-w-7xl mx-auto pt-5">
            <div class="space-y-2">
                <div class="p-2 bg-white rounded-lg border border-gray-200 shadow-md sm:p-3 lg:p-4 ">
                    <div class="flex flex-col space-y-2">

                    {{-- @if (strcmp($bandera, '1') === 0) --}}
                        
                        <x-table>
                            <x-slot name="head">
                                <x-table.header>course_id</x-table.header>
                                <x-table.header>course_id</x-table.header>
                                <x-table.header>Nombre</x-table.header>
                                <x-table.header>Perfil</x-table.header>
                                <x-table.header>Fechas</x-table.header>
                                <x-table.header>acciones</x-table.header>
                            </x-slot>
                            @forelse($semana1 as $c)
                                <tr wire:key="semana-{{ $c->id }}" wire:loading.class.delay="opacity-50">
                                    <x-table.cell>{{ $c->curdet }} </x-table.cell>
                                    <x-table.cell>{{ $c->id }} </x-table.cell>
                                    <x-table.cell>{{ $c->nombre }} </x-table.cell>
                                    <x-table.cell>{{ $c->perfil }} </x-table.cell>
                                    <x-table.cell>{{ $c->fecha_inicio }} al {{ $c->fecha_fin }}</x-table.cell>
                                    <x-table.cell>
                                        <button wire:click="add({{ $c->curdet }})" type="button"
                                            class="text-indigo-600 hover:text-indigo-900">
                                            Seleccionar Curso
                                            <x-icon.plus class="h-6 w-6" />
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
                    {{-- @else

                    @if (strcmp($bandera, '2') === 0)         --}}
                        <x-table>
                            <x-slot name="head">
                                <x-table.header>course_id</x-table.header>
                                <x-table.header>course_id</x-table.header>
                                <x-table.header>Nombre</x-table.header>
                                <x-table.header>Perfil</x-table.header>
                                <x-table.header>Fechas</x-table.header>
                                <x-table.header>acciones</x-table.header>
                            </x-slot>
                            @forelse($semana2 as $c)
                                <tr wire:key="semana-{{ $c->id }}" wire:loading.class.delay="opacity-50">
                                    <x-table.cell>{{ $c->curdet }} </x-table.cell>
                                    <x-table.cell>{{ $c->id }} </x-table.cell>
                                    <x-table.cell>{{ $c->nombre }} </x-table.cell>
                                    <x-table.cell>{{ $c->perfil }} </x-table.cell>
                                    <x-table.cell>{{ $c->fecha_inicio }} al {{ $c->fecha_fin }}</x-table.cell>
                                    <x-table.cell>
                                        <button wire:click="msj" type="button"
                                        {{-- <button wire:click="msj" type="button" --}}
                                            class="text-indigo-600 hover:text-indigo-900">
                                            Seleccionar Curso
                                            <x-icon.plus class="h-6 w-6" />
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

                    {{-- @else --}}

                        
                    </div>
                </div>
            </div>
    </x-slot>

    <x-slot name="footer">
        {{-- <x-jet-secondary-button wire:click="closeShowSemana()" type="button">
            Cerrar
        </x-jet-secondary-button>

        <x-jet-button wire:loading.attr="disabled" form="courseForm">
            Aceptar
        </x-jet-button> --}}
    </x-slot>
</x-w-modal>
