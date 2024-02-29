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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::controller(InventoryController::class) -> group(function(){
        Route::get('/inventory', 'index') -> name('inventory.index');
        Route::get('/inventory/{productId}', 'show') -> name('inventory.show');
    });
});

// TODO
// more APIs but for admins/role that can do only