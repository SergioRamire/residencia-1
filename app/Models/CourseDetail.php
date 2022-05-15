<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'hora_inicio',
        'hora_fin',
        'lugar',
        'capacidad',
        'course_id',
        'group_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'inscriptions')
            ->withPivot('calificacion', 'estatus_participante', 'asistencias_minimas')
            ->as('inscription')
            ->withTimestamps();
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function periods()
    {
        return $this->belongsToMany(Period::class, 'period_details')
            ->as('period_detail')
            ->withTimestamps();
    }
}
