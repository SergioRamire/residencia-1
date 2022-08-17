<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('rfc')->nullable();
            $table->string('curp')->nullable();
            $table->string('sexo')->nullable();
            $table->string('carrera')->nullable();
            $table->string('tipo')->nullable();
            $table->boolean('cuenta_moodle')->nullable();
            $table->string('organizacion_origen')->nullable();
            $table->string('clave_presupuestal')->nullable();
            $table->string('estudio_maximo')->nullable();
            $table->string('correo_tecnm')->nullable();
            $table->string('puesto_en_area')->nullable();
            $table->string('jefe_inmediato')->nullable();
            $table->time('hora_entrada')->nullable();
            $table->time('hora_salida')->nullable();
            $table->boolean('estatus')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
            $table->foreignId('area_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
