<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-jet-welcome /> --}}
                <div class="mt-4 bg-blue-100  overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-1">
                        <div>
                            {{-- <img class="mt-10" src="{{ asset('img/imagen.png') }}"> --}}
                        </div>
                        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                            <h2 class="text-justify text-xl font-extrabold tracking-tight text-gray-900">
                                La misión de la seguridad vial es prevenir accidentes de tránsito, que como nos demuestran las estadísticas del mundo
                                y de cualquier nación, en la actualidad, son un flagelo y una de las principales causas de muertes y discapacidades en
                                las personas.
                                </span>
                            </h2>
                        </div>
                        {{-- <div class="flex justify-center py-12 px-2">
                            <form method="get" action="{{ route('part.inscription') }}">
                                <div class="flex items-center justify-center">
                                    <x-jet-button class="ml-4">
                                        Iniciar Inscripcion
                                    </x-jet-button>
                                </div>
                            </form>
                            <div class="flex items-center justify-center">
                                <a href="{{ route('user.perfil') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">Revisar Informacion</a>
                            </div>
                        </div> --}}
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
~
