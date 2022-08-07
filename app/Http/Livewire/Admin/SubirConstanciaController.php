<?php

namespace App\Http\Livewire\Admin;

use App\Models\CourseDetail;
use App\Models\User;
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
        $url_cedula_before = $this->user->courseDetails()->find(8)->inscription->url_cedula;
        $path = $this->constancia->store('constancias-firmadas', 'public');

        $this->user->courseDetails()->sync([
            $this->course_detail->id => ['url_cedula' => $path]
        ], false);

        $this->showConfirmationModal = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' =>  $url_cedula_before ? 'pencil' : 'success',
            'message' => $url_cedula_before ? 'Constancia editada exitosamente' : 'Constancia subida exitosamente',
        ]);
        return redirect()->route('participant.studying');
    }

    public function render()
    {
        return view('livewire.admin.subirContancia.index');
    }
}
