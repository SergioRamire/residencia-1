<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;

class SubirConstanciaController extends Component
{
    use WithFileUploads;

    public $constancia;

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
        $this->constancia->store('constancias-subidas');
    }

    public function render()
    {
        return view('livewire.admin.subir-constancia');
    }
}
