<x-jet-dialog-modal wire:ignore.self wire:model.defer="modal_ayuda">
    <x-slot name="title">
        Ayuda para crear respaldos y restaurarlos.
    </x-slot>
    <x-slot name="content">

        <div class="mx-8 my-4 grid grid-rows-1">
            <ul>
                <li><span class="font-bold text-justify">Pasos para crear Respaldo de la base de datos.</span></li>
                <li><span class="font-normal text-justify">Presionar el boton <strong class="bg-white text-black font-bold border border-[#1b396a] rounded shadow">NUEVO RESPALDO</strong>.</span></li>
                <li><span class="font-normal text-justify">Aparecera un modal, presionar el boton CREAR.</span></li>
                <li><span class="font-normal text-justify">El respaldo se generara, y se mostrara en la tabla.</span></li>
            </ul>
        </div>

        <div class="mx-8 my-4 grid grid-rows-1">
            <ul>
                <li><span class="font-bold text-justify">Pasos para descargar Respaldo de la base de datos.</span></li>
                <li><span class="font-normal text-justify">Presionar el boton <strong class="bg-white text-black font-bold border border-amber-400 rounded shadow">Descargar</strong>.</span></li>
                <li><span class="font-normal text-justify">Elegimos donde guardar, y empezara a descargar el respaldo.</span></li>
            </ul>
        </div>

        <div class="mx-8 my-4 grid grid-rows-1">
            <ul>
                <li><span class="font-bold text-justify">Pasos para respaldar la base de datos.</span></li>
                <li><span class="font-normal text-justify">Presionar el boton <strong class="bg-white text-black font-bold border border-green-400 rounded shadow">RESTAURAR</strong>.</span></li>
                <li><span class="font-normal text-justify">Aparecera un modal, presionar el boton RESTAURAR.</span></li>
                <li><span class="font-normal text-justify">El respaldo se estara ejecutando, al terminar los datos estaran resaurados.</span></li>
            </ul>
        </div>
        
        <div class="mx-8 my-4 grid grid-rows-1">
            <ul>
                <li><span class="font-bold text-justify">Pasos para eliminar el respaldo de la base de datos.</span></li>
                <li><span class="font-normal text-justify">Presionar el boton <strong class="bg-white text-black font-bold border border-red-400 rounded shadow">ELIMINAR</strong>.</span></li>
                <li><span class="font-normal text-justify">Aparecera un modal, presionar el boton ELIMINAR.</span></li>
                <li><span class="font-normal text-justify">El respaldo se eliminara, y ya no aparecesar en la tabla.</span></li>
            </ul>
        </div>
        
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('modal_ayuda')" wire:loading.attr="disabled">
            Aceptar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:click.prevent="" wire:loading.attr="disabled" form="courseForm">
            algo mas
         </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
