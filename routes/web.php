<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HozzaadController;
use App\Http\Controllers\ListaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/hozzaad', [HozzaadController::class, 'index']) -> name('hozzaad');
Route::post('/hozzaad', [HozzaadController::class, 'store']);

Route::get('/', [ListaController::class, 'index']) -> name('lista');
Route::post('/', [ListaController::class, 'store']);