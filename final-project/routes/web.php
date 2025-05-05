<?php

use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\AuthController;

// public recipes
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
});

Route::get('/recipes/{id}', [RecipeController::class, 'show'])->name('recipes.show');

Route::middleware(['auth'])->group(function () {
    //recipes 
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{id}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::post('/recipes/{id}/update', [RecipeController::class, 'update'])->name('recipes.update');
    Route::post('/recipes/{id}/delete', [RecipeController::class, 'delete'])->name('recipes.delete');


    //comment 
    Route::post('/recipes/{recipeId}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::post('/comments/{id}/update', [CommentController::class, 'update'])->name('comments.update');
    Route::post('/comments/{id}/delete', [CommentController::class, 'delete'])->name('comments.delete');

    //favorite 
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/recipes/{recipeId}/favorite', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::post('/favorites/{id}/delete', [FavoriteController::class, 'delete'])->name('favorites.delete');
});


// Authentication
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
