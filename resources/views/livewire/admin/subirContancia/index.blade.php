<div>
    <x-slot name="header">
        <h2 class="font-black text-xl text-gray-800 leading-tight mb-4">
            Subir constancia firmada
        </h2>
        <div>
            <p><span class="font-black">Curso:</span> {{ $course_detail->course->nombre }}</p>
            <p><span class="font-black">Grupo:</span>  {{ $course_detail->group->nombre }}</p>
            <p><span class="font-black">Periodo:</span>  {{ $course_detail->period->clave }}</p>
            <p>
                <span class="font-black">Fecha:</span>  {{ $course_detail->period->fecha_inicio }} a {{ $course_detail->period->fecha_fin }}
            </p>
            <p>
                <span class="font-black">Hora:</span>  {{ $course_detail->hora_inicio }} a {{ $course_detail->hora_fin }}
            </p>

        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">

            <div class="flex justify-center items-center w-full"
                 x-data="{ isUploading: false, progress: 0 }"
                 x-on:livewire-upload-start="isUploading = true"
                 x-on:livewire-upload-finish="isUploading = false"
                 x-on:livewire-upload-error="isUploading = false"
                 x-on:livewire-upload-progress="progress = $event.detail.progress"
            >
                <label for="dropzone-file" class="flex flex-col justify-center items-center w-full h-64 bg-gray-50 border-gray-300 rounded-lg border-2 border-dashed cursor-pointer">
                    <div class="flex flex-col justify-center items-center pt-5 pb-6">
                        {{-- Icono --}}
                        <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>

                        {{-- Texto --}}
                        @unless($constancia)
                            <div class="text-gray-500 text-center">
                                <p class="mb-2 text-sm"><span class="font-semibold">Da click</span> para cargar la constancia firmada</p>
                                <p class="text-xs">PDF (MAX. 2Mb)</p>
                            </div>
                        @else
                            <div class="text-gray-800">
                                <p class="mb-2 text-sm  text-center">
                                    {{ $constancia->getClientOriginalName() }}
                                </p>
                            </div>
                        @endunless
                    </div>

                    {{-- Animación de progreso --}}
                    <div class="w-1/3 bg-gray-200 rounded-full mb-4" x-show="isUploading">
                        <div class="bg-blue-300 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                             x-bind:style="{width: isUploading ? progress+'%' : '0%'}"
                        > <span x-html="progress"></span>%</div>
                    </div>

                    @error('constancia')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </label>
            </div>

            <form wire:submit.prevent="store()" class="flex justify-center">
                <input wire:model="constancia" id="dropzone-file" name="constancia" type="file" class="hidden"/>
                <x-jet-button class="ml-3 bg-[#1b396a]" title="Subir solo archivo PDF">
                    Subir
                </x-jet-button>
            </form>

        </div>
    </div>

    @include('livewire.admin.subirContancia.confirmation')
</div>
