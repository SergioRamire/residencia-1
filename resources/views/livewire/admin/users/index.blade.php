<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            USUARIOS
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">
            <!-- Botón de nuevo -->
            <div class="mb-6">
                <x-jet-secondary-button wire:click="create()" class="border-[#1b396a] text-sky-700 hover:text-sky-500 active:text-sky-800 active:bg-sky-50">
                    <x-icon.plus solid alt="sm" class="inline-block h-5 w-5"/>
                    Nuevo usuario
                </x-jet-secondary-button>
            </div>

            <!-- Opciones de tabla -->
            <div class="md:flex md:justify-between space-y-2 md:space-y-0">
                <!-- Parte izquierda -->
                <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Barra de búsqueda -->
                    <div class="w-full">
                        <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar usuario...">
                            <x-icon.search solid class="h-5 w-5 text-gray-400"/>
                        </x-input.icon>
                        <label><p class="text-xs font-bold">Buscar por: nombre o correo</p></label>
                    </div>

                    <!-- Filtros -->
                    <x-dropdown width="w-full" align="right" dropdownClasses="md:w-72" content-classes="py-1 bg-white divide-y">
                        <x-slot name="trigger">
                            <button class="inline-flex justify-center w-full rounded-md border hover:border-[#1b396a] shadow-sm px-2.5 py-2.5 bg-white font-medium focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" :class="open ? 'text-indigo-400 hover:text-indigo-500 border-[#1b396a]' : 'text-gray-400 hover:text-gray-500 border-[#1b396a]'">
                                @if(in_array(true, $filters))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                    </svg>
                                @endif
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Reiniciar filtros -->
                            <div class="block px-4 py-2 space-y-1">
                                <button wire:click="resetFilters()" @click="open = false" type="button" title="Reiniciar fitros"
                                    class="inline-flex justify-center w-full rounded-md border hover:border-red-400 shadow-sm px-2 py-2 bg-white text-gray-400 hover:text-red-400 font-medium focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                    <x-icon.trash class="h-5 w-5"/>
                                </button>
                            </div>
                            <!-- Estatus -->
                            <div class="block px-4 py-2 space-y-1">
                                <div>
                                    <x-jet-label for="estatus_filter" value="Estatus"/>
                                    <x-input.select wire:model="filters.estatus" id="estatus_filter" class="text-sm block mt-1 w-full" name="estatus_filter" required>
                                        <option value="" disabled>Selecciona estatus</option>
                                        <option value="1">Activo</option>
                                        <option value=null>Inactivo</option>
                                    </x-input.select>
                                </div>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>


                <!-- Parte derecha -->
                <div  class="md:flex md:items-center space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Selección de paginación -->
                    <div>
                        <x-input.select wire:model="perPage" class="block w-full">
                            <option value=8>8 por página</option>
                            <option value=10>10 por página</option>
                            <option value=25>25 por página</option>
                            <option value=50>50 por página</option>
                        </x-input.select>
                    </div>
                </div>
            </div>

            <!-- Tabla -->
            <div class="flex flex-col space-y-2">
                <x-table>
                    <x-slot name="head">
                         <x-table.header wire:click="sortBy('nombre_completo')" sortable :direction="$sortField === 'nombre_completo' ? $sortDirection : null">
                             nombre completo
                         </x-table.header>
                        <x-table.header wire:click="sortBy('email')" sortable :direction="$sortField === 'email' ? $sortDirection : null">
                            correo
                        </x-table.header>
                        <x-table.header>rol</x-table.header>
                        <x-table.header class="text-center">estado</x-table.header>
                        <x-table.header  class="text-center">acciones</x-table.header>
                    </x-slot>

                    @forelse($users as $u)
                        <tr wire:key="user-{{ $u->id }}" wire:loading.class.delay="opacity-50">
                            <x-table.cell>{{ $u->nombre_completo }}</x-table.cell>
                            <x-table.cell>{{ $u->email }}</x-table.cell>
                            <x-table.cell>{{ $u->getRoleNames()->first() }}</x-table.cell>
                            <x-table.cell class="text-center">
                                @if($u->estado == 1)
                                <button wire:click="user_desactivar({{$u->id}}, '{{$u->nombre_completo}}')">
                                    <x-badge.basic value="Activo" color="green" large/>
                                </button>
                                @elseif($u->estado == 0)
                               <button wire:click="user_activar({{$u->id}}, '{{$u->nombre_completo}}')">
                                <x-badge.basic value="Inactivo" color="red" large/>
                               </button>
                                @endif
                            </x-table.cell>
                            <x-table.cell width='200' class="whitespace-nowrap">
                                <button  wire:click="edit({{ $u->id }})" type="button" title="Editar usuario" class="mr-1 px-4 bg-white hover:text-white hover:bg-amber-500 text-black font-bold border border-amber-400 rounded shadow" >
                                    Editar
                                </button>
                                {{$this->permiso_para_eliminar($u->id)}}
                                @if($this->permiso_eliminicacion)
                                    <button wire:click="delete({{ $u->id }})" type="button" title="Eliminar usuario" class="ml-1 px-4 bg-white hover:text-white hover:bg-red-600 text-black font-bold border border-red-400 rounded shadow">
                                        Eliminar
                                    </button>
                                @endif
                            </x-table.cell>
                        </tr>
                    @empty
                        <tr>
                            {{-- Cambia el número según el numero de columnas --}}
                            <x-table.cell colspan="3">
                                <div class="flex justify-center items-center space-x-2">
                                    <!-- Icono -->
                                    <svg class="inline-block h-8 w-8 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <!-- Texto -->
                                    <span class="py-4 text-xl text-gray-400 font-medium">
                                    No se encontraron resultados ...
                                </span>
                                </div>
                            </x-table.cell>
                        </tr>
                    @endforelse
                </x-table>
                <div>
                    {{ $users->links() }}
                </div>

            </div>
        </div>
    </div>

    <!-- Modales -->
    @include('livewire.admin.users.edit_create')
    @include('livewire.admin.users.confirmation')
    @if($confirming_user_active)
        @include('livewire.admin.users.confirmationActive')
    @elseif($confirming_user_Inactive)
        @include('livewire.admin.users.confirmationInactive')
    @endif
</div>
