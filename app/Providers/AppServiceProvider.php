<?php

namespace App\Providers;

use Algolia\ScoutExtended\Searchable\Aggregator;
use App\Models\Molecule;
use App\Models\Plant;
use App\Search\GeneralSearch;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot() {
        // \Algolia\AlgoliaSearch\Log\DebugLogger::enable();
        GeneralSearch::bootSearchable();
    }
}
