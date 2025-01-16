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
        Schema::create('cpus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->integer('core');
            $table->integer('threads');
            $table->integer('min_clock');
            $table->integer('max_clock');
            $table->string('socket');
            $table->integer('TDP');
            $table->decimal('price', 10, 2);
            $table->string('img');
            $table->string('complectation_name')->nullable();
            $table->foreignId('model_id')->constrained('Computer_models')->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cpus');
    }
};
