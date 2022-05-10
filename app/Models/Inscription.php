<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'calificacion',
        'estatus',
        'asistencias_minimas',
        'coursesdetail_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courseDetail()
    {
        return $this->belongsTo(CourseDetail::class);
    }
}
