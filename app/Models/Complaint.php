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

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
    public function users()
    {
        return $this->belongsToMany(CourseDetail::class, 'citizen_reports')
            ->withPivot('date', 'observations','latitude','longitude','employee_name','government_department','status')
            ->as('citizen_report')
            ->withTimestamps();
    }
}

