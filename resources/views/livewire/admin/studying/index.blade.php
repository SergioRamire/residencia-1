<div>
    <span class="mb-2 text-2xl font-bold tracking-tight ">
    Mis cursos
    </span>

    @if (count($datos_en_curso))
        <div class="my-4 ">
            <div class="px-2 bg-white rounded-lg border border-gray-200 shadow-md sm:p-3 lg:p-4 ">
                <h5 class="text-xl font-medium text-blue-600">AVISO</h5>
                <p class="text-justify"><strong>Recuerde que,</strong> para aprobar y obtener la constancia de acreditación por curso debes de, cumplir con el <strong>mínimo de asistencias</strong>
                    y tener una <strong>calificación mayor o igual a 70.</strong></p>
            </div>
        </div>
    @endif
    {{-- Cursos en curso --}}
    {{-- <div class="my-4">
        <span class="mb-2 text-xl font-bold">En cursos</span>
    </div> --}}
    <div class="grid grid-flow-row xl:grid-cols-3 lg:grid-cols-2 md:grid-cols-1">
        @forelse ($datos_en_curso as $data)
            <div class="flex flex-col  m-2 max-w-md bg-#white rounded-lg border shadow-md transition ease-in-out bg-white hover:-translate-y-1 hover:scale-105 hover:bg-blue-50 duration-300" >

                <div class="flex flex-row p-2 m-4 bg-white text-black border shadow-md rounded-lg">
                    <div class="mr-2 text-[#1b396a] h-12 w-12">{{-- Icono --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <span class="mb-2 text-xl tracking-tight ">{{ $data->curso_clave }} -</span>
                        <span class="mb-2 text-2xl font-bold tracking-tight ">{{ $data->curso_nombre }}</span>
                        <span class="mb-2 text-xl tracking-tight ">({{ $data->nombre_grupo }})
                        </span>
                    </div>
                </div>

                <div class="flex flex-col justify-center  px-6 mx-4 mb-">
                    <div class="mb-3">
                        <p class="font-normal "><span class="font-bold">Instructor: </span> </p>
                        @forelse ($this->consulta_instructor($data->idcurso) as $insx)
                            <p class="font-normal ">{{$insx->nombre}} </p>
                        @empty
                            <p class="font-normal ">Sin instructor </p>
                        @endforelse

                    </div>
                    <p class="mb-3 font-normal "><span class="font-bold">Calificación Final: </span>@if ($data->califi == 0)Sin asignar @else{{ $data->califi }}@endif</p>
                </div>

                <div class="flex flex-col justify-center py-2 px-6 mx-4 mb-2 text-black bg-white shadow-md rounded-lg border border-[#1b396a] ">
                    <p><span class="font-bold">Lugar: </span>{{$data->lugar}}</p>
                    <p><span class="font-bold">Periodo: </span>{{ date('d-m-Y', strtotime($data->f1))}} al {{ date('d-m-Y', strtotime($data->f2))}}</p>
                    <p><span class="font-bold">Horario: </span>{{ date("H:i", strtotime($data->h1))}} hrs. - {{ date("H:i", strtotime($data->h2))}} hrs.</p>

                    <div class="text-center">
                        @if($data->url_cedula)
                            <a href="{{ route('participant.subir-cedula', [$data->iduser, $data->idcurso]) }}" title="Subir cédula firmada" class="mb-1 bg-white border border-amber-800 hover:bg-amber-400 text-amber-800 font-bold py-1 px-1 rounded inline-flex items-center">
                                Volver a subir cédula firmada
                            </a>

                            <button wire:click="ver_constancia_firmada({{ $data->idcurso }})" title="Ver cédula firmada" class="mb-1 bg-white border border-blue-800 hover:bg-blue-400 text-blue-800 font-bold py-1 px-1 rounded inline-flex items-center">
                                Ver cédula firmada
                            </button>
                        @else
                            <a href="{{ route('participant.subir-cedula', [$data->iduser, $data->idcurso]) }}" title="Cargar cédula firmada" class="mb-1 bg-white border border-amber-800 hover:bg-amber-400 text-amber-800 font-bold py-1 px-1 rounded inline-flex items-center">
                                Subir cédula firmada
                            </a>
                        @endif
                        <button wire:click="download_pdf({{$data->iduser}},{{$data->idcurso}})" title="Descargar cédula sin firma" class="bg-white border border-gray-800 hover:bg-gray-400 text-gray-800 font-bold py-1 px-1 rounded inline-flex items-center">
                            Cédula de inscripción
                        </button>

                    </div>

                </div>

            </div>
        @empty
            <div class="col-span-2 flex justify-center items-center my-16">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="py-4 text-xl text-gray-400 font-medium">
                    No se encuentra inscrito a un curso actualmente...
                </span>
            </div>
        @endforelse
    </div>

</div>


