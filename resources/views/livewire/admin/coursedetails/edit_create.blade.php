<x-jet-dialog-modal wire:ignore.self wire:model.defer="showEditCreateModal">
    <x-slot name="title">
        Detalles de curso
    </x-slot>
    <x-slot name="content">
        <x-jet-label for="x" class="text-red-600" value="Los campos con * son obligatorios" />
        <div class="mt-4 flex-1">
            <x-jet-label>Seleccione el Curso <span class="text-red-600">*</span></x-jet-label>
            @livewire('admin.course-select')
        </div>

        <form wire:submit.prevent="updateDetails()" id="courseForm">
            <!-- Nombre  Curso-->
            <!-- Periodo y Hora inicio y Hora fin -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Periodo -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="periodo">Periodo <span class="text-red-600">*</span></x-jet-label>
                    @livewire('admin.period-select2')
                </div>
                <!-- Modalidad -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="modalidad">Modalidad <span class="text-red-600">*</span></x-jet-label>
                    <x-input.select wire:model.defer="modalidad" id="modalidad" class="mt-1 w-full" name="modalidad" required>
                        <option value="" disabled>Selecciona modalidad...</option>
                        <option value="Presencial" selected>Presencial</option>
                        <option value="Semi-presencial">Semi-presencial</option>
                        <option value="En linea">En linea</option>
                    </x-input.select>
                    <x-jet-input-error for="course.modalidad"/>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Hora inicio -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="hora_inicio">Hora inicio <span class="text-red-600">*</span></x-jet-label>
                    <x-datepicker wire:model.defer="hora_inicio" class="block mt-1 w-full" ref="hora_inicio1" name="hora_inicio1"
                                  :config="['enableTime' => true, 'noCalendar' => true, 'dateFormat' => 'H:i', 'time_24hr' => true]"/>
                    <x-jet-input-error for="hora_inicio" />
                </div>

                <!-- Hora fin -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="hora_fin">"Hora fin <span class="text-red-600">*</span></x-jet-label>
                    <x-datepicker wire:model.defer="hora_fin" class="block mt-1 w-full" ref="hora_fin1" name="hora_fin1"
                                  :config="['enableTime' => true, 'noCalendar' => true, 'dateFormat' => 'H:i', 'time_24hr' => true]"/>
                    <x-jet-input-error for="hora_fin" />
                </div>
            </div>

            <!-- Lugar -->
            <div class="mt-4">
                <x-jet-label for="lugar">Lugar <span class="text-red-600">*</span></x-jet-label>
                <x-input.error wire:model.defer="lugar" class="block mt-1 w-full" type="text" id="lugar" name="lugar"
                    for="lugar" required />
            </div>

            <!-- Capacidad y Grupo -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">

                <!-- Capacidad -->
                <div class="mt-4">
                    <x-jet-label for="capacidad">Capacidad <span class="text-red-600">*</span></x-jet-label>
                    <x-input.error wire:model.defer="capacidad" class="block mt-1 w-full" type="number" id="capacidad"
                        name="capacidad" for="capacidad" maxlength="2" required />
                </div>

                <!-- Grupo -->
                <div class="mt-4 sm:flex-1">
                    <x-jet-label for="grupo">Grupo <span class="text-red-600">*</span></x-jet-label>
                    <x-input.select wire:model.defer="grupo_id" class="mt-1 w-full" id="grupo_id" name="grupo_id"
                        required>
                        <option value="" disabled>Selecciona el grupo</option>
                        @foreach (\App\Models\Group::all() as $group)
                            <option value="{{ $group->id }}">{{ $group->nombre }}</option>
                        @endforeach
                    </x-input.select>
                </div>
            </div>
        </form>
    </x-slot>

    <x-slot name="footer">
        <x-jet-secondary-button wire:click="$toggle('showEditCreateModal')" wire:loading.attr="disabled">
            Cancelar
        </x-jet-secondary-button>

        <x-jet-button class="ml-3" wire:loading.attr="disabled" form="courseForm">
            Datos
        </x-jet-button>
        @if ($confirmingSaveDetails)
            @include('livewire.admin.coursedetails.confirmation')
        @endif
    </x-slot>
</x-jet-dialog-modal>
