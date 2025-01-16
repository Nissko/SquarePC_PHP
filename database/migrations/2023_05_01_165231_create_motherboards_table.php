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
        Schema::create('motherboards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->string('socket');
            $table->string('chipset');
            $table->string('size');
            $table->integer('qty_ram');
            $table->string('brand');
            $table->integer('max_clock_ram');
            $table->integer('m2_slots_qty');
            $table->integer('sata_slots_qty');
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
        Schema::dropIfExists('motherboards');
    }
};
