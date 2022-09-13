<div>
    <x-slot name="header">
        <div
            class="max-w-7xl mx-auto pt-5 pb-10 text-center bg-[#BB70A2] border-[#1b396a] rounded-lg border shadow-md sm:p-8">
            <div class="flex flex-col items-center">
                <img class="mb-3 w-h-28 h-28 rounded-full shadow-lg" src="{{ Auth::user()->profile_photo_url }} "
                    alt="Bonnie image" />
                <h5 class="mb-1 text-2xl font-medium text-white">
                    {{ auth()->user()->name }}
                    {{ auth()->user()->apellido_paterno }}
                    {{ auth()->user()->apellido_materno }}
                </h5>
                <span class="text-xl text-white">{{ auth()->user()->email }}</span>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-5">
        <div class="space-y-2">
            <div class="p-4 bg-[#FFE8FA] rounded-lg border border-[#1b396a] shadow-md sm:p-6 lg:p-8 ">
                <h5 class="text-xl font-medium text-gray-800 ">Datos Personales</h5>

                <form id="courseForm">
                    <div class="flex flex-col lg:flex-row lg:items-baseline lg:gap-x-1.5">
                        {{-- Nombre --}}
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dd class="text-base font-bold text-gray-900 lg:col-span-2">Nombre: </dd>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2 overflow-auto">
                                    {{ $user->name }}</dd>
                            </div>
                        </div>
                        <!-- paterno -->
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dd class="text-base font-bold text-gray-900 lg:col-span-2">Apellido Paterno: </dd>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2 overflow-auto">
                                    {{ $user->apellido_paterno }}</dd>
                            </div>
                        </div>
                        {{-- materno --}}
                        <div class="mt-4 flex-1">
                            <div class=" bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dd class="text-base font-bold text-gray-900 lg:col-span-2">Apellido Materno: </dd>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2 overflow-auto">
                                    {{ $user->apellido_materno }}</dd>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-baseline lg:gap-x-1.5">
                        {{-- Curp --}}
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dd class="text-base font-bold text-gray-900 lg:col-span-2">CURP: </dd>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2 overflow-auto">
                                    {{ $user->curp }}</dd>
                            </div>
                        </div>
                        {{-- Género --}}
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dd class="text-base font-bold text-gray-900 lg:col-span-2">Sexo: </dd>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2 overflow-auto">
                                    @if ($user->sexo == 'F')
                                        Femenino
                                    @endif
                                    @if ($user->sexo == 'M')
                                        Masculino
                                    @endif
                                </dd>
                            </div>
                        </div>
                    </div>



                    <div class="flex flex-col lg:flex-row lg:items-baseline lg:gap-x-1.5">
                        {{-- ito --}}
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dd class="text-base font-bold text-gray-900 lg:col-span-2">Correo </dd>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2 overflow-auto">
                                    {{ $user->email }}</dd>
                            </div>
                        </div>

                        {{-- telefono --}}
                        <div class="mt-4 flex-1">
                            <div class="bg-white px-2 py-3 grid grid-cols-2 gap-2">
                                <dd class="text-base font-bold text-gray-900 lg:col-span-2">Teléfono: </dd>
                                <dd class="text-lg font-medium text-gray-900 lg:col-span-2 overflow-auto">
                                    {{ $user->telefono }}</dd>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col lg:flex-row lg:items-baseline lg:gap-x-1.5">


                    </div>

                    <div class="my-4 flex justify-end">

                        <x-jet-button wire:click="edi_iInfo()" type="button" class="bg-[#BB2574]">
                            Editar Información
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @include('livewire.admin.users.profileConfirmation')
    @include('livewire.admin.users.profileEdit')
</div>
