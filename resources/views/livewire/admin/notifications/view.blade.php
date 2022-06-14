<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Notificaciones.
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="p-6 sm:px-20  bg-opacity-25 bg-white border-b bg-gray-200">

            <div class="mt-8 text-2xl leading-9 font-bold tracking-tight text-blcak sm:text-1xl sm:leading-10">
                Notificaciones sin leer...
            </div>

            <div class="mt-6 text-gray-600">
                @if (auth()->user())
                    @forelse ($postNotifications as $notification)
                        <div class="max-w-screen border rounded-lg mx-auto text-left py-4 mx-8">
                            <h2 class="text-2xl leading-9 font-bold tracking-tight text-blcak sm:text-1xl sm:leading-10">
                                {{'Titulo: '}}{{ $notification->data['title'] }}
                            </h2>
                            <h3 class="ml-2 text-1xl text-black sm:text-2xl sm:leading-10">
                                Mensaje: {{ $notification->data['description'] }}
                            </h3>
                            <h4 class="ml-6">{{ $notification->created_at->diffForHumans() }}</h4>
                            <div class="ml-4 mt-4 text-rigth">
                                <div class="inline-flex rounded-md bg-white shadow">
                                    <a href={{route('marcarunanoti', $notification->id)}} class="text-gray-700 font-bold py-2 px-6">
                                        Marcar Notificación
                                    </a>
                                </div>
                            </div>
                        </div>

                        @if ($loop->last)
                        {{-- <a href="{{route('markAsRead')}}" id="mark-all">Mark all as read</a>--}}
                        <div class="ml-2 mt-4 text-rigth">
                            <div class="inline-flex rounded-md bg-white shadow">
                                <a href={{route('markAsRead')}} class="text-blue-600 font-bold py-2 px-6">
                                    Marcar todas las notificationes como leídas
                                </a>
                            </div>
                            {{-- <div class="inline-flex rounded-md bg-white text-red shadow">
                                <a href={{route('destroyNotificationsss')}} class="text-red-600 font-bold py-2 px-6">
                                    Eliminar todas las notificaciones
                                </a>
                            </div> --}}
                        </div>
                        @endif

                        @empty
                        No tiene notificaciones
                    @endforelse

                @endif
            </div>

        </div>
    </div>

    <div class="max-w-7xl mx-auto">
        <div class="p-6 sm:px-20  bg-opacity-25 bg-white border-b border-gray-200">

            <div class="mt-8 text-2xl leading-9 font-bold tracking-tight text-blcak sm:text-1xl sm:leading-10">
                Notificaciones Leídas...
            </div>

            <div class="mt-6 text-gray-600">
                <div class="dropdown-divider"></div>
                  {{-- <span class="dropdown-header">Read Notifications</span> --}}
                @if(auth()->user())
                    @forelse (auth()->user()->readNotifications as $notification)
                        <div class="max-w-screen border rounded-lg mx-auto text-left py-4 mx-8">
                            <h2 class="text-2xl leading-9 font-bold tracking-tight text-blcak sm:text-1xl sm:leading-10">
                                {{'Titulo: '}}{{ $notification->data['title'] }}
                            </h2>
                            <h3 class="ml-2 text-1xl text-black sm:text-2xl sm:leading-10">
                                Mensaje: {{ $notification->data['description'] }}
                            </h3>
                            <h4 class="ml-6">{{ $notification->created_at->diffForHumans() }}</h4>
                        </div>
                    @empty
                        No tiene notificaciones
                    @endforelse
                    @if(auth()->user()->readNotifications()->get()->count() > 0)
                        <div class="ml-2 mt-4 text-rigth">
                            <div class="inline-flex rounded-md bg-white text-red shadow">
                                <a href={{route('destroyNotifications')}} class="text-red-600 font-bold py-2 px-6">
                                    Eliminar todas las notificaciones Leídas
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>


        {{-- <a href={{route('deleteNotifications')}} class="dropdown-item dropdown-footer">Boton maestro</a> --}}
    </div>

</x-app-layout>
{{-- <x-app-layout>@if($deletetodasnotifi)
    @include('livewire.admin.notifications.deletenotifiusuario')
    @endif</x-app-layout> --}}
