<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\MoleculeController;
use App\Http\Controllers\PlantsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/molecules/{molecule}/image', [MoleculeController::class, 'generateSVG'])->name('molecule.svg');
Route::get('/molecules/{molecule}/pubchemImage', [MoleculeController::class, 'generateImage'])->name('molecule.pubchemImage');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // About
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');

    // Molecules
    Route::middleware('checkRole:admin')->group(function () {
        Route::get('/about/edit', [AboutController::class, 'edit'])->name('about.edit');
        Route::patch('/about', [AboutController::class, 'update'])->name('about.update');

        Route::get('/molecules', [MoleculeController::class, 'index'])->name('molecules.index');
        Route::get('/plants', [PlantsController::class, 'index'])->name('plants.index');

        Route::get('/molecules/create', [MoleculeController::class, 'create'])->name('molecules.create');
        Route::post('/molecules', [MoleculeController::class, 'store'])->name('molecules.store');
        Route::get('/molecules/{molecule}/edit', [MoleculeController::class, 'edit'])->name('molecules.edit');
        Route::delete('/molecules/{molecule}', [MoleculeController::class, 'destroy'])->name('molecules.destroy');
        Route::patch('/molecules/{molecule}', [MoleculeController::class, 'update'])->name('molecules.update');
        Route::get('/molecules/{moleculeName}/pubchemSearch', [MoleculeController::class, 'pubchemSearch'])->name('molecules.pubchemSearch');
        // Molecules Downlaoad
        Route::get('/molecules/download/{molecule}/pubchemUrl', [MoleculeController::class, 'pubchemUrl'])->name('molecules.pubchemUrl');
        Route::get('/molecules/download/{molecule}/SDF', [MoleculeController::class, 'downloadSdf2D'])->name('molecules.downloadSdf2D');
        Route::get('/molecules/download/{molecule}/SDF3D', [MoleculeController::class, 'downloadSdf3D'])->name('molecules.downloadSdf3D');
        Route::get('/molecules/download/{molecule}/JSON', [MoleculeController::class, 'downloadJson2D'])->name('molecules.downloadJson2D');
        Route::get('/molecules/download/{molecule}/JSON3D', [MoleculeController::class, 'downloadJson3D'])->name('molecules.downloadJson3D');
        Route::get('/molecules/download/{molecule}/XML', [MoleculeController::class, 'downloadXml2D'])->name('molecules.downloadXml2D');
        Route::get('/molecules/download/{molecule}/XML3D', [MoleculeController::class, 'downloadXml3D'])->name('molecules.downloadXml3D');
        Route::get('/molecules/download/{molecule}/ASNT', [MoleculeController::class, 'downloadAsnt2D'])->name('molecules.downloadAsnt2D');
        Route::get('/molecules/download/{molecule}/ASNT3D', [MoleculeController::class, 'downloadAsnt3D'])->name('molecules.downloadAsnt3D');
    });

    Route::get('/molecules/{molecule}', [MoleculeController::class, 'show'])->name('molecules.show');

    // Plants
    Route::middleware('checkRole:admin')->group(function () {
        Route::get('/plants/create', [PlantsController::class, 'create'])->name('plants.create');
        Route::post('/plants', [PlantsController::class, 'store'])->name('plants.store');
        Route::get('/plants/{plant}/edit', [PlantsController::class, 'edit'])->name('plants.edit');
        Route::delete('/plants/{plant}', [PlantsController::class, 'destroy'])->name('plants.destroy');
        Route::patch('/plants/{plant}', [PlantsController::class, 'update'])->name('plants.update');
    });

    Route::get('/plants/{plant}', [PlantsController::class, 'show'])->name('plants.show');

    // Search
    Route::get('/', [SearchController::class, 'index'])->name('search.index');
    Route::get('/search', [SearchController::class, 'searchMoleculesPlants'])->name('search.result');
    Route::get('/legacy', [SearchController::class, 'legacy'])->name('search.legacy');
});



// Route::resource('molecules', MoleculeController::class);

require __DIR__ . '/auth.php';
