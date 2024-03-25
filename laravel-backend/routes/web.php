<?php

use App\Http\Controllers\OpenapiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use App\Http\Middleware\ViewDocs;
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

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::group(['middleware' => [ViewDocs::class]], function () {
    Route::get('docs', [OpenapiController::class, 'docs'])->name('docs');
    Route::get('docs/json', [OpenapiController::class, 'getOpenApiJson'])->name('open-api-json');
});
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('/todos', TodoController::class);
    Route::get('/auth/profile', [ProfileController::class, 'user'])->name('profile-user');
});

require __DIR__.'/auth.php';
