<div>
    <span class="mb-2 text-2xl font-bold tracking-tight ">
        Cursos a impartir
    </span>



    <div class="grid grid-flow-row xl:grid-cols-3 lg:grid-cols-2 md:grid-cols-1">
        @forelse ($datos as $data)
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
            <div class="flex flex-col justify-center  px-6 mx-4 mb-2 text-black bg-white shadow-md rounded-lg border border-[#1b396a]">
                <p><span class="font-bold">Lugar: </span>{{$data->lugar}}</p>
                <p><span class="font-bold">Período: </span>{{ date('d-m-Y', strtotime($data->f1))}} - {{ date('d-m-Y', strtotime($data->f2))}}</p>
                <p><span class="font-bold">Horario: </span>{{ date("H:i", strtotime($data->h1))}} - {{ date("H:i", strtotime($data->h2))}} </p>
            </div>
        </div>
        @empty
            <div class="col-span-2 flex justify-center items-center my-16">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <span class="py-4 text-xl text-gray-400 font-medium">
                    No tiene cursos asignados actualmente...
                </span>
            </div>
        @endforelse
    </div>

</div>
