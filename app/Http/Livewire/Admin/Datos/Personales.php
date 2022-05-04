<?php

namespace App\Http\Livewire\Admin\Datos;

use App\Models\Area;
use App\Models\User;
use Livewire\Component;

class Personales extends Component
{
    public User $user;
    public Area $area;

    public function rules()
    {
        return [
            'user.rfc' => ['required', 'string', 'max:255'],
            'user.curp' => ['required', 'string', 'max:255'],
            'user.name' => ['required', 'string', 'max:255'],
            'user.apellido_materno' => ['required', 'string', 'max:255'],
            'user.apellido_paterno' => ['required', 'string', 'max:255'],
            'user.email' => ['required', 'string', 'max:255'],
            'user.sexo' => ['required', 'string', 'max:255'],
            'user.email' => ['required', 'string', 'max:255'],
            'user.correo_tecnm' => ['required', 'string', 'max:255'],
            'user.estudio_maximo' => ['required', 'string', 'max:255'],
            'user.carrera' => ['required', 'string', 'max:255'],
            'user.sexo' => ['required', 'string', 'max:255'],

            'user.area_id' => ['required', 'string', 'max:255'],
            'user.clave_presupuestal' => ['required', 'string', 'max:255'],
            'user.puesto' => ['required', 'string', 'max:255'],
            'area.telefono' => ['required', 'string', 'max:255'],
            'area.jefe' => ['required', 'string', 'max:255'],
            'user.hora_entrada' => ['required', 'string', 'max:255'],
            'user.hora_salida' => ['required', 'string', 'max:255'],
            'user.tipo' => ['required', 'string', 'max:255'],
            'user.organizacion_origen' => ['required', 'string', 'max:255'],
            'user.cuenta_moodle' => ['required', 'string', 'max:255'],
        ];
        
        /* return [
            'user.rfc' => ['required', 'string', 'max:255'],
            'user.curp' => ['required', 'string', 'max:255'],
            'user.name' => ['required', 'string', 'max:255'],
            'user.apellido_materno' => ['required', 'string', 'max:255'],
            'user.apellido_paterno' => ['required', 'string', 'max:255'],
            'user.email' => ['required', 'string', 'max:255'],
            'user.sexo' => ['required', 'string', 'max:255'],
            'user.email' => ['required', 'string', 'max:255'],
            'user.correo_tecnm' => ['required', 'string', 'max:255'],
            'user.estudio_maximo' => ['required', 'string', 'max:255'],
            'user.carrera' => ['required', 'string', 'max:255'],
            'user.sexo' => ['required', 'string', 'max:255'],

            'user.area_id' => ['required', 'string', 'max:255'],
            'user.clave_presupuestal' => ['required', 'string', 'max:255'],
            'user.puesto' => ['required', 'string', 'max:255'],
            'area.telefono' => ['required', 'string', 'max:255'],
            'area.jefe' => ['required', 'string', 'max:255'],
            'user.hora_entrada' => ['required', 'string', 'max:255'],
            'user.hora_salida' => ['required', 'string', 'max:255'],
            'user.tipo' => ['required', 'string', 'max:255'],
            'user.organizacion_origen' => ['required', 'string', 'max:255'],
            'user.cuenta_moodle' => ['required', 'string', 'max:255'],
        ]; */
    }

    public function render()
    {
        $this->user = auth()->user();
        $this->area = Area::find(auth()->user()->area_id);
        return view('livewire.admin.datos.personales');
    }


    public function confirmSave()
    {
        $this->validate();
    }

    public function save()
    {
        $this->user->save();
        $this->area->save();

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'success',
            'message' => 'Datos actualizado exitosamente' ,
        ]);
        
        
    }

}
