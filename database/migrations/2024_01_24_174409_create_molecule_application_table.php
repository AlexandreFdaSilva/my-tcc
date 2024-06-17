<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('molecule_application', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('molecule_id');
			$table->foreign('molecule_id')->references('id')->on('molecules');
			$table->unsignedBigInteger('application_id')->nullable();
			$table->foreign('application_id')->references('id')->on('applications');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('molecule_application');
	}
};
