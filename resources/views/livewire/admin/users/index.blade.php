<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Usuarios
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">
            <!-- Botón de nuevo -->
            <div>
                <x-jet-secondary-button wire:click="create()" class="border-green-300 text-green-700 hover:text-green-500 active:text-green-800 active:bg-green-50">
                    <x-icon.plus solid alt="sm" class="inline-block h-5 w-5"/>
                    Nuevo usuario
                </x-jet-secondary-button>
            </div>

            <!-- Opciones de tabla -->
            <div class="md:flex md:justify-between space-y-2 md:space-y-0">
                <!-- Parte izquierda -->
                <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Barra de búsqueda -->
                    <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar usuario...">
                        <x-icon.search solid class="h-5 w-5 text-gray-400"/>
                    </x-input.icon>
                </div>

                <!-- Parte derecha -->
                <div class="md:flex md:items-center space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Selección de paginación -->
                    <div>
                        <x-input.select wire:model="perPage" class="block w-full">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="25">25</option>
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
                        <x-table.header wire:click="sortBy('email')" sortable :direction="$sortField === 'email' ? $sortDirection : null">
                            correo
                        </x-table.header>
                        <x-table.header>acciones</x-table.header>
                    </x-slot>

                    @forelse($users as $u)
                        <tr wire:key="user-{{ $u->id }}" wire:loading.class.delay="opacity-50">
                            {{-- Cambia y repite 'field' segun el atributo que corresponda --}}
                            <x-table.cell>{{ $u->nombre_completo }}</x-table.cell>
                            <x-table.cell>{{ $u->email }}</x-table.cell>
                            <x-table.cell>
                                <button wire:click="edit({{ $u->id }})" type="button" class="text-amber-600 hover:text-amber-900">
                                    <x-icon.pencil alt class="h-6 w-6"/>
                                </button>
                                <button wire:click="delete({{ $u->id }})" type="button" class="text-red-600 hover:text-red-900">
                                    <x-icon.trash class="h-6 w-6"/>
                                </button>
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
</div>
