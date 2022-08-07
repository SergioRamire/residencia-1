<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Subir constancia
        </h2>
        <div>
            <p>Curso: {{ $course_detail->course->nombre }}</p>
            <p>Grupo: {{ $course_detail->group->nombre }}</p>
            <p>Periodo: {{ $course_detail->period->clave }}</p>
            <p>Fecha: {{ $course_detail->period->fecha_inicio }} a {{ $course_detail->period->fecha_fin }}</p>
            <p>Hora: {{ $course_detail->hora_inicio }} a {{ $course_detail->hora_fin }}</p>

        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">

            <div class="flex justify-center items-center w-full">
                <label for="dropzone-file" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 border-gray-300 rounded-lg border-2 border-dashed cursor-pointer">
                    <div class="flex flex-col justify-center items-center pt-5 pb-6">
                        {{-- Icono --}}
                        <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>

                        {{-- Texto --}}
                        @unless($constancia)
                            <div class="text-gray-500">
                                <p class="mb-2 text-sm text-center"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-xs">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                            </div>
                        @else
                            <div class="text-gray-800">
                                <p class="mb-2 text-sm  text-center">
                                    {{ $constancia->getClientOriginalName() }}
                                </p>
                            </div>
                        @endunless
                    </div>

                    <form wire:submit.prevent="save">
                        <input wire:model="constancia" id="dropzone-file" name="constancia" type="file" class="hidden"/>
                        <x-jet-button class="ml-3 bg-[#1b396a]">
                            Subir
                        </x-jet-button>
                    </form>

                    @error('constancia')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </label>
            </div>

        </div>
    </div>
</div>
