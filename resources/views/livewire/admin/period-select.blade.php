<div class="relative border-none mt-4 flex-1">
    <input 
        type="text" 
        class="w-full form-input border-sky-800 text-sky-700  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
        placeholder="{{$txt}}"
        wire:click="full"
        wire:model="query"
        wire:keydown.escape="reset2"
        wire:keydown.tab="reset2"
        wire:keydown.arrow-up="decrementContador"
        wire:keydown.arrow-down="incrementContador"
    />
    <div wire:loading class="absolute z-10 bg-white rounded-t-none shadow-lg" >
        {{-- <div class="list-item">Buscando...</div> --}}
    </div>
    @if (!empty($query))
        <div class="fixed top-0 right-0 bottom-0 left-0" wire:click="reset2"></div>
        <div class="absolute z-10  bg-white rounded-t-none shadow-lg">
             Seleccione una opcion
            @if (!empty($datos))
                @foreach ($datos as $i => $data)
                    <br><a 
                        wire:click="selectPer({{ $data->id }})"
                        class="inset-x-0 {{$contador == $i ? 'bg-blue-100' : '' }}
                        inline-flex items-center px-4 py-2 border-none bg-white border border-gray-300  font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition"
                    >
                        Del {{$data->fecha_inicio}} al {{$data->fecha_fin}}
                </a>
                @endforeach
            @else
                <div class="list-item">No hay Resultados</div>
            @endif
        </div>
    @endif
</div>