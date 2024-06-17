<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Molecule extends Model {
    use HasFactory, Searchable;

    protected $fillable = [
        'name',
        'class',
        'stereochemistry',
        'formula',
        'smiles',
        'inchi',
        'methodology',
        'iupac',
        'molecular_weight',
        'x_log_p',
        'h_bond_donor_count',
        'h_bond_acceptor_count',
        'rotatable_bond_count',
        'exact_mass',
        'monoisotopic_mass',
        'tpsa',
        'heavy_atom_count',
        'charge',
        'complexity',
        'isotope_atom_count',
        'defined_atom_stereo_count',
        'undefined_atom_stereo_count',
        'defined_bond_stereo_count',
        'undefined_bond_stereo_count',
        'covalent_unit_count',
        'status',
        'notes'
    ];

    public function plants() {
        return $this->belongsToMany(Plant::class, 'plant_molecule');
    }

    public function toSearchableArray(): array {
        $array = [
            'name' => $this->name,
            'class' => $this->class,
            'stereochemistry' => $this->stereochemistry,
            'formula' => $this->formula,
            'smiles' => $this->smiles,
            'inchi' => $this->inchi,
            'methodology' => $this->methodology,
            'iupac' => $this->iupac,
        ];

        $array['plants'] = $this->plants->pluck('name')->toArray();

        return $array;
    }
}
