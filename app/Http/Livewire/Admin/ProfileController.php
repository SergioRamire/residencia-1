<?php

namespace App\Http\Livewire\Admin;

use App\Models\Area;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ProfileController extends Component
{
    public User $user;
    public Area $area;
    public $showConfirmationModal = false;
    public $showEditModal = false;

    public function mount(){
        $this->user = auth()->user();
        if (auth()->user()->area_id != null) {
            $this->area = Area::find(auth()->user()->area_id);
        }
    }

    public function rules(){
        return [
            'user.rfc' =>  ['required', 'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/'],
            'user.curp' => ['required', 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'],
            'user.name' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.apellido_materno' => $this->valiAp($this->no_ap1),
            'user.apellido_paterno' => $this->valiAp($this->no_ap2),
            'user.sexo' => ['required', 'regex:/^[F|M]$/u', 'max:1'],
            'user.email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
            'user.correo_tecnm' => ['required', 'email', 'ends_with:@oaxaca.tecnm.mx', Rule::unique('users', 'correo_tecnm')->ignore($this->user)],
            'user.estudio_maximo' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.carrera' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],

            'user.area_id' => '',
            'user.clave_presupuestal'  => 'required',
            'user.puesto_en_area'  => 'required',
            'area.telefono' => '',
            'user.jefe_inmediato'  => 'required',
            'user.hora_entrada' => 'required',
            'user.hora_salida' => 'required',
            'user.tipo'  => 'required',
            'user.organizacion_origen'  => 'required',
            'user.cuenta_moodle'  => 'required',
        ];
    }

    public function render(){
        return view('livewire.admin.users.profile');
    }

    public function editInfo(){
        // $this->validate();
        $this->showEditModal = true;
        /* cargar valores en apellido */
        if (empty($this->user->apellido_paterno)) {
            $this->no_ap1 = true;
        }else {
            $this->no_ap1 = false;
        }
        if (empty($this->user->apellido_materno)) {
            $this->no_ap2 = true;
        }else {
            $this->no_ap2 = false;
        }
    }   
    
    public function confirmSave(){
        $this->validate();
        $this->showEditModal = false;
        $this->showConfirmationModal = true;
    }
    public function closeM(){
        $this->showEditModal = false;
        return redirect()->route('user.perfil');
    }
    public function closeM2(){
        $this->showConfirmationModal = false;
        return redirect()->route('user.perfil');
    }
    public function save(){
        $this->user->save();

        $this->showEditModal = false;
        $this->showConfirmationModal = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'success',
            'message' => 'Datos actualizado exitosamente. Nota: Es necesario recargar para actualizar Datos de la barra',
        ]);

        return redirect()->route('user.perfil');
    }
    public $no_ap1 = false;
    public $no_ap2 = false;
    public function valiAp($valor){

        if ($valor) {
            return ['nullable', 'regex:/^[\pL\pM\s]+$/u', 'max:255'];
        }
        return ['nullable', 'regex:/^[\pL\pM\s]+$/u', 'max:255','required'];
    }
}
