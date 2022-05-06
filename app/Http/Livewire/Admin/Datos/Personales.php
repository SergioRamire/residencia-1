<?php

namespace App\Http\Livewire\Admin\Datos;

use App\Models\User;
use App\Models\Area;
use Livewire\Component;

class Personales extends Component
{
    public User $user;
    public Area $area;
    public $showConfirmationModal = false;

    public function mount()
    {
        $this->user = auth()->user();
        $this->area = Area::find(auth()->user()->area_id);
    }

    public function rules()
    {
        return [
            'user.rfc' => ['required', 'regex:/^[a-zA-zÑñ]{3,4}[0-9]{6}[a-zA-ZÑñ]{3}$/u', 'max:254'],
            'user.curp' => ['required', 'regex:/^[a-zA-ZñÑ]{1}[AEIOUaeiou]{1}[a-zA-ZñÑ]{2}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[H|M|h|m](AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)[B-DF-HJ-NP-TV-Z]{3}[0-9A-Z]{1}[0-9]{1}$/u', 'max:254'],
            'user.name' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.apellido_materno' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.apellido_paterno' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.sexo' => ['required', 'regex:/^[F|M]$/u', 'max:1'],
            'user.email' => ['required', 'email', 'max:254'],
            'user.correo_tecnm' => ['required', 'email', 'max:254'],
            'user.estudio_maximo' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],
            'user.carrera' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'max:255'],

            'user.area_id' => 'required',
            'user.clave_presupuestal'  => 'required',
            'user.puesto'  => 'required',
            'area.telefono' => 'required|numeric',
            'area.jefe'  => 'required',
            'user.hora_entrada' => 'required',
            'user.hora_salida' => 'required',
            'user.tipo'  => 'required',
            'user.organizacion_origen'  => 'required',
            'user.cuenta_moodle'  => 'required',
        ];
    }

    public function render()
    {
        return view('livewire.admin.datos.personales');
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

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'success',
            'message' => 'Datos actualizado exitosamente. Nota: Es necesario recargar para actualizar Datos de la barra',
        ]);
    }
}
