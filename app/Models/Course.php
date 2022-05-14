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
        'modalidad',
        'duracion',
        'observaciones',
        'objetivo',
        'dirigido',
        'perfil',
    ];

    public function courseDetails()
    {
        return $this->hasMany(CourseDetail::class);
    }
}
