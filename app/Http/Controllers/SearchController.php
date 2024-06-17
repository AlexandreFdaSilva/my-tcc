<?php

namespace App\Http\Controllers;

use App\Models\Molecule;
use App\Models\Plant;
use App\Models\User;
use App\Search\GeneralSearch;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller {
    function searchMoleculesPlants(Request $request) {
        $query = request(key: 'q');
        $results = GeneralSearch::search($query)->get();

        // We need to create an paginator by hand for each Model

        // Separating molecules and plants
        $molecules = $results->filter(function ($result) {
            return $result instanceof Molecule;
        });

        $plants = $results->filter(function ($result) {
            return $result instanceof Plant;
        });

        $perPage = 20;

        $base_url = LengthAwarePaginator::resolveCurrentPath();
        $get_query_strings = LengthAwarePaginator::resolveQueryString();

        // Get current page for each Model
        $plantCurrentPage = LengthAwarePaginator::resolveCurrentPage('plants_page');
        $moleculeCurrentPage = LengthAwarePaginator::resolveCurrentPage('molecules_page');

        // Get the elements for the current page
        $currentPlants = $plants->slice($perPage * ($plantCurrentPage - 1), $perPage);
        $currentMolecules = $molecules->slice($perPage * ($moleculeCurrentPage - 1), $perPage);

        // Create the pagination
        $plants = new LengthAwarePaginator(
            items: $currentPlants,
            total: count($plants),
            perPage: $perPage,
            currentPage: $plantCurrentPage,
            options: [
                'path' => $base_url,
                'query' => $get_query_strings,
            ],
        );
        $molecules = new LengthAwarePaginator(
            items: $currentMolecules,
            total: count($molecules),
            perPage: $perPage,
            currentPage: $moleculeCurrentPage,
            options: [
                'path' => $base_url,
                'query' => $get_query_strings,
            ],
        );

        // Attribute specific page name for each Model
        $plants->setPageName('plants_page');
        $molecules->setPageName('molecules_page');

        $user = User::find(Auth::user()->id);
        $userIsAdmin = $user->isAdministrator();

        return view('search.result', ['plants' => $plants, 'molecules' => $molecules, 'userIsAdmin' => $userIsAdmin]);
    }

    function index() {
        return view('search.index');
    }

    function legacy() {
        return view('search.legacy');
    }
}
