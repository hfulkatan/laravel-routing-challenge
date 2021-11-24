<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ArtistController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => 'artists', 'middleware' => ['auth']], function(){
    Route::get('/', [\App\Http\Controllers\ArtistController::class, 'index'])->name('artists.index');
    Route::get('/artist/{artist:id}', [\App\Http\Controllers\ArtistController::class, 'show'])->name('artists.show');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'auth.admin']], function() {
    Route::resource('artists', ArtistController::class)->except(['index', 'show']);
});

require __DIR__ . '/auth.php';
