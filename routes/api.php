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
    Route::get('/inventory', [InventoryController::class, 'index']) -> name('api.inventory.index');
    Route::post('/inventory/pump', [InventoryController::class, 'pump']) -> name('api.inventory.pump');
    Route::post('/add-inventory', [InventoryController::class, 'create']) -> name('api.inventory.create');
    Route::delete('/delete-inventory/{productId}', [InventoryController::class, 'destroy']) -> name('api.inventory.delete');
    Route::post('/update-inventory/{productId}', [InventoryController::class, 'update']) -> name('api.inventory.update');
    Route::get('/inventory/{productId}', [InventoryController::class, 'show']) -> name('api.inventory.show');
});

// TODO
// more APIs but for admins/role that can do only