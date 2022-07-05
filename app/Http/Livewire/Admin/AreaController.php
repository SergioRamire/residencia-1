<?php

namespace App\Http\Livewire\Admin;

use App\Models\Area;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Traits\WithSorting;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AreaController extends Component
{
    use WithPagination;
    use WithSorting;
    use AuthorizesRequests;

    public Area $areas;
    public $edit = false;
    public $create = false;

    public $showEditCreateModal = false;
    public $confirmingAreaDeletion = false;
    public $confirmingSaveArea = false;

    public $perPage = '5';
    public $search = '';
    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        'perPage' => ['except' => 1, 'as' => 'p'],
    ];

    public function rules(): array{
        if ($this->edit) {
            return [
                'areas.nombre' => ['required', 'regex:/^[\pL\pM\s]+$/u'],
                'areas.jefe_area' => ['required', 'regex:/^[\pL\pM\s]+$/u'],
                'areas.extension' => ['required', 'numeric'],
                'areas.clave' => ['required', 'alpha_num'],
                'areas.telefono' => ['required', 'numeric'],
        ];}
        return [
            'areas.nombre' => ['required', 'regex:/^[\pL\pM\s]+$/u', 'unique:areas'],
            'areas.jefe_area' => ['required', 'regex:/^[\pL\pM\s]+$/u'],
            'areas.extension' => ['required', 'numeric'],
            'areas.clave' => ['required', 'alpha_num', 'unique:areas'],
            'areas.telefono' => ['required', 'numeric'],
        ];
    }

    public function mount(){
        $this->blankArea();
    }

    public function blankArea(){
        $this->areas = Area::make();
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function updatingSearch(){
        $this->resetPage();
    }

    public function resetFilters(){
        $this->reset('search');
    }

    public function create(){
        $this->resetErrorBag();
        $this->blankArea();
        $this->openModal();
        $this->edit = false;
        $this->create = true;
    }

    public function openModal(){
        $this->showEditCreateModal = true;
    }

    public function closeModal(){
        $this->showEditCreateModal = false;
    }


    public function save()
    {
        $this->validate();
        $this->areas->save();
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

        $this->areas = Area::findOrFail($id);
        $this->edit = true;
        $this->create = false;
        $this->openModal();
    }

    public function deleteArea($id)
    {
        $this->areas = Area::findOrFail($id);
        $this->confirmingAreaDeletion = true;
    }

    public function delete()
    {
        $this->areas->delete();
        $this->confirmingAreaDeletion = false;
        $this->dispatchBrowserEvent('notify', [
            'icon' => 'trash',
            'message' =>  'Área eliminada exitosamente',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.areas.index', [
            'datosareas' => Area::where('nombre', 'like', '%'.$this->search.'%')
                            ->orWhere('jefe_area', 'like', '%'.$this->search.'%')
                            ->orWhere('clave', 'like', '%'.$this->search.'%')
                            ->orWhere('telefono', 'like', '%'.$this->search.'%')
                            ->orWhere('extension', 'like', '%'.$this->search.'%')
                            ->orderBy($this->sortField, $this->sortDirection)
                            ->paginate($this->perPage),
        ]);
    }
}
