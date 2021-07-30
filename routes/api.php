<?php

use App\Http\Controllers\LecturasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('lecturas', [LecturasController::class, 'getAll']);
Route::post('lecturas', [LecturasController::class, 'createOne']);
Route::delete('lecturas/{id}', [LecturasController::class, 'deleteOne']);
