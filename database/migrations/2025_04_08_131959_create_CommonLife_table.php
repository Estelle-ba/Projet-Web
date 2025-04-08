<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('CommonLife', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id('task_id')->autoIncrement()->primary();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('living_task');
    }
};
