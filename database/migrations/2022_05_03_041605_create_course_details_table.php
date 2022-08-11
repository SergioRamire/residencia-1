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
        Schema::create('course_details', function (Blueprint $table) {
            $table->id();
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('lugar');
            $table->tinyInteger('capacidad');
            $table->string('modalidad', 20);
            $table->integer('numero_curso')->nullable();
            $table->timestamps();
            $table->foreignId('course_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('group_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
            $table->foreignId('period_id')
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
        Schema::dropIfExists('course_details');
    }
};
