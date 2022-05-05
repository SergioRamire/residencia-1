<?php

namespace App\Http\Livewire\Admin\Datos;

use App\Models\Area;
use App\Models\User;
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
            'user.rfc' => 'required|alpha_num|max:254',
            'user.curp' => 'required|alpha_num|max:254',
            'user.name' => 'required|string|max:254',
            'user.apellido_materno' => 'required|alpha|max:254',
            'user.apellido_paterno' =>'required|alpha|max:254',
            'user.sexo' => 'required|alpha',
            'user.email' => 'required|email|max:254',
            'user.correo_tecnm' => 'required|email|max:254',
            'user.estudio_maximo' => 'required|string|max:254',
            'user.carrera' => 'required|string|max:254',

            'user.area_id' =>'required',
            'user.clave_presupuestal' => 'required|alpha_num|max:254',
            'user.puesto' => 'required|string|max:254',
            'area.telefono' => 'required|numeric',
            'area.jefe' => 'required|string|max:254',
            'user.hora_entrada' => 'required',
            'user.hora_salida' => 'required',
            'user.tipo' =>'required|alpha_dash|string|max:254',
            'user.organizacion_origen' => 'required|string|max:254',
            'user.cuenta_moodle' => 'required',
        ];
        // return [
        //     'user.rfc' => 'required|regex:[A-ZÑ&]{3,4}\d{6}(?:[A-Z\d]{3})?$|max:254',
        //     'user.curp' => 'required|regex:([A-ZÑ&]|[a-zñ&]{1})([AEIOU]|[aeiou]{1})([A-Z&]|[a-z&]{1})([A-Z&]|[a-z&]{1})([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([HM]|[hm]{1})([AS|as|BC|bc|BS|bs|CC|cc|CS|cs|CH|ch|CL|cl|CM|cm|DF|df|DG|dg|GT|gt|GR|gr|HG|hg|JC|jc|MC|mc|MN|mn|MS|ms|NT|nt|NL|nl|OC|oc|PL|pl|QT|qt|QR|qr|SP|sp|SL|sl|SR|sr|TC|tc|TS|ts|TL|tl|VZ|vz|YN|yn|ZS|zs|NE|ne]{2})([A|a|E|e|I|i|O|o|U|u]{1})([A|a|E|e|I|i|O|o|U|u]{1})([A|a|E|e|I|i|O|o|U|u]{1})([0-9]{2})$|max:254',
        //     'user.name' => 'required|regex:[A-Z,Ñ,a-z][A-Z,a-z, ,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$|max:254',
        //     'user.apellido_materno' => 'required|regex:[A-Z,Ñ,a-z][A-Z,a-z, ,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$|max:254',
        //     'user.apellido_paterno' => 'required|regex:[A-Z,Ñ,a-z][A-Z,a-z, ,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$|max:254',
        //     'user.sexo' => 'required|in:M,F|max:1',
        //     'user.email' => 'required|regex:(.*)@itoaxaca\.edu\.mx$i|max:255',
        //     'user.correo_tecnm' => 'required|regex:(.*)@oaxaca\.tecnm\.mx$i|max:255',
        //     'user.estudio_maximo' => 'required|regex:[A-Z,Ñ,a-z][A-Z,a-z, ,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú,.]+$|max:254',
        //     'user.carrera' => 'required|regex:[A-Z,Ñ,a-z][A-Z,a-z, ,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$|max:254',

        //     'user.area_id' => 'required|int',
        //     'user.clave_presupuestal' => 'required|regex:[0-9A-Z,a-z,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú,.]+$|max:254',
        //     'user.puesto' => 'required|regex:[A-Z,Ñ,a-z][A-Z,a-z, ,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú,.]+$|max:254',
        //     'area.telefono' => 'required|regex:[0-9]+$|max:10',
        //     'area.jefe' => 'required|regex:[A-Z,Ñ,a-z][A-Z,a-z, ,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$|max:254',
        //     'user.hora_entrada' => 'required',
        //     'user.hora_salida' => 'required',
        //     'user.tipo' => 'required|regex:[A-Z,Ñ,a-z][A-Z,a-z, ,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú]+$|max:254',
        //     'user.organizacion_origen' => 'required|regex:[A-Z,Ñ,a-z][A-Z,a-z, ,ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú,.]+$|max:254',
        //     'user.cuenta_moodle' => 'required|in:1,2|max:1',
        // ];
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
        $this->area->save();

        $this->showConfirmationModal = false;

        $this->dispatchBrowserEvent('notify', [
            'icon' => 'success',
            'message' => 'Datos actualizado exitosamente. Nota: Es necesario recargar para actualizar Datos de la barra',
        ]);
    }
}
