<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Notificaciones.
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="p-6 sm:px-20  bg-opacity-25 bg-white border-b bg-gray-200">

            <div class="mt-8 text-xl">
                Notificaciones sin leer...
            </div>

            <div class="mt-6 text-gray-600">
                @if (auth()->user())
                    @forelse ($postNotifications as $notification)
                        <div class="container color-white mx-auto">
                            <p>Titulo de la Notificación: {{ $notification->data['title'] }}</p>
                            <p> ----------------Mensaje: {{ $notification->data['description'] }}</p>
                            <p>{{ $notification->created_at->diffForHumans() }}</p>
                            {{-- <x-jet-button class="mark-as-read" type="submit" data-id="{{ $notification->id }}">
                                Mark as read
                            </x-jet-button> --}}
                            {{-- <button type="submit" class="mark-as-read btn btn-sm btn-dark" data-id="{{$notification->id }}">Mark as read</button> --}}
                            <a href={{route('marcarunanoti', $notification->id)}} class="dropdown-item dropdown-footer" data-id="">Marcar la notification</a>
                        </div>

                        @if ($loop->last)
                        {{-- <a href="{{route('markAsRead')}}" id="mark-all">Mark all as read</a>--}}
                        <a href={{route('markAsRead')}} class="dropdown-item dropdown-footer">Marcar las notificationes como leídas</a>
                        {{-- <x-jet-button href="{{route('markAsRead')}}">
                            Marcar todo como leído
                        </x-jet-button> --}}
                        {{-- <a href="#" id="mark-all"></a> --}}
                        <a href={{route('destroyNotificationsss')}} class="dropdown-item dropdown-footer">Eliminar todas las notificaciones</a>
                        {{-- <x-jet-button href="{{route('destroyNotifications')}}" class="ml-3">
                            Eliminar notificaciones
                        </x-jet-button> --}}
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

            <div class="mt-8 text-xl">
                Notificaciones Leídas...
            </div>

            <div class="mt-6 text-gray-600">
                <div class="dropdown-divider"></div>
                  {{-- <span class="dropdown-header">Read Notifications</span> --}}
                  @forelse (auth()->user()->readNotifications as $notification)
                  <div class="container color-white mx-auto">
                    <p>Titulo de la Notificación: {{ $notification->data['title'] }}</p>
                    <p> ----------------Mensaje: {{ $notification->data['description'] }}</p>
                    <p>{{ $notification->created_at->diffForHumans() }}</p>
                    <a href={{route('destroyNotifications')}} class="dropdown-item dropdown-footer">Eliminar todas las notificaciones leídas</a>
                </div>
                  @empty
                  No tiene notificaciones
                  @endforelse

            </div>
        </div>

        {{-- <a href={{route('deleteNotifications')}} class="dropdown-item dropdown-footer">Boton maestro</a> --}}
    </div>

</x-app-layout>
