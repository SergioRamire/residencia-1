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

    public function mount($id_user, $id_course_detail)
    {
        $this->user = User::find($id_user);
        $this->course_detail = CourseDetail::find($id_course_detail);
    }

    protected $rules = [
        'constancia' => ['file', 'mimes:pdf', 'max:2048'],
    ];

    public function updatedConstancia()
    {
        $this->validate();
    }

    public function save()
    {
        $this->validate();

        $path = $this->constancia->store('constancias-subidas');

        $this->user->courseDetails()->sync([
            $this->course_detail->id => ['url_cedula' => $path]
        ], false);
    }

    public function render()
    {
        return view('livewire.admin.subir-constancia');
    }
}
