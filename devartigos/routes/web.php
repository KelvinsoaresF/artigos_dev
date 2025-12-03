<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'Index'])->name('home');


Route::get("/login", [AuthController::class, 'LoginShow'])->name('login.view');
Route::post("/login", [AuthController::class, 'Login'])->name('login');

Route::get("/register", [AuthController::class, 'RegisterShow'])->name('register.view');
Route::post("/register", [AuthController::class, 'Register'])->name('register');


Route::post("/logout", [AuthController::class, 'Logout'])->name('logout');



Route::get('/articles/create', [ArticleController::class, 'CreateShow'])->name('articles.create.view');
Route::post('/articles/store', [ArticleController::class, 'Create'])->name('articles.create');

Route::get('/articles/{article}', [ArticleController::class, 'Show'])->name('articles.show');

Route::get('/articles/{article}/edit', [ArticleController::class, 'EditShow'])->name('articles.edit.view');

Route::delete('/articles/{article}/delete', [ArticleController::class, 'Delete'])->name('articles.delete');
