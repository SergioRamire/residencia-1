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
        Schema::create('citizen_reports', function (Blueprint $table) {
            $table->id();
        $table->date('date');
        $table->string('observations');
        $table->double('latitude');
        $table->double('longitude');
        $table->string('employee_name');
        $table->string('government_departament');
        $table->integer('status');
        $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
        $table->foreignId('complaint_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citizen_reports');
    }
};
