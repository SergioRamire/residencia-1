<?php

namespace App\Http\Livewire\Admin;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseController extends Component
{
    use WithPagination;

    public Course $course;
    public $perPage = 5;
    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'asc';
    public $filters = [
        'modalidad' => '',
        'perfil' => '',
    ];

    public $showEditCreateModal = false;
    public $showViewModal = false;
    public $showConfirmationModal = false;
    public $edit;
    public $delete;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDirection',
    ];

    protected $rules = [
        'course.clave' => 'required|alpha_dash|max:10|unique:courses,clave',
        'course.nombre' => 'required|string|max:255',
        'course.objetivo' => 'required|string|max:255',
        'course.perfil' => ['required', 'in:Formación docente,Actualización profesional'],
        'course.duracion' => 'required|integer|max:50',
        'course.modalidad' => ['required', 'in:En linea,Presencial,Semi-presencial'],
        'course.dirigido' => 'required|max:255',
        'course.observaciones' => 'present|max:255',
    ];

    public function mount()
    {
        $this->blankCourse();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function blankCourse()
    {
        /* Valores predefinidos para los <select> */
        $this->course = Course::make([
            'perfil' => '',
            'modalidad' => '',
        ]);
    }

    public function create()
    {
        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->blankCourse();

        $this->edit = false;
        $this->delete = false;
        $this->showEditCreateModal = true;
    }

    public function edit(Course $course)
    {
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

    public function delete(Course $course)
    {
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
                ->when($this->filters['modalidad'], fn ($query, $modalidad) => $query->where('modalidad', $modalidad))
                ->when($this->filters['perfil'], fn ($query, $perfil) => $query->where('perfil', $perfil))
                ->when($this->search, fn ($query, $search) => $query->where('nombre', 'like', "%$this->search%"))
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate($this->perPage),
        ]);
    }
}
