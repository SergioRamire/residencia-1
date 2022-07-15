<?php

namespace App\Http\Livewire\Admin;

use App\Models\Area;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProfileController extends Component
{
    use AuthorizesRequests;

    public User $user;
    public Area $area;
    public $show_confirmation_modal = false;
    public $show_edit_modal = false;

    public function mount(){
        $this->user = auth()->user();
        if (auth()->user()->area_id != null) {
            $this->area = Area::find(auth()->user()->area_id);
        }
    }

    public function rules(){
        return [
            // 'user.rfc' =>  ['required', 'regex:/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/'],
            // 'user.curp' => ['required', 'regex:/^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/'],
            'user.name' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.apellido_paterno' => $this->vali_ap($this->no_ap1),
            'user.apellido_materno' => $this->vali_ap($this->no_ap2),
            'user.email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
            'user.sexo' => ['required', 'regex:/^[F|M]$/u', 'max:1'],
            'user.correo_tecnm' => ['required', 'email', 'ends_with:@oaxaca.tecnm.mx', Rule::unique('users', 'correo_tecnm')->ignore($this->user)],
            'user.estudio_maximo' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.carrera' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],

            'user.area_id' => '',
            'user.clave_presupuestal'  => '',
            'user.puesto_en_area'  => '',
            'area.telefono' => '',
            'user.jefe_inmediato'  => '',
            'user.hora_entrada' => '',
            'user.hora_salida' => '',
            'user.tipo'  => '',
            'user.organizacion_origen'  => '',
            'user.cuenta_moodle'  => '',
        ];
    }
    public function updated($x){
        $this->validateOnly($x);
    }
    public $vali = false;
    public function render(){
        if (
            empty($this->user->sexo) ||
            empty($this->user->correo_tecnm) ||
            empty($this->user->estudio_maximo) ||
            empty($this->user->carrera)
        ){
            $this->vali = true;
        }
        return view('livewire.admin.users.profile');
    }

    public function edi_iInfo(){
        $this->authorize('user.edit');
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
        $this->show_edit_modal = true;
    }

    public function confirm_save(){
        $this->validate();
        $this->show_edit_modal = false;
        $this->show_confirmation_modal = true;
    }
    public function close_m(){
        $this->show_edit_modal = false;
        return redirect()->route('user.perfil');
    }
    public function close_m2(){
        $this->show_confirmation_modal = false;
        return redirect()->route('user.perfil');
    }
    public function save(){
        $this->user->save();
        $this->show_edit_modal = false;
        $this->show_confirmation_modal = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'success',
            'message' => 'Datos actualizado exitosamente.',
        ]);
        return redirect()->route('user.perfil');
    }

    public $no_ap1 = false;
    public $no_ap2 = false;

    public function vali_ap($valor){
        if ($valor) {
            return ['nullable', 'regex:/^[\pL\pM\s]+$/u', 'max:255'];
        }
        return ['nullable', 'regex:/^[\pL\pM\s]+$/u', 'max:255','required'];
    }
}
