<div class="relative border-none flex-1">
    <input 
        type="text" 
        class="form-input w-full border-sky-800 text-sky-700 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" 
        placeholder="{{$txt}}"
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
    <div class="absolute z-10  bg-white rounded-t-none shadow-lg w-full rounded-lg"  style="
        height:200px; 
        overflow-y: scroll;
    ">
        Buscar por "clave", "nombre del curso" o "grupo"
            @if (!empty($datos))
                @foreach ($datos as $i => $data)
                <br>
                    <a 
                        wire:click="selectCur({{ $data->idc }})"
                        class="inset-x-0 w-full inline-flex items-center px-4 py-2 bg-white
                        border border-gray-300 font-semibold text-gray-700 uppercase text-xs
                        tracking-widest shadow-sm hover:text-white hover:bg-blue-600
                        focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200
                        active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">
                        <p>{{$data->clave}} <strong class="text-red-500"> | </strong> {{$data->nombre}} <strong class="text-red-500"> | </strong> {{$data->gruponombre}}</p>
                    </a>    
                @endforeach
            @else
                <div class="list-item">No hay Resultados</div>
            @endif
        </div>
    @endif
</div>