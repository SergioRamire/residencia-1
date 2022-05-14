<?php

namespace App\Http\Traits;

trait WithSorting
{
    public string $sortField = 'id';
    public string $sortDirection = 'asc';

    protected $queryStringWithSorting = [
        'sortField' => ['except' => 'id', 'as' => 'sf'],
        'sortDirection' => ['except' => 'asc', 'as' => 'sd'],
    ];

    public function sortBy(string $field)
    {
        if ($this->sortField !== $field) {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
            return;
        }

        if ($this->sortDirection !== 'asc') {
            $this->sortField = 'id';
            $this->sortDirection = 'asc';
            return;
        }

        $this->sortDirection = 'desc';
    }
}
