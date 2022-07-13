<div>

    <div class="p-6 w-full bg-white rounded-lg border border-sky-600 shadow-md shadow-[#1b396a]">

        <div class="py-4 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-3xl">Ofertar cursos para las inscripciones</p>
                    <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">Periodos próximos:</p>
                </div>
                @if (!empty($fecha))
                    <x-table>
                        <x-slot name="head">
                            {{-- <x-table.header >Número</x-table.header> --}}
                            <x-table.header>
                                Clave
                            </x-table.header>
                            <x-table.header>
                                Periodo
                            </x-table.header>
                            <x-table.header>ofertado</x-table.header>
                            <x-table.header>acciones</x-table.header>
        
                        </x-slot>
        
                        @forelse($fecha as $p)
                            <tr wire:key="period-{{ $loop->index}}" wire:loading.class.delay="opacity-50">
                                <x-table.cell>{{ $p->clave }}</x-table.cell>
                                <x-table.cell>Del {{ date('d-m-Y', strtotime($p->fecha_inicio)) }} al {{ date('d-m-Y', strtotime($p->fecha_fin)) }}</x-table.cell>
                                <x-table.cell>
                                    
                                </x-table.cell>
                                <x-table.cell width='200' class="whitespace-nowrap">
                                        <button wire:click="activar" type="button" class="ml-1 px-4 bg-white hover:text-white hover:bg-green-600 text-black font-bold border border-green-400 rounded shadow">
                                            Ofertar
                                        </button>
        
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

                @endif
            </div>
        </div>

        @if (empty($fecha))
        <div class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            <div class="flex justify-center ">
                <span class="text-black font-bold text-lg">No se encuentra ninguno.</span>
            </div>
        </div>
        @endif
    </div>
</div>
