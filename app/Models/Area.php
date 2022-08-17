<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'clave',
        'jefe_area',
        'telefono',
        'extension',
        'estatus',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
