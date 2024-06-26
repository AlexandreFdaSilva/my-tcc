<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('species');
            $table->string('synonyms')->nullable();
            $table->string('material')->nullable();
            $table->string('geolocation')->nullable();
            $table->string('image_path')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('plants');
    }
};
