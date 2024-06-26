<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('application_plant', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('plant_id');
			$table->foreign('plant_id')->references('id')->on('plants');
			$table->unsignedBigInteger('application_id');
			$table->foreign('application_id')->references('id')->on('applications');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('application_plant');
	}
};
