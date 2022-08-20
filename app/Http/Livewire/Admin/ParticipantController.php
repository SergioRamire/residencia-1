<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithFilters;
use App\Http\Traits\WithSearching;
use App\Http\Traits\WithSorting;
use App\Http\Traits\WithTrimAndNullEmptyStrings;
use App\Models\User;
use App\Rules\Time;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipantController extends Component
{
    use AuthorizesRequests;
    use WithFilters;
    use WithPagination;
    use WithSearching;
    use WithSorting;

    public User $user;

    public int $perPage = 8;
    public array $filters = [
        'area' => '',
        'tipo' => '',
        'sexo' => '',
        'cuenta_moodle' => '',
    ];

    public bool $show_edit_modal = false;
    public bool $show_view_modal = false;
    public bool $showConfirmationModal = false;

    protected $queryString = [
        'perPage' => ['except' => 8, 'as' => 'p'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules(): array
    {
        return [
            'user.rfc' => ['required', 'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/'],
            'user.name' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.apellido_paterno' => $this->vali_ap($this->no_ap1),
            'user.apellido_materno' => $this->vali_ap($this->no_ap2),
            'user.sexo' => ['required', 'in:M,F'],
            'user.curp' => ['required', 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'],
            'user.estudio_maximo' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.tipo' => ['required', 'in:Base,Interinato,Honorarios'],
            'user.clave_presupuestal' => ['required', 'max:255'],
            'user.carrera' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
            'user.correo_tecnm' => ['email', 'ends_with:@oaxaca.tecnm.mx', Rule::unique('users', 'correo_tecnm')->ignore($this->user)],
            'user.puesto_en_area' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.hora_entrada' => ['required', new Time('07:00:00', '17:00:00')],
            'user.hora_salida' => ['required', new Time('08:00:00', '18:00:00')],
            'user.cuenta_moodle' => ['required', 'in:0,1'],
            'user.organizacion_origen' => ['required', 'max:255'],
            'user.jefe_inmediato' => ['required', 'regex:/^[\pL\pM\s.]+$/u', 'max:255'],
            'user.area_id' => ['required', 'exists:areas,id'],
        ];
    }

    public function mount()
    {
        $this->blankUser();
    }

    public function blankUser()
    {
        $this->user = User::make();
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('participant.edit');
        if (empty($user->apellido_paterno)) {
            $this->no_ap1 = 1;
        } else {
            $this->no_ap1 = 0;
        }
        if (empty($user->apellido_materno)) {
            $this->no_ap2 = 1;
        } else {
            $this->no_ap2 = 0;
        }
        $this->resetErrorBag();
        $this->resetValidation();
        $this->user = $user;
        $this->show_edit_modal = true;
    }

    public function view(User $user)
    {
        $this->user = $user;
        $this->show_view_modal = true;
    }

    public function confirm_save()
    {
        $this->validate();
        $this->showConfirmationModal = true;
    }

    public function save()
    {
        $this->user->save();

        $this->showConfirmationModal = false;
        $this->show_edit_modal = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'pencil',
            'message' => 'Participante actualizado exitosamente',
        ]);
    }

    public $idper;
    public $idcur;

    public function render()
    {
        return view('livewire.admin.participants.index', [
            'users' => User::query()
                ->leftJoin('areas', 'areas.id', '=', 'users.area_id')
                ->select('users.id', 'users.rfc', 'users.name', 'users.apellido_paterno', 'users.apellido_materno', 'users.cuenta_moodle', 'users.area_id', 'areas.nombre as area_nombre')
                ->when($this->search, function ($query) {
                    return $query->where(function ($q) {
                        $q->Where(DB::raw("concat(users.name,' ',users.apellido_paterno,
                          ' ', users.apellido_materno)"), 'like', '%'.$this->search.'%')
                            ->orWhere('users.rfc', 'like', '%'.$this->search.'%')
                            ->orWhere('areas.nombre', 'like', '%'.$this->search.'%');
                    });
                })
                ->when($this->filters['area'], fn ($query, $area) => $query->where('area_id', $area))
                ->when($this->filters['tipo'], fn ($query, $tipo) => $query->where('tipo', $tipo))
                ->when($this->filters['sexo'], fn ($query, $sexo) => $query->where('sexo', $sexo))
                ->when($this->filters['cuenta_moodle'], function ($query, $cuenta_moodle) {
                    $valor = $cuenta_moodle === 'Si' ? 1 : 0;
                    $query->where('cuenta_moodle', $valor);
                })
                ->when($this->sortField === 'nombre_completo', function ($query) {
                    $query->orderByRaw("REPLACE(CONCAT_WS(' ', name, apellido_paterno, apellido_materno), '  ', ' ') $this->sortDirection");
                }, function ($query) {
                    $query->orderBy($this->sortField, $this->sortDirection);
                })
                ->paginate($this->perPage),
        ]);
    }


    public $no_ap1 = false;
    public $no_ap2 = false;

    public function vali_ap($valor)
    {
        if ((int)$valor == 1) {
            return ['nullable', 'regex:/^[\pL\pM\s]+$/u', 'max:255'];
        }
        return ['nullable', 'regex:/^[\pL\pM\s]+$/u', 'max:255', 'required'];
    }
}
