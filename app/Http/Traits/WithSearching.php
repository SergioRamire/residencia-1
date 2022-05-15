<?php

namespace App\Http\Traits;

trait WithSearching
{
    public string $search = '';

    protected $queryStringWithSearching = [
        'search' => ['except' => '', 'as' => 's'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
