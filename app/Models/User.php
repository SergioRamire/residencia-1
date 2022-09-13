<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'apellido_materno',
        'apellido_paterno',
        // 'rfc',
        'curp',
        'telefono',
        // 'tipo',
        'sexo',
        // 'carrera',
        // 'clave_presupuestal',
        // 'organizacion_origen',
        // 'estudio_maximo',
        // 'cuenta_moodle',
        // 'puesto_en_area',
        // 'jefe_inmediato',
        // 'hora_entrada',
        // 'hora_salida',
        // 'correo_tecnm',
        'estado',
        // 'area_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getNombreCompletoAttribute()
    {
        return "$this->name $this->apellido_paterno $this->apellido_materno";
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function courseDetails()
    {
        return $this->belongsToMany(CourseDetail::class, 'inscriptions')
            ->withPivot('calificacion', 'estatus_participante', 'asistencias_minimas', 'url_cedula')
            ->as('inscription')
            ->withTimestamps();
    }

    public function payments()
    {
        return $this->belongsToMany(User::class, 'payments')
            ->withPivot('date', 'paid')
            ->as('payment')
            ->withTimestamps();
    }

    public function complaints()
    {
        return $this->belongsToMany(CourseDetail::class, 'citizen_reports')
            ->withPivot('date', 'observations','latitude','longitude','employee_name','government_department','status')
            ->as('citizen_report')
            ->withTimestamps();
    }



}
