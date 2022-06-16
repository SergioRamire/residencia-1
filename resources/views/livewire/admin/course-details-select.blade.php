<div class="relative">
    <input 
        type="text" 
        class="form-input" 
        placeholder="Buscar DetalleCurso"
        wire:click="full"
        wire:model="query"
        wire:keydown.escape="reset2"
        wire:keydown.tab="reset2"
        wire:keydown.arrow-up="decrementContador"
        wire:keydown.arrow-down="incrementContador"
    />
    
    <div wire:loading class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
        {{-- <div class="list-item">Buscando...</div> --}}
    </div>
    @if (!empty($query))
    <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="reset2"></div>
    <div class="absolute z-10  bg-white rounded-t-none shadow-lg">
        Seleccione una opcion
            @if (!empty($datos))
                @foreach ($datos as $i => $data)
                    <a 
                        wire:click="selectCur({{ $data->id }})"
                        class="inset-0 list-item {{$contador == $i ? 'bg-blue-100' : '' }}
                        inline-flex items-center px-4 py-2 bg-white border border-gray-300  font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition"
                    >{{ $data->id }} {{$data->nombre}}
                    </a>    
                @endforeach
            @else
                <div class="list-item">No hay Resultados</div>
            @endif
        </div>
    @endif
</div>
