<div>
    <span class="mb-2 text-2xl font-bold tracking-tight ">
    Mis cursos
    </span>

    <div class="grid grid-flow-row xl:grid-cols-3 lg:grid-cols-2 md:grid-cols-1">
        @foreach ($datos as $data)
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
                    <p class="mb-3 font-normal "><span class="font-bold">Instructor: </span> Esta en proceso la consulta</p>
                    <p class="mb-3 font-normal "><span class="font-bold">Califiacion Final: </span>@if ($data->califi == 0)Sin asignar @else{{ $data->califi }}@endif</p>
                </div>

                <div class="flex flex-col justify-center py-2 px-6 mx-4 mb-2 text-black bg-white shadow-md rounded-lg border border-[#1b396a] ">
                    <p><span class="font-bold">Lugar: </span>{{$data->lugar}}</p>
                    <p><span class="font-bold">Periodo: </span>{{ date('d-m-Y', strtotime($data->f1))}} - {{ date('d-m-Y', strtotime($data->f2))}}</p>
                    <p><span class="font-bold">Horario: </span>{{ date("H:i", strtotime($data->h1))}} hrs. - {{ date("H:i", strtotime($data->h2))}} hrs.</p>

                    <div class="text-center">
                        <x-table.cell class="text-center">
                            <button wire:click="download_pdf({{$data->iduser}},{{$data->idcurso}})" title="Descargar cédula sin firma" class="bg-white border border-gray-800 hover:bg-gray-400 text-gray-800 font-bold py-1 px-1 rounded inline-flex items-center">
                                Cédula de inscripción
                            </button>
                        </x-table.cell>
                    </div>
                </div>

            </div>
        @endforeach

    </div>
</div>


