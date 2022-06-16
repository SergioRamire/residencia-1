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
        <div class="absolute z-10 list-group bg-white w-full rounded-t-none shadow-lg">
            @if (!empty($datos))
                @foreach ($datos as $i => $data)
                    <a 
                        wire:click="selectCur({{ $data->id }})"
                        class="list-item {{$contador == $i ? 'bg-blue-100' : '' }}"
                    >
                        <br>{{ $data->id }} {{$data->nombre}}
                    </a>    
                @endforeach
            @else
                <div class="list-item">No hay Resultados</div>
            @endif
        </div>
    @endif
</div>
