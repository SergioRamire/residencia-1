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

class CourseController extends Component
{
    use AuthorizesRequests;
    use WithFilters;
    use WithPagination;
    use WithSearching;
    use WithSorting;
    use WithTrimAndNullEmptyStrings;

    public Course $course;

    public int $perPage = 5;
    protected array $cleanStringsExcept = ['search'];
    public array $filters = [
        // 'modalidad' => '',
        'perfil' => '',
    ];

    public bool $showEditCreateModal = false;
    public bool $showViewModal = false;
    public bool $showConfirmationModal = false;
    public bool $edit = false;
    public bool $delete = false;

    protected $queryString = [
        'perPage' => ['except' => 5, 'as' => 'p'],
    ];

    public function rules(): array
    {
        return [
            'course.clave' => ['required', 'alpha_dash', 'max:10', Rule::unique('courses', 'clave')->ignore($this->course)],
            'course.nombre' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'course.objetivo' => ['required', 'max:255'],
            'course.perfil' => ['required', 'in:Formación docente,Actualización profesional'],
            'course.duracion' => ['required', 'integer', 'max:50'],
            'course.dirigido' => ['required', 'max:255'],
            'course.observaciones' => ['nullable', 'max:255'],
        ];
    }

    public function mount()
    {
        $this->blankCourse();
    }

    public function blankCourse()
    {
        /* Valores predefinidos para los <select> */
        $this->course = Course::make([
            'perfil' => '',
            // 'modalidad' => '',
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

        $this->blankCourse();

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

        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->course = $course;

        /* Convierte la cadena a arreglo para su uso en el <select> */
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

    public function confirmSave()
    {
        $this->validate();
        $this->showConfirmationModal = true;
    }

    public function save()
    {
        /* Convierte el arreglo a cadena para su uso inserción en la BD */
        $this->course->dirigido = implode(', ', $this->course->dirigido);

        $this->course->save();

        $this->showConfirmationModal = false;
        $this->showEditCreateModal = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' => $this->edit ? 'Course actualizado exitosamente' : 'Course creado exitosamente',
        ]);
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

    public function render()
    {
        return view('livewire.admin.courses.index', [
            'courses' => Course::query()
                // ->when($this->filters['modalidad'], fn ($query, $modalidad) => $query->where('modalidad', $modalidad))
                ->when($this->filters['perfil'], fn ($query, $perfil) => $query->where('perfil', $perfil))
                ->when($this->search, fn ($query, $search) => $query->where('nombre', 'like', "%$search%"))
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
