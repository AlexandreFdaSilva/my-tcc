<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('molecules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('class')->nullable();
            $table->string('stereochemistry')->nullable();
            $table->string('formula')->nullable();
            $table->string('smiles')->nullable();
            $table->string('inchi')->nullable();
            $table->string('methodology')->nullable();
            $table->string('iupac')->nullable();
            $table->string('molecular_weight')->nullable();
            $table->string('x_log_p')->nullable();
            $table->string('h_bond_donor_count')->nullable();
            $table->string('h_bond_acceptor_count')->nullable();
            $table->string('rotatable_bond_count')->nullable();
            $table->string('exact_mass')->nullable();
            $table->string('monoisotopic_mass')->nullable();
            $table->string('tpsa')->nullable();
            $table->string('heavy_atom_count')->nullable();
            $table->string('charge')->nullable();
            $table->string('complexity')->nullable();
            $table->string('isotope_atom_count')->nullable();
            $table->string('defined_atom_stereo_count')->nullable();
            $table->string('undefined_atom_stereo_count')->nullable();
            $table->string('defined_bond_stereo_count')->nullable();
            $table->string('undefined_bond_stereo_count')->nullable();
            $table->string('covalent_unit_count')->nullable();
            $table->string('status')->default('not_initialized');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('molecules');
    }
};
