<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            RESPALDO DE BASE DE DATOS
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">
            <!-- Botón de nuevo -->
            <div class=" mb-6">
                <x-jet-secondary-button wire:click="create()" class="border-[#1b396a] text-sky-700 hover:text-sky-500 active:text-sky-800 active:bg-sky-50">
                    <x-icon.plus solid alt="sm" class="inline-block h-5 w-5"/>
                    Nuevo respaldo
                </x-jet-secondary-button>
            </div>

            <!-- Tabla -->
            <div class="flex flex-col space-y-2">
                <x-table>
                    <x-slot name="head">
                        <x-table.header wire:click="sortBy('file_name')" sortable :direction="$sortField === 'file_name' ? $sortDirection : null">
                            archivo
                        </x-table.header>
                        <x-table.header wire:click="sortBy('size')" sortable :direction="$sortField === 'size' ? $sortDirection : null">
                            tamaño
                        </x-table.header>
                        <x-table.header wire:click="sortBy('date')" sortable :direction="$sortField === 'date' ? $sortDirection : null">
                            fecha
                        </x-table.header>
                        <x-table.header wire:click="sortBy('date')" sortable :direction="$sortField === 'date' ? $sortDirection : null">
                            antigüedad
                        </x-table.header>
                        <x-table.header>acciones</x-table.header>
                    </x-slot>

                    @forelse($backups as $backup)
                        <tr wire:key="backup-{{ $loop->index }}" wire:loading.class.delay="opacity-50">
                            <x-table.cell>{{ $backup['file_name'] }}</x-table.cell>
                            <x-table.cell>{{ $backup['file_size'] }}</x-table.cell>
                            <x-table.cell>{{ $backup['file_date'] }}</x-table.cell>
                            <x-table.cell>{{ $backup['file_relative_date'] }}</x-table.cell>
                            <x-table.cell width='200' class="whitespace-nowrap">
                                <button wire:click="edit()" type="button" title="Editar usuario" class="mr-1 px-4 bg-white hover:text-white hover:bg-amber-500 text-black font-bold border border-amber-400 rounded shadow" >
                                    Descargar
                                </button>
                                <button wire:click="delete()" type="button" title="Eliminar usuario" class="ml-1 px-4 bg-white hover:text-white hover:bg-red-600 text-black font-bold border border-red-400 rounded shadow">
                                    Eliminar
                                </button>
                            </x-table.cell>
                        </tr>
                    @empty
                        <tr>
                            {{-- Cambia el número según el numero de columnas --}}
                            <x-table.cell colspan="3">
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
{{--                    {{ $backups->links() }}--}}
                </div>

            </div>
        </div>
    </div>
</div>
