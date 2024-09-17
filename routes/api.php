<?php

use App\Http\Controllers\Api\ApartmentsController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\FilterServiceController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\ViewController;
use App\Models\Session as ModelsSession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


/* ROTTA FILTRI */

Route::get('apartments/filter', [FilterController::class, 'index']);

/* ROTTA RICEVI MESSAGGIO */
Route::post('/messages', [MessageController::class, 'store']);

/* ROTTA APPARAMENTI */
Route::apiResource('apartments', ApartmentsController::class)->only('index');

/* ROTTA DETTAGLIO APPARTAMENTO */
Route::get('apartments/{id}', [ApartmentsController::class, 'show']);

/* ??? */
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* ROTTA SERVIZI */
Route::apiResource('services', ServicesController::class)->only('index');

/* ROTTA SERVIZI PER APPARAMENTO SPECIFICO */
Route::get('services/{id}/apartments', FilterServiceController::class);

// User route
Route::get('/user');
