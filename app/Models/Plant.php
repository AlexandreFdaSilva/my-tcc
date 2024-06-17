<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Plant extends Model {
    use HasFactory, Searchable;

    protected $fillable = [
        'species',
        'synonyms',
        'material',
        'geolocation',
        'image_path',
    ];

    public function molecules() {
        return $this->belongsToMany(Molecule::class, 'plant_molecule');
    }

    public function references() {
        return $this->belongsToMany(Reference::class, 'plant_molecule');
    }

    public function toSearchableArray(): array {
        $array = [
            'species' => $this->species,
            'synonyms' => $this->synonyms,
            'material' => $this->material,
            'geolocation' => $this->geolocation,
        ];

        $array['molecules'] = $this->molecules->pluck('name')->toArray();
        $array['authors'] = $this->references->pluck('author')->flatten()->toArray();

        return $array;
    }
}
