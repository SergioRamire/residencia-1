<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithFilters;
use App\Http\Traits\WithSearching;
use App\Http\Traits\WithSorting;
use App\Http\Traits\WithTrimAndNullEmptyStrings;
use App\Models\Course;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class CourseController extends Component
{
    use AuthorizesRequests;
    use WithFilters;
    use WithPagination;
    use WithSearching;
    use WithSorting;

    public Course $course;

    public int $perPage = 8;
    public array $filters = [
        // 'modalidad' => '',
        'perfil' => '',
    ];

    public bool $showEditCreateModal = false;
    public bool $showViewModal = false;
    public bool $showConfirmationModal = false;
    public bool $edit = false;
    public bool $delete = false;

     //variables de activar curso
    public bool $confirming_curse_active =false;
    public bool $confirming_course_Inactive =false;
    public $curse_id;

    public bool $permiso_eliminicacion = false;

    protected $queryString = [
        'perPage' => ['except' => 8, 'as' => 'p'],
    ];

    protected $rules = [
        // 'course.clave' => ['required', 'alpha_dash', 'max:10', Rule::unique('courses', 'clave')->ignore($this->course)],
        'course.clave' => ['required', 'regex:/^[A-Z,Ñ,a-z,0-9][A-Z,a-z, ,,0-9,ñ,Ñ,.,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/', 'max:40'],
        'course.nombre' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
        'course.objetivo' =>['required', 'regex:/^[A-Z,Ñ,a-z,0-9][A-Z,a-z, ,,0-9,ñ,Ñ,.,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/', 'max:255'],
        'course.perfil' => ['required', 'in:Formación docente,Actualización profesional'],
        'course.duracion' => ['required', 'integer', 'min:30', 'max:50'],
        'course.dirigido' => ['required', 'max:255'],
        'course.observaciones' => ['nullable', 'max:255'],
];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->blank_course();
    }

    public function blank_course()
    {
        /* Valores predefinidos para los <select> */
        $this->course = Course::make([
            'perfil' => '',
            // 'modalidad' => '',
            'duracion' => 30,
        ]);
    }

    /**
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('course.create');

        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->blank_course();

        $this->edit = false;
        $this->delete = false;
        $this->showEditCreateModal = true;
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Course $course)
    {
        $this->authorize('course.edit');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->course = $course;
        if (is_string($this->course->dirigido)) {
            $this->course->dirigido = array_map('trim', explode(',', $this->course->dirigido));
        }
        $this->edit = true;
        $this->delete = false;
        $this->showEditCreateModal = true;
    }

    public function view(Course $course)
    {
        $this->course = $course;

        /* Convierte la cadena en una lista */
        $this->course->dirigido = str_replace(', ', "\n", $this->course->dirigido);

        $this->edit = false;
        $this->delete = false;
        $this->showViewModal = true;
    }

    /**
     * @throws AuthorizationException
     */
    public function delete(Course $course)
    {
        $this->authorize('course.delete');
        $this->course = $course;
        $this->edit = false;
        $this->delete = true;
        $this->showConfirmationModal = true;
    }

    public function confirm_save()
    {
        // $this->validate();
        $this->showConfirmationModal = true;
    }

    public function save()
    {
        $this->course->dirigido = implode(', ', $this->course->dirigido);
        $this->validate();
        $this->course->save();
        $this->showConfirmationModal = false;
        $this->showEditCreateModal = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' => $this->edit ? 'Course actualizado exitosamente' : 'Course creado exitosamente',
        ]);
    }

    public function permiso_para_eliminar($id){
        $consulta = Course::join('course_details','course_details.course_id','=','courses.id')
                          ->where('courses.id','=',$id)
                          ->first();
        ($consulta != null) ? $this->permiso_eliminicacion = false : $this->permiso_eliminicacion = true;
    }

    public function destroy()
    {
        $this->course->delete();
        $this->showConfirmationModal = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' => 'Course eliminado exitosamente',
        ]);
    }

    public function area_activar($id){
        $this->curse_id = $id;
        $this->confirming_curse_active=true;
    }

    public function area_desactivar($id){
        $this->curse_id = $id;
        $this->confirming_course_Inactive=true;
    }

    public function activar(){
        DB::table('courses')
            ->where('courses.id','=',$this->curse_id)
            ->update(['estatus' => 1]);
        $this->confirming_curse_active=false;
    }

    public function desactivar(){
        DB::table('courses')
            ->where('courses.id','=',$this->curse_id)
            ->update(['estatus' => 0]);
        $this->confirming_course_Inactive=false;
    }

    public function render()
    {
        return view('livewire.admin.courses.index', [
            'courses' => Course::query()
                ->when($this->filters['perfil'], fn ($query, $perfil) => $query->where('perfil', $perfil))
                ->when($this->search, fn ($query, $search) => $query->where('nombre', 'like', "%$search%")
                    ->orWhere('clave', 'like', '%'.$this->search.'%')
                    ->orWhere('perfil', 'like', '%'.$this->search.'%'))
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
