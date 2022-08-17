<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'estatus',
    ];

    public function courseDetails()
    {
        return $this->hasMany(CourseDetail::class);
    }
}
