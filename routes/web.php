<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        // see if there's any token that hasn't expire, give that last one, otherwise 
        // just create a new one
        Log::debug("getting tokens");

        $checkToken = $request -> user() -> tokens -> where(function($q){
            return $q -> expires_at == null || $q -> expires_at <= Carbon::today();
        });
        if($checkToken != null){
            $token = $checkToken -> last();
        } else {
            $token = $request->user()->createToken($request->token_name);
        }

        foreach($request -> user() -> tokens as $token){
            Log::debug($token);
        }
     
        return ['token' => $token->plainTextToken];
    });

    Route::prefix('inventory')->name('inventory.')->group(function () {
        Route::controller(InventoryController::class) -> group(function(){
            Route::get('/', 'index') -> name('index');
            Route::get('/{productId}', 'show') -> name('show');
            Route::get('/{productId}/edit', 'edit') -> name('edit');
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
