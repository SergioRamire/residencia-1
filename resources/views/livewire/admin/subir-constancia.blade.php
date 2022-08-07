<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Subir constancia
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto pt-5 pb-10">
        <div class="space-y-2">

            <div class="flex justify-center items-center w-full" x-data="drop_file_component()">
                <label for="dropzone-file" class="flex flex-col justify-center items-center w-full h-64 rounded-lg border-2 border-dashed cursor-pointer"
                       :class="dropFile ? 'bg-gray-200 border-gray-500' : 'bg-gray-50 border-gray-300'"
                       x-on:drop="dropFile = false"
                       x-on:drop.prevent="handleFileDrop($event)"
                       x-on:dragover.prevent="dropFile = true"
                       x-on:dragleave.prevent="dropFile = false"
                >
                    <div class="flex flex-col justify-center items-center pt-5 pb-6">
                        {{-- Icono --}}
                        <svg aria-hidden="true" class="mb-3 w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                             :class="dropFile ? 'text-gray-600' : 'text-gray-400'">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>

                        {{-- Texto --}}
                        <div :class="dropFile ? 'text-gray-700' : 'text-gray-500'">
                            <p class="mb-2 text-sm text-center"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                    </div>

                    {{-- Animación de procesamiento --}}
                    <div class="mt-1" wire:loading.flex wire.target="files">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <p class="text-gray-500">Procesando archivo</p>
                    </div>
                    <input wire:model="constancia" id="constancia" name="constancia" type="file" class="hidden"/>
                    @error('constancia')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </label>
            </div>

        </div>
    </div>

    <script>
        function drop_file_component() {
            return {
                dropFile: false,
                handleFileDrop(e) {
                    if (event.dataTransfer.files.length > 0) {
                        const file = e.dataTransfer.files;
                        @this.
                        upload('file', file,
                            (uploadedFilename) => {
                            }, () => {
                            }, (event) => {
                            }
                        )
                    }
                }
            };
        }
    </script>
</div>
