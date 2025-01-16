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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cpu_id')->constrained('Cpus')->cascadeOnDelete();
            $table->foreignId('motherboard_id')->constrained('motherboards')->cascadeOnDelete();
            $table->foreignId('ram_id')->constrained('Rams')->cascadeOnDelete();
            $table->integer('count_ram');
            $table->foreignId('gpu_id')->constrained('Gpus')->cascadeOnDelete();
            $table->foreignId('psu_id')->constrained('Psus')->cascadeOnDelete();
            $table->foreignId('cooling_id')->constrained('Coolings')->cascadeOnDelete();
            $table->foreignId('corp_id')->constrained('Corps')->cascadeOnDelete();
            $table->foreignId('disk_id')->constrained('Disks')->cascadeOnDelete();
            $table->foreignId('ssd_id')->constrained('Disks')->cascadeOnDelete();
            $table->decimal('price', 10, 2);
            $table->string('model_name');
            $table->string('package_name');
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
        Schema::dropIfExists('positions');
    }
};
