<?php

use App\Http\Controllers\Users\UsersCreateController;
use Illuminate\Support\Facades\Route;

// // Toutes les routes Users protégées
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::get('/users',            [UsersIndexController::class, 'index'])->name('users.index');
 //     // Route::post('/users',           [UserController::class, 'store'])->name('users.store');
//     // Route::get('/users/{user}/edit',[UserController::class, 'edit'])->name('users.edit');
//     // Route::put('/users/{user}',     [UserController::class, 'update'])->name('users.update');
//     // Route::delete('/users/{user}',  [UserController::class, 'destroy'])->name('users.destroy');
// });


use App\Http\Controllers\Users\UsersIndexController;

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/users', UsersIndexController::class)->name('users.index'); // 👈 pas de 'index'
    Route::get('/users/create', UsersCreateController::class)->name('users.create'); //
});
