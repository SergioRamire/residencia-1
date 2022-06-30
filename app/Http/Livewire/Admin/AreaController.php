<?php

namespace App\Http\Livewire\Admin;

use App\Http\Traits\WithSorting;
use App\Models\Area;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AreaController extends Component
{
    use WithPagination;
    use WithSorting;

    public Area $area;
    public $perPage = '5';
    public $search = '';
    public $area_id;
    public $nombre;
    public $telefono;
    public $jefe_area;
    public $extension;
    public $clave;
    public $edit = false;
    public $create = false;

    // public $date;
    // public $data2 = date('Y-m-d H:i:s');

    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public $showEditCreateModal = false;
    public $confirmingAreaDeletion = false;
    public $confirmingSaveArea = false;

    public function rules(): array
    {
        if ($this->edit) {
            return [
                'nombre' => ['required', 'regex:/^[\pL\pM\s]+$/u'],
                'jefe_area' => ['required', 'regex:/^[\pL\pM\s]+$/u'],
                'extension' => ['required', 'numeric'],
                'clave' => ['required', 'alpha_num'],
                'telefono' => ['required', 'numeric'],
            ];
        }

        return [
            'nombre' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'unique:areas'],
            'jefe_area' => ['required', 'regex:/^[\pL\pM\s]+$/u'],
            'extension' => ['required', 'numeric'],
            'clave' => ['required', 'alpha_num', 'unique:areas'],
            'telefono' => ['required', 'numeric'],
        ];
    }

    public function mount()
    {
        // $this->date  = Carbon::now();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('search');
    }

    public function create()
    {
        $this->resetErrorBag();
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
        $this->jefe_area = '';
        $this->telefono = '';
        $this->extension = '';
    }

    public function store()
    {
        $this->validate();

        Area::updateOrCreate(['id' => $this->area_id], [
            'clave' => $this->clave,
            'nombre' => $this->nombre,
            'jefe_area' => $this->jefe_area,
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
        /* Reinicia los errores */
        $this->resetErrorBag();
        $this->resetValidation();

        $this->closeModal();
        $this->resetInputFields();
    }

    public function updateArea()
    {
        $this->validate();
        $this->confirmingSaveArea = true;
    }

    public function edit($id)
    {
         /* Reinicia los errores */
         $this->resetErrorBag();
         $this->resetValidation();

        $area = Area::findOrFail($id);
        $this->area_id = $id;
        $this->clave = $area->clave;
        $this->nombre = $area->nombre;
        $this->jefe_area = $area->jefe_area;
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
                            ->orWhere('jefe_area', 'like', '%'.$this->search.'%')
                            ->orWhere('clave', 'like', '%'.$this->search.'%')
                            ->orWhere('telefono', 'like', '%'.$this->search.'%')
                            ->orWhere('extension', 'like', '%'.$this->search.'%')
                            ->orderBy($this->sortField, $this->sortDirection)
                            ->paginate($this->perPage),
        ]);
    }
}
