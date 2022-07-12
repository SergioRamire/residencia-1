<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            FECHA LÍMITE PARA ASIGNAR CALIFICACIONES
        </h2>
    </x-slot>

    <div class="space-y-2">

        <div class="pt-12">
            <x-jet-label for="desde" value="Periodo activo." class="text-lg" />
            <div class="flex justify-between px-12 shadow-sm shadow-blue-100 border border-[#1b396a] bg-blue-50">
                <p class="p-4">{{$clave}}</p>
                <p class="p-4">{{$fecha1}}</p>
                <p class="p-4">{{$fecha2}}</p>
                {{-- <div class="flex items-center">
                @if($estado === 0)
                    <button wire:click="" type="button" title="Desactivo" class="py-1 px-4 bg-white hover:text-white hover:bg-stone-600 text-black font-bold border border-stone-400 rounded shadow">
                        Desactivo
                    </button>
                @elseif($estado === 1)
                    <button wire:click="" type="button" title="Activo" class="py-1 px-4 bg-white hover:text-white hover:bg-green-600 text-black font-bold border border-green-400 rounded shadow">
                        Activo
                    </button>
                @endif
                </div> --}}

            </div>
        </div>

        <div class="lg:flex lg:justify-between pt-16 min:w-12">
            <div class="lg:w-1/2 lg:max-w-md col-start pr-1">
                <x-jet-label for="desde" value="Fecha límite para cargar calificaciones." class="text-lg" />
                <x-input.error wire:model="limite_fecha" class="block mt-1 w-full border-[#1b396a] text-[#1b396a] active:text-sky-50 active:bg-sky-500"
                    type="date" id="fecha_limite" name="fecha_limite" for="fecha_limite" />
            </div>
            <div class="lg:w-1/2 lg:max-w-md col-start pr-1">
                <x-jet-label for="hasta" value="Hora." class="text-lg" />
                <x-datepicker wire:model.defer="" class="block mt-1 w-full border-[#1b396a]" ref="hora_limite" name="hora_limite"
                    :config="['enableTime' => true, 'noCalendar' => true, 'dateFormat' => 'H:i', 'time_24hr' => true]"/>
                <x-jet-input-error for="hora_limite" />
            </div>
        </div>
        <div class="flex justify-end pt-16">
            <x-jet-secondary-button type="submit" class="flex justify-center w-60 bg-white border-[#1b396a] text-sky-700 hover:text-white hover:bg-sky-800 active:text-sky-50 active:bg-sky-500">
                GUARDAR
            </x-jet-secondary-button>
        </div>
       
    </div>

</div>

