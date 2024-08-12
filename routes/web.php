<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
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
    return view('welcome');
});
// Routes for guests users
Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('throttle:2,1');
    Route::get('register', [AuthController::class, 'register_view'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register')->middleware('throttle:2,1');
});

// Routes for authenticated users
Route::group(['middleware' => 'auth'], function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // Prefix routes for event 
    Route::prefix('events')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('event.index');
        Route::get('create', [EventController::class, 'create'])->name('event.create');
        Route::post('/', [EventController::class, 'store'])->name('event.store');
        Route::get('{id}/edit', [EventController::class, 'edit'])->name('event.edit');
        Route::put('{id}', [EventController::class, 'update'])->name('event.update');
        Route::delete('{id}', [EventController::class, 'delete'])->name('event.delete');
    });
});
