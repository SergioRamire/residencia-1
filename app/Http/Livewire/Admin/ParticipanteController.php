<?php

// namespace App\Http\Livewire;

namespace App\Http\Livewire\Admin;

use App\Models\Area;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipanteController extends Component
{
    use WithPagination;

    //variables de busqueda y paginacion
    public $perPage = 8;
    public $search = '';
    public $areas;

    //atributos de la tabla de Participantes
    public $participantes_id;
    public $rfc;
    public $participante;
    public $name;
    public $apellido_paterno;
    public $apellido_materno;
    public $sexo;
    public $curp;
    public $estudio_maximo;
    public $tipo;
    public $clave_presupuestal;
    public $email;
    public $correo_tecnm;
    public $carrera;
    public $puesto;
    public $hora_entrada;
    public $hora_salida;
    public $area_id;
    public $user;
    public $organizacion_origen;
    public $cuenta_moodle;

    //variables de modales
    public $edit = false;
    public $create = false;
    public $showEditModal = 0;
    public $confirmingSaveParti = false;

    //variables de filtros
    public $filter = false;

    public $filters = [
        'filtro_area' => '',
        'filtro_tipo' => '',
        'filtro_sexo' => '',
        'filtro_cuentamoodle' => '',
    ];

    // variables de la vista inspeccionar
    public $ins = false;
    public $sexo_f = 'Femenino';
    public $sexo_m = 'Masculino';
    public $tieneCM = 'Tiene cuenta Moodle';
    public $notieneCM = 'No tiene cuenta Moodle';

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage',
    ];

    public function render()
    {
        $this->obtenerAreas();

        return view('livewire.admin.participante.index', [
            'view' => User::join('areas', 'areas.id', '=', 'users.area_id')
                ->select('users.id', 'users.rfc', 'users.name as name', 'users.apellido_paterno', 'users.apellido_materno', 'users.clave_presupuestal', 'users.cuenta_moodle', 'areas.nombre as area')
                ->when($this->search, function ($query, $b) {
                    return $query->where(function ($q2) {
                        $q2->where('rfc', 'like', '%'.$this->search.'%')
                            ->orWhere('areas.nombre', 'like', '%'.$this->search.'%')
                            ->orWhere(DB::raw("concat(users.name,' ',users.apellido_paterno,' ', users.apellido_materno)"), 'like', '%'.$this->search.'%');
                    });
                })
                ->when($this->filters['filtro_area'], function ($query, $b) {
                    return $query->where(function ($q) {
                        $q->where('area_id', 'like', '%'.$this->filters['filtro_area'].'%');
                    });
                })
                ->when($this->filters['filtro_tipo'], function ($query, $b) {
                    return $query->where(function ($q) {
                        $q->where('tipo', 'like', '%'.$this->filters['filtro_tipo'].'%');
                    });
                })
                ->when($this->filters['filtro_sexo'], function ($query, $b) {
                    return $query->where(function ($q) {
                        $q->where('sexo', 'like', '%'.$this->filters['filtro_sexo'].'%');
                    });
                })
                ->when($this->filters['filtro_cuentamoodle'], function ($query, $b) {
                    return $query->where(function ($q) {
                        $q->where('cuenta_moodle', 'like', '%'.$this->filters['filtro_cuentamoodle'].'%');
                    });
                })
                ->paginate($this->perPage),
        ]);
    }

    private function validateInputs()
    {
        $this->validate([
            'rfc' => ['required', 'regex:/^[A-ZÑ&]{3,4}\d{6}(?:[A-Z\d]{3})?$/'],
            'name' => ['required', 'regex:/^[A-Z,Ñ,a-z][A-Z,a-z, ,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/', 'max:100'],
            'apellido_paterno' => ['regex:/^[A-Z,Ñ,a-z][A-Z,a-z, ,Ñ,ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/', 'max:100'],
            'apellido_materno' => ['regex:/^[A-Z,Ñ,a-z][A-Z,a-z, ,Ñ,ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/', 'max:100'],
            'sexo' => ['required',  'regex:/^[M,F]+$/', 'max:1'],
            'curp' => ['required', 'regex:/^([A-ZÑ&]|[a-zñ&]{1})([AEIOU]|[aeiou]{1})([A-Z&]|[a-z&]{1})([A-Z&]|[a-z&]{1})([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([HM]|[hm]{1})([AS|as|BC|bc|BS|bs|CC|cc|CS|cs|CH|ch|CL|cl|CM|cm|DF|df|DG|dg|GT|gt|GR|gr|HG|hg|JC|jc|MC|mc|MN|mn|MS|ms|NT|nt|NL|nl|OC|oc|PL|pl|QT|qt|QR|qr|SP|sp|SL|sl|SR|sr|TC|tc|TS|ts|TL|tl|VZ|vz|YN|yn|ZS|zs|NE|ne]{2})([^A|a|E|e|I|i|O|o|U|u]{1})([^A|a|E|e|I|i|O|o|U|u]{1})([^A|a|E|e|I|i|O|o|U|u]{1})([0-9]{2})$/'],
            'estudio_maximo' => ['required', 'regex:/^[A-Z,Ñ,a-z][A-Z,a-z, ,.,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/', 'max:100'],
            'tipo' => ['required', 'regex:/^[Base, Interinato, Honorarios]+$/', 'max:15'],
            'clave_presupuestal' => ['required', 'regex:/^[A-Z,Ñ,a-z,1-9][A-Z,a-z, ,.,1-9,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/', 'max:100'],
            'carrera' => ['required', 'regex:/^[A-Z,Ñ,a-z][A-Z,a-z, ,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/', 'max:100'],
            'email' => ['email', 'regex:/(.*)@itoaxaca\.edu\.mx$/i'],
            'correo_tecnm' => ['email', 'regex:/(.*)@oaxaca\.tecnm\.mx$/i'],
            'puesto' => ['required', 'regex:/^[A-Z,Ñ,a-z][A-Z,a-z, ,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/', 'max:100'],
            'hora_entrada' => 'required',
            'hora_salida' => 'required',
            'cuenta_moodle' => ['required',  'regex:/^[0,1]+$/', 'max:1'],
            'organizacion_origen' => ['required', 'regex:/^[A-Z,Ñ,a-z][A-Z,a-z, ,.,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$/', 'max:100'],
            'area_id' => ['required',  'regex:/^[1-9]+$/', 'max:1'],
        ]);
    }

    public function obtenerAreas()
    {
        $this->areas = Area::select('areas.id', 'areas.nombre')->get();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilters()
    {
        $this->resetPage();
    }

    // Resetea la busqueda
    public function resetFilters()
    {
        $this->reset('search');
    }

    // Resetea los filtros
    public function resetFilters2()
    {
        $this->reset('filters');
    }

    public function openModal()
    {
        $this->showEditModal = true;
    }

    public function closeModal()
    {
        $this->showEditModal = false;
    }

    private function resetInputFields()
    {
        $this->rfc = '';
        $this->name = '';
        $this->apellido_paterno = '';
        $this->apellido_materno = '';
        $this->sexo = '';
        $this->curp = '';
        $this->estudio_maximo = '';
        $this->tipo = '';
        $this->clave_presupuestal = '';
        $this->email = '';
        $this->correo_tecnm = '';
        $this->carrera = '';
        $this->puesto = '';
        $this->hora_entrada = '';
        $this->hora_salida = '';
        $this->organizacion_origen = '';
        $this->cuenta_moodle = '';
        $this->area_id = '';
    }

    public function store()
    {
        $this->validateInputs();
        User::updateOrCreate(['id' => $this->participantes_id], [
            'rfc' => $this->rfc,
            'name' => $this->name,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'sexo' => $this->sexo,
            'curp' => $this->curp,
            'estudio_maximo' => $this->estudio_maximo,
            'tipo' => $this->tipo,
            'clave_presupuestal' => $this->clave_presupuestal,
            'email' => $this->email,
            'password'=>bcrypt('12345678'),
            'correo_tecnm' => $this->correo_tecnm,
            'carrera' => $this->carrera,
            'puesto' => $this->puesto,
            'hora_entrada' => $this->hora_entrada,
            'hora_salida' => $this->hora_salida,
            'organizacion_origen'=> $this->organizacion_origen,
            'cuenta_moodle'=> $this->cuenta_moodle,
            'area_id' => $this->area_id,
        ]);
        $this->confirmingSaveParti = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' =>  $this->edit ? 'Participante actualizado exitosamente' : 'Participante actualizado exitosamente',
        ]);
        $this->edit = false;
        $this->create = false;
        $this->closeModal();
        $this->resetInputFields();
    }

    public function updateParti()
    {
        $this->validateInputs();
        $this->confirmingSaveParti = true;
    }

    public function inspeccionar($id)
    {
        $this->ins = true;

        $participante = User::findOrFail($id);
        $this->participantes_id = $id;
        $this->rfc = $participante->rfc;
        $this->name = $participante->name;
        $this->apellido_paterno = $participante->apellido_paterno;
        $this->apellido_materno = $participante->apellido_materno;
        $this->sexo = $participante->sexo;
        $this->curp = $participante->curp;
        $this->estudio_maximo = $participante->estudio_maximo;
        $this->tipo = $participante->tipo;
        $this->clave_presupuestal = $participante->clave_presupuestal;
        $this->email = $participante->email;
        $this->correo_tecnm = $participante->correo_tecnm;
        $this->carrera = $participante->carrera;
        $this->puesto = $participante->puesto;
        $this->hora_entrada = $participante->hora_entrada;
        $this->hora_salida = $participante->hora_salida;
        $this->cuenta_moodle = $participante->cuenta_moodle;
        $this->organizacion_origen = $participante->organizacion_origen;
        $this->area_id = $participante->area_id;
        $this->sexo_f;
        $this->sexo_m;
        $this->tieneCM;
        $this->notieneCM;
        // manda habrir el modal para poder editar los campos
        $this->edit = false;
        $this->create = false;
        $this->openModal();
    }

    public function edit($id)
    {
        $participante = User::findOrFail($id);
        $this->participantes_id = $id;
        $this->rfc = $participante->rfc;
        $this->name = $participante->name;
        $this->apellido_paterno = $participante->apellido_paterno;
        $this->apellido_materno = $participante->apellido_materno;
        $this->sexo = $participante->sexo;
        $this->curp = $participante->curp;
        $this->estudio_maximo = $participante->estudio_maximo;
        $this->tipo = $participante->tipo;
        $this->clave_presupuestal = $participante->clave_presupuestal;
        $this->email = $participante->email;
        $this->correo_tecnm = $participante->correo_tecnm;
        $this->carrera = $participante->carrera;
        $this->puesto = $participante->puesto;
        $this->hora_entrada = $participante->hora_entrada;
        $this->hora_salida = $participante->hora_salida;
        $this->area_id = $participante->area_id;
        $this->organizacion_origen = $participante->organizacion_origen;
        $this->cuenta_moodle = $participante->cuenta_moodle;
        // manda habrir el modal para poder editar los campos
        $this->edit = true;
        $this->create = false;
        $this->openModal();
        // valida los campos para limpiar el modal y elimine si hay errores anteriores
        $this->validateInputs();
    }
}
