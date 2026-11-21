<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\UserCollectionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/media', [MediaController::class, 'index'])->name('media.index');
Route::post('/media', [MediaController::class, 'store'])->name('media.store');
Route::get('/media/{media}', [MediaController::class, 'show'])->name('media.show');
Route::match(['put', 'patch'], '/media/{media}', [MediaController::class, 'update'])->name('media.update');
Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

Route::get('/users/{user}/media', [UserCollectionController::class, 'index']);
Route::post('/users/{user}/media/{media}', [UserCollectionController::class, 'store']);
Route::delete('/users/{user}/media/{media}', [UserCollectionController::class, 'destroy']);
