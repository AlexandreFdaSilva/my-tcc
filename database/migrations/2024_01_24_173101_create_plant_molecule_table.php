<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('plant_molecule', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('molecule_id')->unsigned()->nullable();
            $table->foreign('molecule_id')->references('id')->on('molecules');
            $table->bigInteger('plant_id')->unsigned();
            $table->foreign('plant_id')->references('id')->on('plants');
            $table->bigInteger('reference_id')->unsigned();
            $table->foreign('reference_id')->references('id')->on('references');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('plant_molecule');
    }
};
