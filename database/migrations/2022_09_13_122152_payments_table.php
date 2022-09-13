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
        Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->date('date');
        $table->boolean('paid');
        $table->foreignId('contribution_id')
                ->nullable()
                ->constrained()
                ->onDelete('set null');
        $table->foreignId('user_id')
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
        Schema::dropIfExists('payments');
    }
};
