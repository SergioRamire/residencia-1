<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'clave',
        'duracion',
        'observaciones',
        'objetivo',
        'dirigido',
        'perfil',
        'estatus',
    ];

    public function courseDetails()
    {
        return $this->hasMany(CourseDetail::class);
    }
}
