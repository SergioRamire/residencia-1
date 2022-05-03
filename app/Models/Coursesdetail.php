<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coursesdetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'lugar',
        'course_id',
    ];

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function groupassignments()
    {
        return $this->hasMany(Groupassignment::class);
    }
}
