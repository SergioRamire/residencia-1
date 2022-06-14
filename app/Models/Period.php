<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;

    protected $fillable = [
        'clave',
        'fecha_inicio',
        'fecha_fin',
    ];

    /* public function courseDetails()
    {
        return $this->belongsToMany(CourseDetail::class, 'period_details')
            ->as('period_detail')
            ->withTimestamps();
    }
 */
    public function courseDetails()
    {
        return $this->hasMany(CourseDetail::class);
    }
}
