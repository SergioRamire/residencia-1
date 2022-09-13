<x-jet-dialog-modal wire:model.defer="show_edit_modal">
    <x-slot name="title">
        Editar Información
    </x-slot>

    <x-slot name="content">

        <form id="courseForm">
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                {{-- Nombre --}}
                <div class="mt-4 flex-1">
                    <x-jet-label for="nombre" value="Nombre" />
                    <x-input.error wire:model="user.name" class="block mt-1 w-full" type="text" id="nombre" name="nombre" for="user.name" required />
                </div>
            </div>

            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- paterno -->
                <div class="mt-4 flex-1">
                    <x-jet-label for="apellido_paterno" value="Apellido Paterno" />
                    <x-input.error wire:model="user.apellido_paterno" class="block mt-1 w-full" type="text" id="apellido_paterno" name="apellido_paterno" for="user.apellido_paterno" required />
                </div>
                {{-- materno --}}
                <div class="mt-4 flex-1">
                    <x-jet-label for="apellido_materno" value="Apellido Materno" />
                    <x-input.error wire:model="user.apellido_materno" class="block mt-1 w-full" type="text" id="apellido_materno" name="apellido_materno" for="user.apellido_materno" required />
                </div>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <div class="sm:flex-1">
                    <label class="items-center m-2">
                        <input wire:model.defer="no_ap1" name="noape" value="1" id="noape" type="checkbox"  class="text-[#1b396a] bg-gray-100 border-gray-300 focus:ring-sky-700 focus:ring-2 ">
                        <span class="ml-2 text-sm font-medium text-gray-900 ">No Aplica</span>
                    </label>
                </div>
                <div class="sm:flex-1">
                    <label class="items-center m-2">
                        <input wire:model.defer="no_ap2" name="noape" value="1" id="noape" type="checkbox" class="text-[#1b396a] bg-gray-100 border-gray-300 focus:ring-sky-700 focus:ring-2">
                        <span class="ml-2 text-sm font-medium text-gray-900 ">No Aplica</span>
                    </label>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                {{-- ito --}}
                <div class="mt-4 flex-1">
                    <x-jet-label for="email" value="Correo" />
                    <x-input.error wire:model="user.email" class="block mt-1 w-full" type="email" id="email" name="email" for="user.email" required />
                </div>
                {{-- curp  --}}
                <div class="mt-4 flex-1">
                    <x-jet-label for="curp" value="CURP" />
                    <x-input.error wire:model="user.curp" class="block mt-1 w-full" type="text" id="curp" name="curp" for="user.curp" required />
                </div>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">

                <div class="mt-4 flex-1">
                    <x-jet-label for="telefono" value="Telefono" />
                    <x-input.error wire:model="user.telefono" class="block mt-1 w-full" type="text" id="telefono" name="telefono" for="user.telefono" required />
                </div>
                {{-- sexo --}}
                <div class="mt-4 flex-1">
                    <x-jet-label for="sexo" value="Sexo" />
                    <x-input.select wire:model="user.sexo" id="sexo" class="mt-1 w-full" name="sexo" for="user.sexo" required>
                        <option value="" disabled>Selecciona Sexo...</option>
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </x-input.select>
                </div>
            </div>

    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="close_m" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3 bg-[#BB2574]" wire:click.prevent="confirm_save()" wire:loading.attr="disabled">
            Confirmar
        </x-jet-button>
    </x-slot>
</x-jet-dialog-modal>
