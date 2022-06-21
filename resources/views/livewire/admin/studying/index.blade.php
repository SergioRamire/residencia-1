<div>
    Mis cursos
    {{$estatus}}
    @if (strcmp($estatus, 'Participante') === 0)
        <div class="grid grid-flow-row xl:grid-cols-3 lg:grid-cols-2 md:grid-cols-1">
            {{-- <div class="grid grid-cols-3 md:grid-cols-max"> --}}
            @foreach ($datos as $data)
                <div class="flex flex-col m-2 max-w-md bg-#white rounded-lg border shadow-md ">
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
                        <p class="mb-3 font-normal "><span class="font-bold">Instructor: </span> Here are the biggest enterprise</p>
                        <p class="mb-3 font-normal "><span class="font-bold">Califiacion Final: </span>
                            @if ($data->califi == 0)
                                Sin asignar
                            @else
                                {{ $data->califi }}
                            @endif
                        </p>
                    </div>

                    <div class="flex flex-col justify-center  px-6 mx-4 mb-2 text-black bg-white shadow-md rounded-lg border border-[#1b396a]">
                        <p>{{ date('d-m-Y', strtotime($data->f1))}} - {{ date('d-m-Y', strtotime($data->f2))}}</p>
                        <p>{{ date("g:i a", strtotime($data->h1))}} - {{ date("g:i a", strtotime($data->h2))}} </p>
                    </div>

                </div>
            @endforeach
        </div>
    @else
        <div class="grid grid-flow-row xl:grid-cols-3 lg:grid-cols-2 md:grid-cols-1">
            {{-- <div class="grid grid-cols-3 md:grid-cols-max"> --}}
            @foreach ($datos as $data)
                <div class="flex flex-col m-2 max-w-md bg-#white rounded-lg border shadow-md ">
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

                    {{-- <div class="flex flex-col justify-center  px-6 mx-4 mb-">
                    </div> --}}

                    <div class="flex flex-col justify-center  px-6 mx-4 mb-2 text-black bg-white shadow-md rounded-lg border border-[#1b396a]">
                        <p>{{ date('d-m-Y', strtotime($data->f1))}} - {{ date('d-m-Y', strtotime($data->f2))}}</p>
                        <p>{{ date("g:i a", strtotime($data->h1))}} - {{ date("g:i a", strtotime($data->h2))}} </p>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>

