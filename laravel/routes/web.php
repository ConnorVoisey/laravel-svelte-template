<?php

use App\Http\Controllers\OpenapiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use App\Http\Middleware\LocalDebug;
use Illuminate\Http\Request;
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

/**
 * TESTING
 */
Route::middleware(['auth:sanctum'])
    ->get(
        '/user',
        /**
         * @response {
         *    "id": 1,
         *    "name": "Testing",
         *    "email": "test@test.test",
         *    "email_verified_at": null,
         *    "created_at": "2024-03-06T21:36:21.000000Z",
         *    "updated_at": "2024-03-06T21:36:21.000000Z"
         *  }
         **/
        function (Request $request) {
            return $request->user();
        }
    );

Route::group(['middleware' => [LocalDebug::class]], function () {
    Route::get('docs', [OpenapiController::class, 'docs'])->name('docs');
    Route::get('docs/json', [OpenapiController::class, 'getOpenApiJson'])->name('open-api-json');
});
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('/todo', TodoController::class);
    Route::get('/user', [ProfileController::class, 'user'])->name('profile-user');
});

require __DIR__.'/auth.php';
