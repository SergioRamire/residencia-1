<div>
    Mis cursos
    {{-- <div class="grid grid-cols-4 gap-4 bg-gray-300">
        <div class="flex flex-col w-56">
            <div class="m-4 p-2 bg-slate-400 h-28">1</div>
            <div class="m-4 p-2 bg-slate-400 h-28 flex flex-col justify-center">2</div>
            <div class="m-4 p-2 bg-slate-400 h-28 flex flex-col justify-end">3</div>
        </div>
      </div> --}}

    <div class="grid grid-cols-3">
        @foreach ($datos as $data)
            <div class="flex flex-col p-6 m-4 max-w-md bg-white rounded-lg border border-gray-200 shadow-md ">
                <div class="flex flex-row">
                    <div>{{-- Icono --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                    </div>
                    <div>
                        <span class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">{{ $data->curso_clave }} -</span>
                        <span class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">{{ $data->curso_nombre }}</span>
                        <span class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">({{ $data->nombre_grupo }})
                        </span>
                    </div>
                </div>

                <div class="flex flex-col justify-center">
                    <p class="mb-3 font-normal text-gray-700 ">Instructor: Here are the biggest enterprise</p>
                    <p class="mb-3 font-normal text-gray-700 ">Califiacion Final: {{ $data->califi }}</p>
                    <p>{{ $data->f1 }} - {{ $data->f2 }}</p>
                    <p>{{ $data->h1 }} - {{ $data->h2 }}</p>
                </div>

                <div class="flex flex-col justify-end">
                    <x-jet-secondary-button wire:click=""
                        class="border-sky-800 text-sky-700 hover:text-sky-500 active:text-sky-800 active:bg-sky-50">
                        <x-icon.info solid alt="sm" class="inline-block h-5 w-5" /> Ver Programa
                    </x-jet-secondary-button>
                </div>
            </div>
        @endforeach
    </div>
</div>


