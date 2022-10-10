<?php

namespace App\Http\Livewire\Admin;

use App\Models\CourseDetail;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubirConstanciaController extends Component
{
    use WithFileUploads;

    public $constancia;
    public CourseDetail $course_detail;
    public User $user;

    public bool $showConfirmationModal = false;

    public function mount($id_user, $id_course_detail)
    {
        $this->user = User::find($id_user);
        $this->course_detail = CourseDetail::find($id_course_detail);
    }

    protected $rules = [
        'constancia' => ['file', 'mimes:pdf', 'max:5120'],
    ];

    public function updatedConstancia()
    {
        $this->validate();
    }

    public function store()
    {
        $this->validate();
        $this->showConfirmationModal = true;
    }

    public function save()
    {
        $existe_cedula = $this->remover_cedula_pasada($this->user->courseDetails()->find($this->course_detail->id)->inscription->url_cedula);

        $path = $this->constancia->store('constancias-firmadas', 'public');
        $this->user->courseDetails()->sync([
            $this->course_detail->id => ['url_cedula' => $path]
        ], false);

        $this->showConfirmationModal = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => $existe_cedula ? 'pencil' : 'success',
            'message' => $existe_cedula ? 'Constancia editada exitosamente' : 'Constancia subida exitosamente',
        ]);

        return redirect()->route('participante.studying');
    }

    private function remover_cedula_pasada(string $cedula): bool
    {
        if ($cedula) {
            Storage::disk('public')->delete($cedula);
            return true;
        }
        return false;
    }

    public function render()
    {
        return view('livewire.admin.subirContancia.index');
    }
}
