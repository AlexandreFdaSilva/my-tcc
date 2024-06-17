<?php

namespace App\Search;

use Algolia\ScoutExtended\Searchable\Aggregator;
use App\Models\Molecule;
use App\Models\Plant;
use Laravel\Scout\Searchable;

class GeneralSearch extends Aggregator {
    /**
     * The names of the models that should be aggregated.
     *
     * @var string[]
     */
    protected $models = [
        Plant::class,
        Molecule::class,
    ];

    public function shouldBeSearchable() {
        if (array_key_exists(Searchable::class, class_uses($this->model))) {
            return $this->model->shouldBeSearchable();
        }
    }
}
