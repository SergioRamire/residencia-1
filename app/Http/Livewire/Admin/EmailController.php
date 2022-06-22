<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSearching;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarEmailCurso;
use App\Mail\OrderShipped;

Use App\Models\CourseDetail;
use Illuminate\Support\Arr;
use App\Models\Email;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EmailController extends Component
{
    use WithPagination;
    use WithSearching;

    public Email $correo;

    public $post;
    public $edit = false;
    public $create = false;
    public $showEditModal = 0;
    public $showViewModal =false;
    public $confirmingPartDeletion = false;
    public $confirmingSaveParti = false;
    public $confirminNotificacion=false;
    public $deletetodasnotifi= false;
    public $confirmingSaveEmail=false;
    public $perPage = '5';
    public $arreglo=[];
    // public $search = '';
    protected array $cleanStringsExcept = ['search'];

    //atributos del mensaje
    public $arr=[
        'title' => '',
        'description' =>'',
    ];

    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('search');
    }

    public function cursos($user,$unionarreglos){
        $count =0;
        foreach($unionarreglos as $curso){
            $algo= CourseDetail::join('courses','courses.id','=','course_details.course_id')
                    ->join('groups', 'groups.id', '=', 'course_details.group_id')
                    ->join('periods','periods.id','=','course_details.period_id')
                    ->select('courses.nombre as name', 'course_details.hora_inicio as horaini', 'course_details.hora_fin as horafin','groups.nombre as grupo', 'periods.fecha_inicio as fi','periods.fecha_fin as ff')
                    ->where('course_details.id','=',$curso)->get();
            $this->arreglo[$count]=$algo;
            $count++;
        }

        $this->send($user);
    }

    public function send($user){

        Mail::to($user->email)
            ->send(new EnviarEmailCurso($this->arreglo, $user));
    }

    public function create()
    {
        // $this->resetInputFields();
        $this->openModal();
        $this->edit = false;
        $this->create = true;
    }

    public function openModal()
    {
        $this->showEditModal = true;
    }

    public function closeModal()
    {
        $this->showEditModal = false;
    }

    public function resetInputFields()
    {
        $this->reset('arr');
    }

    public function confirmation(){
        $this->confirmingSaveEmail=true;
    }

    public function store()
    {
        // $this->validateInputs();
        $this->validate([
            'arr.title' => ['required', 'regex:/^[A-Z,Ñ,a-z,1-9][A-Z,a-z, ,,1-9,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú.!]+$/', 'max:40'],
            'arr.description' => ['required', 'regex:/^[A-Z,Ñ,a-z,1-9][A-Z,a-z, ,,1-9,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú,!]+$/', 'max:100'],
        ]);

        $users=User::all();
        $iduser=Auth::id();
        $correo=Email::create($this->arr);

        foreach ($users as $u){
            if($u->id != $iduser){
                Mail::to($u->email)
                ->send(new OrderShipped($correo, $u));
            }
        }

        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' =>  $this->edit ? 'Mensaje Enviado exitosamente' : 'Mensaje Enviado exitosamente',
        ]);

        $this->edit = false;
        $this->create = false;
        $this->closeModal();
        $this->resetInputFields();
    }

    public function render()
    {
        return view('livewire.admin.emailss.index', [
            'emailss' => Email::query()
                            ->select('title','description','created_at',)
                            ->when($this->search, function ($query, $b) {
                                return $query->where(function ($q) {
                                    $q->Where('title', 'like', '%'.$this->search.'%')
                                      ->orWhere('description', 'like', '%'.$this->search.'%');
                                });
                            })
                            ->orderBy('emails.created_at', 'DESC')
                            ->paginate($this->perPage),
        ]);
    }

}
