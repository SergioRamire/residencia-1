<?php

namespace App\Http\Traits;

trait WithFilters
{
    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }
}
