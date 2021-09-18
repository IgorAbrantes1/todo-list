<?php

use App\Http\Controllers\Todo\TodoController;
use Illuminate\Support\Facades\Route;

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

Route::group(['as' => 'todo.'], function () {
    Route::get('/', [TodoController::class, 'index'])->name('index');
    Route::post('/todos', [TodoController::class, 'store'])->name('store');
    Route::put('/todos/{todo:id}', [TodoController::class, 'update'])->name('update');
    Route::delete('/todos/{todo:id}', [TodoController::class, 'destroy'])->name('destroy');
});
