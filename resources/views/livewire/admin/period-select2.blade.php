<div class="relative border-none flex-1">
    <input
        type="text"
        class="w-full form-input border-[#1b396a] text-[#1b396a]  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
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
        <div class="absolute z-10  bg-white shadow-lg w-full rounded-lg" style="
            height:200px;
            overflow-y: scroll;
        ">
            Buscar por la "clave del periodo"
            @if (!empty($datos))
                @foreach ($datos as $i => $data)
                    <br><a
                        wire:click="selectPer({{ $data->id }})"
                        class="inset-x-0 w-full inline-flex items-center px-4 py-2 bg-white
                        border border-gray-300 font-semibold text-lx text-gray-700 uppercase
                        tracking-widest shadow-sm hover:text-white hover:bg-blue-600
                        focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200
                        active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                        {{$data->clave}}
                </a>
                @endforeach
            @else
                <div class="list-item">No hay Resultados</div>
            @endif
        </div>
    @endif
</div>
