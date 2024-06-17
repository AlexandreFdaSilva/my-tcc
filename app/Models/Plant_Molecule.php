<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant_Molecule extends Model {
    use HasFactory;

    protected $table = 'plant_molecule';

    protected $fillable = [
        'molecule_id',
        'plant_id',
        'reference_id',
    ];
}
