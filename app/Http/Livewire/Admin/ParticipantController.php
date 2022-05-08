<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ParticipantController extends Component
{
    use WithPagination;

    public User $user;
    public int $perPage = 5;
    public string $search = '';
    public string $sortField = 'id';
    public string $sortDirection = 'asc';
    public array $filters = [
        'area' => '',
        'tipo' => '',
        'sexo' => '',
        'cuenta_moodle' => '',
    ];

    public bool $showEditModal = false;
    public bool $showViewModal = false;
    public bool $showConfirmationModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'id'],
        'sortDirection',
    ];

    /* Elige la variable o el método para aplicar las reglas */
    public function rules()
    {
        return [
            'user.rfc' => ['required', 'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/'],
            'user.name' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.apellido_paterno' => ['nullable', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.apellido_materno' => ['nullable', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.sexo' => ['required',  'in:M,F'],
            'user.curp' => ['required', 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'],
            'user.estudio_maximo' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.tipo' => ['required', 'in:Base,Interinato,Honorarios'],
            // TO-DO: Crear regex de clave_presupuestal según ejemplos reales
            'user.clave_presupuestal' => ['required', 'max:255'],
            'user.carrera' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
            'user.correo_tecnm' => ['email', 'ends_with:@oaxaca.tecnm.mx', Rule::unique('users', 'correo_tecnm')->ignore($this->user)],
            'user.puesto' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.hora_entrada' => 'required',
            'user.hora_salida' => 'required',
            'user.cuenta_moodle' => ['required',  'in:0,1'],
            'user.organizacion_origen' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.area_id' => ['required',  'exists:areas,id'],
        ];
    }

    public function mount()
    {
        $this->blankUser();
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

    public function sortBy(string $field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function blankUser()
    {
        $this->user = User::make();
    }

    public function edit(User $user)
    {
        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->user = $user;

        $this->showEditModal = true;
    }

    public function view(User $user)
    {
        $this->user = $user;

        $this->showViewModal = true;
    }

    public function confirmSave()
    {
        $this->validate();
        $this->showConfirmationModal = true;
    }

    public function save()
    {
        $this->user->save();

        $this->showConfirmationModal = false;
        $this->showEditModal = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'pencil',
            'message' => 'Participante actualizado exitosamente',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.participants.index', [
            'users' => User::query()
                ->leftJoin('areas', 'areas.id', '=', 'users.area_id')
                ->select('users.id', 'users.rfc', 'users.name', 'users.apellido_paterno', 'users.apellido_materno', 'users.cuenta_moodle', 'users.area_id', 'areas.nombre as area_nombre')
                ->when($this->filters['area'], fn ($query, $area) => $query->where('area_id', $area))
                ->when($this->filters['tipo'], fn ($query, $tipo) => $query->where('tipo', $tipo))
                ->when($this->filters['sexo'], fn ($query, $sexo) => $query->where('sexo', $sexo))
                ->when($this->filters['cuenta_moodle'], function ($query, $cuenta_moodle) {
                    $valor = $cuenta_moodle === 'Si' ? 1 : 0;
                    $query->where('cuenta_moodle', $valor);
                })
                ->when($this->search, function ($query, $search) {
                    $query->where('rfc', 'like', "%$search%")
                        ->orWhere(DB::raw("REPLACE(CONCAT_WS(' ', name, apellido_paterno, apellido_materno), '  ', ' ')"), 'like', "%$search%");
                })
                ->when($this->sortField === 'nombre_completo', function ($query) {
                    $query->orderByRaw("REPLACE(CONCAT_WS(' ', name, apellido_paterno, apellido_materno), '  ', ' ') $this->sortDirection");
                }, function ($query) {
                    $query->orderBy($this->sortField, $this->sortDirection);
                })
                ->paginate($this->perPage),
        ]);
    }
}
