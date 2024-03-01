<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\InventoryController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
    most are admin only use, but will deal with that later.
*/
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::prefix('inventory')->name('api.inventory.')->group(function () {
        Route::controller(InventoryController::class) -> group(function(){
            Route::get('/', 'index') -> name('index');
            Route::post('/pump', 'pump') -> name('pump');
            Route::get('/{productId}', 'show') -> name('show');
        });
    });
    Route::post('/add-inventory', [InventoryController::class, 'create']) -> name('api.inventory.create');
    Route::delete('/delete-inventory/{$productID}', [InventoryController::class, 'delete']) -> name('api.inventory.delete');
    Route::post('/add-inventory/{$productID}', [InventoryController::class, 'update']) -> name('api.inventory.update');
});

// TODO
// more APIs but for admins/role that can do only