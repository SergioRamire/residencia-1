<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'capacidad',
    ];

    public function courseDetails()
    {
        return $this->belongsToMany(CourseDetail::class, 'group_assignments')
            ->withPivot('hora_inicio', 'hora_fin')
            ->as('group_assignment')
            ->withTimestamps();
    }
}
