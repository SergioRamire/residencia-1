@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            FECHA LÍMITE PARA ASIGNAR CALIFICACIONES
        </h2>
    </x-slot>

    <div class="space-y-2">

        <div class="pt-12">
            <p class="p-2 text-xl">Periodo Activo: </p>
            <x-table>
                <x-slot name="head">
                    <x-table.header>Clave</x-table.header>
                    <x-table.header>Periodo</x-table.header>
                    <x-table.header>fecha límite para cargar calificaciones</x-table.header>
                    <x-table.header>acciones</x-table.header>
                </x-slot>
                @if (!empty($periodos))
                    <tr wire:loading.class.delay="opacity-50">
                        <x-table.cell>{{ $periodos->clave }}</x-table.cell>
                        <x-table.cell>Del {{ date('d-m-Y', strtotime($periodos->fecha_inicio)) }} al {{ date('d-m-Y', strtotime($periodos->fecha_fin)) }}</x-table.cell>
                        <x-table.cell>{{ $periodos->fecha_limite_para_calificar }}</x-table.cell>
                        <x-table.cell width='200' class="whitespace-nowrap">
                            <button wire:click="edit({{$periodos->id}})" type="button" class="ml-1 px-4 bg-white hover:text-white hover:bg-amber-600 text-black font-bold border border-amber-400 rounded shadow">
                                Editar fecha límite
                            </button>
                        </x-table.cell>
                        
                    </tr>
                @else
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
                @endif
            </x-table>
            @if ($modal_edit)
                @include('livewire.admin.limitForInstructors.edit_create')
            @endif
        </div>

    </div>

</div>

