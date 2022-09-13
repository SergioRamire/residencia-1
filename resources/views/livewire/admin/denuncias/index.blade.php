<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
           DENUNCIAS
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">
            <!-- Parte izquierda -->
            <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                <!-- Barra de búsqueda -->
                <div class="w-full">
                <x-jet-label for="sexo">Tipo de denuncia <span class="text-red-600">*</span></x-jet-label>
                <x-input.select wire:model="user.sexo" class="mt-1 w-full" id="sexo" name="sexo" required>
                    <option value="" disabled>Selecciona el género</option>
                    <option value="F">Falla en semáforo</option>
                    <option value="M">Abuso de autoridad</option>
                    <option value="M">Accidentes viales</option>
                    <option value="M">Otro</option>
                </x-input.select>
                <x-jet-input-error for="user.sexo"/>
            </div>
        </div>
            <div class="md:w-1/2 max-w-xs col-start pr-1">
                <x-jet-label>Fecha de acontecimiento <span class="text-red-600">*</span></x-jet-label>
                <x-jet-label for="Fecha" class="text-lg" />
                <x-input.error wire:model="filters_1" class="block mt-1 w-full border-[#1b396a] text-[#1b396a] hover:text-white hover:bg-[#1b396a] active:text-sky-50 active:bg-sky-500" type="date" id="fecha_inicio2" name="fecha_inicio2" for="fecha_inicio2"/>
            </div>

            <x-jet-button class="ml-3" wire:click.prevent=" update_area()" wire:loading.attr="disabled" form="courseForm">
                ENVIAR
             </x-jet-button>


    <!-- Modales -->

</div>
