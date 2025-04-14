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
        Schema::create('promotion_common_task', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id('promotion_task_id')->autoIncrement()->primary();
            $table->foreignId('promotion')->nullable();
            $table->string('task_id')->references('task_id')->on('commonlife');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_common_task');
    }
};
