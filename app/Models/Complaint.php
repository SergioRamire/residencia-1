<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
    protected $hidden = ['id'];

    // public function users(){
    //     return $this->hasMany(User::class);
    // }

    // public function complaints()
    // {
    //     return $this->hasMany(Complaint::class);
    // }
    public function users()
    {
        return $this->belongsToMany(User::class, 'citizen_reports')
            ->withPivot('date', 'observations','latitude','longitude','employee_name','government_department','status')
            ->as('citizen_report')
            ->withTimestamps();
    }
}

