<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'lugar',
        'course_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'inscriptions')
            ->withPivot('calificacion', 'estatus', 'asistencias_minimas')
            ->as('inscription')
            ->withTimestamps();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_assignments')
            ->withPivot('hora_inicio', 'hora_fin')
            ->as('group_assignment')
            ->withTimestamps();
    }
}
