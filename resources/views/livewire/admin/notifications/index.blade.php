<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            NOTIFICACIONES EN EL SISTEMA
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">
            <!-- Botón de nuevo -->
            <div>
                <x-jet-secondary-button wire:click="create()" title="Crear nueva notificación" class="border-[#1b396a] text-[#1b396a] hover:text-sky-500 active:text-[#1b396a] active:bg-sky-50">
                    <x-icon.plus solid alt="sm" class="inline-block h-5 w-5" />
                    Nueva Notificación
                </x-jet-secondary-button>
            </div>

            <!-- Opciones de tabla -->
            <div class="md:flex md:justify-between space-y-2 md:space-y-0">
                <!-- Parte izquierda -->
                <div class="md:w-1/2 md:flex space-y-2 md:space-y-0 md:space-x-2">
                    <!-- Barra de búsqueda -->
                    <div class="w-full">
                        <x-input.icon wire:model="search" class="w-full" type="text" placeholder="Buscar Notificaciones...">
                            <x-icon.search solid class="h-5 w-5 text-gray-400"/>
                        </x-input.icon>
                        <label><p class="text-xs font-bold">Buscar por: Asunto, cuerpo o destinatario</p></label>
                    </div>
                </div>
                <div>
                    <x-jet-secondary-button wire:click="delete_noti()" title="Eliminar notificaciones enviadas" class="border-red-300 text-red-700 hover:text-red-500 active:text-red-800 active:bg-red-50">
                        <x-icon.trash d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" class="inline-block h-5 w-5"/>
                        Eliminar notificaciones
                    </x-jet-secondary-button>
                </div>

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
                        <x-table.header>Asunto</x-table.header>
                        <x-table.header>cuerpo</x-table.header>
                        <x-table.header>Destinatario</x-table.header>
                        <x-table.header>Enviado</x-table.header>
                        <x-table.header>Opción</x-table.header>
                    </x-slot>

                    @forelse($postss as $r)
                            <tr>
                                <x-table.cell>{{ $r->title }}</x-table.cell>
                                <x-table.cell>{{ $r->description}}</x-table.cell>
                                <x-table.cell>{{ $r->role}}</x-table.cell>
                                <x-table.cell>{{ $r->created_at->diffForHumans()}}</x-table.cell>
                                <x-table.cell width='200' class="whitespace-nowrap">
                                    <button wire:click="view({{$r->id}})" type="button" class="mr-1 text-indigo-600 hover:text-indigo-900">
                                        <x-icon.eye class="h-6 w-6"/>
                                    </button>
                                    <button  wire:click="delete_post('{{$r->id}}' , '{{$r->title}}')" type="button" class="ml-1 text-red-600 hover:text-red-900">
                                        <x-icon.trash class="h-6 w-6"/>
                                    </button>
                                </x-table.cell>
                            </tr>
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
                    {{ $postss->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modales -->
    @if($create)
        @include('livewire.admin.notifications.create')
    @endif
    @if($confirming_part_deletion)
        @include('livewire.admin.notifications.destroy')
    @endif
    @if($confirmin_notificacion)
        @include('livewire.admin.notifications.destroy_notification')
    @endif
    @if($show_view_modal)
        @include('livewire.admin.notifications.show')
    @endif
</div>
