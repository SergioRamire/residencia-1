<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            ROLES
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">
            <!-- Botón de nuevo -->
            <div class="mb-6">
                <x-jet-secondary-button wire:click="create()" class="border-[#1b396a] text-sky-700 hover:text-sky-500 active:text-sky-800 active:bg-sky-50">
                    <x-icon.plus solid alt="sm" class="inline-block h-5 w-5"/>
                    Nuevo rol
                </x-jet-secondary-button>
            </div>

            <!-- Opciones de tabla -->
            <div class="md:flex md:justify-between space-y-2 md:space-y-0">
                <!-- Parte izquierda -->
                <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Barra de búsqueda -->
                    <div class="w-full">
                        <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar rol...">
                            <x-icon.search solid class="h-5 w-5 text-gray-400"/>
                        </x-input.icon>
                        <label><p class="text-xs font-bold">Buscar por: Nombre</p></label>
                    </div>
                </div>

                <!-- Parte derecha -->
                <div class="md:flex md:items-center space-y-2 md:space-y-0 md:space-x-2">
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
                        <x-table.header wire:click="sortBy('name')" sortable :direction="$sortField === 'name' ? $sortDirection : null">
                            nombre
                        </x-table.header>
                        <x-table.header>acciones</x-table.header>
                    </x-slot>

                    @forelse($roles as $r)
                        @unless($r->name === 'Super admin' && auth()->user()->getRoleNames()->first() !== 'Super admin')
                            <tr wire:key="role-{{ $r->id }}" wire:loading.class.delay="opacity-50">
                                <x-table.cell>{{ $r->name }}</x-table.cell>
                                <x-table.cell>
                                    @unless($r->name === 'Super admin')
                                        <button  wire:click="edit({{ $r->id }})" type="button" class="px-4 bg-white hover:text-white hover:bg-amber-500 text-black font-bold border border-amber-400 rounded shadow" >
                                            Editar
                                        </button>
                                    @endunless

                                    @unless(in_array($r->name, ['Super admin', 'Administrador', 'Participante', 'Instructor']))
                                        <button wire:click="delete({{ $r->id }})" type="button" class="px-4 bg-white hover:text-white hover:bg-red-600 text-black font-bold border border-red-400 rounded shadow">
                                            Eliminar
                                        </button>
                                    @endunless

                                </x-table.cell>
                            </tr>
                        @endunless
                    @empty
                        <tr>
                            <x-table.cell colspan="2">
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
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modales -->
    @include('livewire.admin.roles.edit_create')
    @include('livewire.admin.roles.confirmation')
</div>
