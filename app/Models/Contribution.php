<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cost',
    ];

    public function contributions()
    {
        return $this->hasMany(Contributions::class);
    }

    public function users()
    {
        return $this->belongsToMany(CourseDetail::class, 'payments')
            ->withPivot('date', 'paid')
            ->as('payment')
            ->withTimestamps();
    }
}
