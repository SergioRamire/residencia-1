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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('role')->nullable();
            $table->timestamps();
            // $table->integer('roles_id')->unsigned();
            // $table->foreign('roles_id')->references('id')->on('roles');

            $table->foreignId('user_id') ->nullable()
            ->constrained()
            ->onDelete('set null');
            // $table->foreignId('role_id') ->nullable()
            // ->constrained()
            // ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
