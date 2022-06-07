<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Asignacion de Instructor
        </h2>
    </x-slot>

    <div class="space-y-2">
        <!-- Tabla -->
        <div class="flex flex-col space-y-2">
            <!-- Periodo -->
            <div class="mt-4">
                <x-jet-label for="periodo" value="Periodo"/>
                <x-input.select wire:model="classification.periodo" class="mt-1 w-full" id="id_period" name="id_period" required>
                    <option value="" >Selecciona el Periodo</option>
                    @foreach(\App\Models\Period::all() as $period)
                        <option value="{{ $period->id }}">{{date('d-m-Y', strtotime($period->fecha_inicio))}} a {{date('d-m-Y', strtotime($period->fecha_fin))}}</option>
                    @endforeach
                </x-input.select>
            </div>
            <!-- INstructor -->
            <div>
            <div class="mt-4 sm:items-baselin sm:gap-x-1.5">
                <x-jet-label for="instructor" value="Nombre del participante"/>
                <x-input.select wire:model="id_instructor" class="mt-1 w-full" id="instructor" name="instructor" required>
                    <option value="">Selecciona el Instructor </option>
                    @foreach($datosuser as $u)
                        <option value="{{ $u->id }}"> {{ $u->name }} {{ $u->apellido_paterno }} {{ $u->apellido_materno }} RFC: {{ $u->rfc }}</option>
                    @endforeach
                </x-input.select>
            </div>
            </div>
            <!-- Curso y Grupo -->
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- Cyrso -->
                <div class="mt-4 sm:flex-1">

                <x-jet-label for="curso" value="Curso"/>
                <x-input.select wire:model="classification.curso" class="mt-1 w-full" id="curso" name="curso" required>
                    <option value="" >Selecciona el Curso</option>
                    @foreach(\App\Models\CourseDetail::join('courses','courses.id','=','course_details.course_id')
                                ->join('periods','periods.id','=', 'course_details.period_id')
                                ->where('course_details.period_id','=',$classification['periodo'])
                                ->select('course_details.course_id as id','courses.nombre')
                                ->distinct()
                                ->get() as $course)
                                <option value="{{ $course->id }}">{{$course->nombre}}</option>
                    @endforeach
                </x-input.select>
            </div>
            <!-- grupo -->
            <div class="mt-4 sm:flex-1">
                <x-jet-label for="grupo" value="Grupo"/>
                <x-input.select wire:model="classification.grupo" class="mt-1 w-full" id="grupo" name="grupo" required>
                    <option value="" >Selecciona el Grupo</option>
                    @foreach(\App\Models\CourseDetail::join('groups','groups.id','=','course_details.group_id')
                                ->join('periods','periods.id','=', 'course_details.period_id')
                                ->where('course_details.period_id','=',$classification['periodo'])
                                ->where('course_details.course_id','=',$classification['curso'])
                                ->select('course_details.group_id as id','groups.nombre')
                                ->distinct()
                                ->get() as $group)
                                <option value="{{ $group->id }}">{{$group->nombre}}</option>
                    @endforeach
                </x-input.select>
            </div>
        </div>
            <div class="flex flex-col sm:flex-row sm:items-baseline sm:gap-x-1.5">
                <!-- lugar -->
                <div class="mt-4 flex-1">
                    <x-jet-label for="lugar" value="lugar" />
                    <x-jet-input wire:model="lugar" class="block mt-1 w-full" type="text" disabled/>
                </div>
                <!-- hora inicio -->
                <div class="mt-4 flex-1">
                    <x-jet-label for="horario1" value="Hora de inicio:" />
                    <x-jet-input wire:model="horai" class="block mt-1 w-full" type="time" disabled/>
                </div>
                <!-- hora fin -->
                <div class="mt-4 flex-1">
                    <x-jet-label for="horario2" value="Hora de fin:" />
                    <x-jet-input wire:model="horaf" class="block mt-1 w-full" type="time" disabled/>
                </div>
            </div>

            <div class="mt-4 flex justify-end">
                <x-jet-button wire:click="registrar()" type="button">
                    Asignar Instructor
                </x-jet-button>
            </div>
        </div>
    </div>
</div>
