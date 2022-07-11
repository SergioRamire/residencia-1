<x-app-layout>


    <x-slot name="header">
        <h2 class="py-6 font-semibold text-2xl text-gray-800 leading-tight">
            Bandeja de notificaciones.
        </h2>
    </x-slot>
     
    <div x-data="{ open: true, open2: false }">
        
        <button @click="open = true, open2 = false" x-bind:style="open && { background: 'rgba(219, 234, 254, 1)' }" class="py-2 px-6 rounded-t-lg bg-white ">No leídas</button>
        <button @click="open2 = true, open = false" x-bind:style="open2 && { background: 'rgba(219, 234, 254, 1)' }" class="py-2 px-6 rounded-t-lg bg-white ">Leídas</button>

        <div x-show="open" {{-- @click.outside="open = false" --}} >
            @if (auth()->user())
                @forelse ($postNotifications as $notification)
                    <div class="px-6 py-2 bg-blue-50">
                        <div class="flex justify-between">
                            <h5 class="text-2xl font-bold tracking-tight text-gray-900">
                                {{ $notification->data['title'] }}</h5>
                            <p class="font-normal text-gray-700">{{ $notification->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="flex justify-between">
                            <p class="font-normal text-gray-700">{{ $notification->data['description'] }}</p>
                            <a href={{ route('marcarunanoti', $notification->id) }} class="px-4 bg-white hover:text-white hover:bg-sky-600 text-black font-bold border border-sky-400 rounded shadow">
                                Marcar como leída
                            </a>
                        </div>
                    </div>
                    @if ($loop->last)
                        <div class="flex justify-center px-6 py-2 bg-blue-50">
                            <a href={{ route('markAsRead') }} class="text-blue-600 font-bold p-2 px-4 bg-white hover:text-white hover:bg-sky-600 border border-sky-400 rounded shadow">
                                Marcar todas las notificationes como leídas
                            </a>
                        </div>
                    @endif
                @empty
                    <div class="flex justify-center py-4 my-4 bg-white">
                        No tiene notificaciones nuevas.
                    </div>
                @endforelse
            @endif

        </div>

        <div x-show="open2" {{-- @click.outside="open2 = false" --}}>

            <div class="bg-blue-50">
                @if (auth()->user())
                    @forelse (auth()->user()->readNotifications as $notification)
                        <div class="px-6 py-2 bg-blue-50">
                            <div class="flex justify-between">
                                <h5 class="text-2xl font-bold tracking-tight text-gray-900">
                                    {{ $notification->data['title'] }}</h5>
                                <p class="font-normal text-gray-700">
                                    {{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex justify-between">
                                <p class="font-normal text-gray-700">{{ $notification->data['description'] }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="flex justify-center bg-white py-4 my-4">
                            No tiene notificaciones leidas
                            <div>
                    @endforelse
                    @if (auth()->user()->readNotifications()->get()->count() > 0)
                        <div class="flex justify-center px-6 py-2">
                            <a href={{ route('destroyNotifications') }} class="text-red-600 font-bold py-2 px-6 bg-white hover:text-white hover:bg-red-600 border border-red-400 rounded shadow"">
                                Eliminar todas las notificaciones Leídas
                            </a>
                            <div>
                    @endif
                @endif
                <div>

        </div>
    </div>
</x-app-layout>
