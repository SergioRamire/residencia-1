<?php

namespace App\Http\Livewire\Admin;

use App\Models\Area;
use Livewire\Component;
use Livewire\WithPagination;

class AreaController extends Component
{
    use WithPagination;

    public Area $area;
    public $perPage = '5';
    public $search = '';
    public $area_id;
    public $nombre;
    public $telefono;
    public $jefe;
    public $extension;
    public $clave;
    public $edit = false;
    public $create = false;

    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];
    // variable para confimacion de eliminacion de registro
    public $showEditCreateModal = false;
    public $confirmingAreaDeletion = false;
    public $confirmingSaveArea = false;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('search');
    }

    private function validateInputs()
    {
        $this->validate([
            'nombre' => ['required', 'regex:/^[a-zA-Z .\sñáéíóúÁÉÍÓÚ]+$/'],
            'jefe' => ['required', 'regex:/^[a-zA-Z\sñáéíóúÁÉÍÓÚ]+$/'],
            'extension' => ['required', 'regex:/^[0-9]+$/'],
            'clave' => ['required', 'regex:/^[a-zA-Z0-9]+$/'],
            'telefono' => ['required', 'regex:/^[0-9]+$/'],

        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
        $this->edit = false;
        $this->create = true;
    }

    public function openModal()
    {
        $this->showEditCreateModal = true;
    }

    public function closeModal()
    {
        $this->showEditCreateModal = false;
    }

    private function resetInputFields()
    {
        $this->area_id = '';
        $this->clave = '';
        $this->nombre = '';
        $this->jefe = '';
        $this->telefono = '';
        $this->extension = '';
    }

    public function store()
    {
        $this->validateInputs();

        Area::updateOrCreate(['id' => $this->area_id], [
            'clave' => $this->clave,
            'nombre' => $this->nombre,
            'jefe' => $this->jefe,
            'telefono' => $this->telefono,
            'extension' => $this->extension,
        ]);

        $this->dispatchBrowserEvent('notify', [
            'icon' => $this->edit ? 'pencil' : 'success',
            'message' =>  $this->edit ? 'Área actualizada exitosamente' : 'Área creada exitosamente',
        ]);

        $this->edit = false;
        $this->create = false;
        $this->confirmingSaveArea = false;
        $this->closeModal();
        $this->resetInputFields();
    }

    public function updateArea()
    {
        $this->validateInputs();
        $this->confirmingSaveArea = true;
    }

    public function edit($id)
    {
        $area = Area::findOrFail($id);
        $this->area_id = $id;
        $this->clave = $area->clave;
        $this->nombre = $area->nombre;
        $this->jefe = $area->jefe;
        $this->telefono = $area->telefono;
        $this->extension = $area->extension;
        $this->edit = true;
        $this->create = false;
        $this->openModal();
    }

    public function deleteArea($id, $nombr)
    {
        $this->area = Area::findOrFail($id);
        $this->nombre = $nombr;
        $this->confirmingAreaDeletion = true;
    }

    public function delete()
    {
        $this->area->delete();
        $this->confirmingAreaDeletion = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Área eliminada exitosamente',
        ]);
        $this->resetInputFields();
    }

    public function render()
    {
        return view('livewire.admin.areas.index', [
            'areas' => Area::where('nombre', 'like', '%'.$this->search.'%')
                            ->orWhere('jefe', 'like', '%'.$this->search.'%')
                            ->orWhere('clave', 'like', '%'.$this->search.'%')->paginate($this->perPage),
        ]);
    }
}
