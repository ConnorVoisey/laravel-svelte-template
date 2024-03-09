<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Knuckles\Scribe\Attributes\ResponseField;

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
        #[ResponseField('id', 'integer', 'required', 'The id of the newly created word')]
        function (Request $request) {
            return $request->user();
        }
    );
Route::resource('/todo', TodoController::class);

require __DIR__.'/auth.php';
