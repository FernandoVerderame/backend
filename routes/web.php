<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\StatisticController;
use App\Models\Sponsor;
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

/* ROTTA PANNELLO DI CONTROLLO/LOGIN */

Route::get('/', DashboardController::class)->name('welcome');



/* ROTTE DELL'ADMIN */
Route::prefix('/admin')->name('admin.')->middleware('auth')->group(function () {

    /* ROTTA MESSAGGIO INDEX */
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');

    /* ROTTA STATICHCHE SINGOLO APPARTAMENTO  */
    Route::get('/apartments/{apartment}/statistics', [ApartmentController::class, 'statistics'])->name('apartments.statistics');

    /* ROTTA SPOSTA NEL CESTINO */
    Route::get('/apartments/trash', [ApartmentController::class, 'trash'])->name('apartments.trash');

    /* ROTTA RIPRISTINA DAL CESTINO */
    Route::patch('/apartments/{apartment}/restore', [ApartmentController::class, 'restore'])->name('apartments.restore')->withTrashed();

    /* ROTTA ELIMINAZIONE DEFINITIVA */
    Route::delete('/apartments/{apartment}/drop', [ApartmentController::class, 'drop'])->name('apartments.drop')->withTrashed();

    /* SVUOTA TUTTI GLI APPARTAMENTI DAL CESTINO */
    Route::delete('/apartments/empty', [ApartmentController::class, 'empty'])->name('apartments.empty');

    /* RIPRISTINA IL CESTINO */
    Route::patch('/apartments/returned', [ApartmentController::class, 'returned'])->name('apartments.returned');

    /* ROTTA RESOURCE LIST */
    Route::resource('apartments', ApartmentController::class)->withTrashed(['show', 'edit', 'update']);
});




/* ROTTA DASHBORD NON PIU' ESISTENTE */
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');


/* ROTTE PROFILO UTENTE */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
