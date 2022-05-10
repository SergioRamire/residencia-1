<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'hora_inicio',
        'hora_fin',
        'coursesdetail_id',
        'group_id',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function courseDetail()
    {
        return $this->belongsTo(CourseDetail::class);
    }
}
