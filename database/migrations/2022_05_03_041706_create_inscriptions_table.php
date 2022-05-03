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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->double('calificacion');
            $table->string('estatus');
            $table->boolean('asistencias_minimas');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('coursesdetail_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscriptions');
    }
};
