<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            DENUNCIAS
        </h2>
    </x-slot>

    {{ $flag }}

    <div class="bg-[#FFE8FA] p-8 ">
        <div class="w-full">
            <x-jet-label for="sexo" class="text-black">Tipo de denuncia <span class="text-red-600">*</span>
            </x-jet-label>
            <x-input.select wire:model="user.sexo" class="mt-1 w-full" id="sexo" name="sexo" required>
                <option value="0" selected>Selecciona el tipo de denuncia</option>
                <option value="1">Falla en semáforo</option>
                <option value="2">Accidentes viales</option>
                <option value="3">Abuso de autoridad</option>
                <option value="4">Irregularidades</option>
                <option value="5">Otro</option>
            </x-input.select>
            <x-jet-input-error for="flag" />
        </div>

        <div class="w-full">
            <x-jet-label class="text-black">Fecha de acontecimiento <span class="text-red-600">*</span></x-jet-label>
            <x-jet-label for="Fecha" class="text-lg" />
            <x-input.error wire:model="filters_1"
                class="block mt-1 w-full border-[#1b396a] text-[#1b396a] active:text-sky-50 active:bg-sky-500"
                type="date" id="fecha_inicio2" name="fecha_inicio2" for="fecha_inicio2" />
        </div>

        <div class="w-full">
            <x-jet-label for="obser">Observaciones <span class="text-red-600">*</span></x-jet-label>
            <x-input.error wire:model="areas.obser" class="block mt-1 w-full" type="text" id="obser"
                name="obser" for="areas.obser" required />
        </div>

        <div class="w-full">
            <x-jet-label for="funcio">Funcionario <span class="text-red-600">*</span></x-jet-label>
            <x-input.error wire:model="areas.funcio" class="block mt-1 w-full" type="text" id="funcio"
                name="funcio" for="areas.funcio" required />
        </div>

        <div class="w-full">
            <x-jet-label for="depart">Departamento de Gobierno <span class="text-red-600">*</span></x-jet-label>
            <x-input.error wire:model="areas.depart" class="block mt-1 w-full" type="text" id="depart"
                name="depart" for="areas.depart" required />
        </div>

        <div class="w-full py-4">
            <x-jet-button class="" wire:click.prevent=" update_area()" wire:loading.attr="disabled"
                form="courseForm">
                ENVIAR
            </x-jet-button>
        </div>

    </div>

    <div class="bg-[#FFE8FA] p-8">

        <div >

        </div>


    </div>



</div>
