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
                <div class="mt-4 bg-gray-50  overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-1">

                            <div class="mt-4">
                                <img src="{{ asset('img/imagen.png') }}">
                            </div>
                            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                                <h2 class="text-justify text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                                        Los cursos intersemestrales son una 
                                        opción que se ofrecerá fuera del 
                                        periodo escolar regular para poder entrar a cursos 
                                        los cuales ayudan a agregar o refuerzar 
                                        conocimientos de los docentes.
                                    <span class=" text-xl block text-gray-900">Pueden ser de Actualizacion o Formacion </span>
                                </h2>
                                     <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                                        <form method="get" action="{{ route('admin.inscription') }}">
                                            <div class="flex items-center justify-center mt-4">
                                                <x-jet-button  class="ml-4">
                                                    Iniciar Inscripcion
                                                </x-jet-button>
                                            </div>
                                        </form>
                                        <form method="get" action="{{ route('perfil') }}">
                                            <div class="flex items-center justify-center mt-4">
                                                <x-jet-button  class="ml-4 bg-gray-200 text-gray-900">
                                                    Revisar Informacion
                                                </x-jet-button>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        
                    </div>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
~
