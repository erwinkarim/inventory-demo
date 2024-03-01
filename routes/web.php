<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/tokens/create', function (Request $request) {
        $token = $request->user()->createToken($request->token_name);
     
        return ['token' => $token->plainTextToken];
    });

    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::controller(InventoryController::class) -> group(function(){
            Route::get('/', 'index') -> name('index');
            Route::get('/{productId}', 'show') -> name('show');
        });
    });
    /*
    Route::controller(InventoryController::class) -> Route::prefix('/inventory') -> group(function(){
    });
    */
});

// TODO: more admin pages for update / delete / new product

// TODO: user admin / role for admin users

require __DIR__.'/auth.php';
