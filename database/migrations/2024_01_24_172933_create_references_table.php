<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('references', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();;
            $table->string('author')->nullable();;
            $table->boolean('univali')->nullable();;
            $table->string('doi')->nullable();;
            $table->string('pmid')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('references');
    }
};
