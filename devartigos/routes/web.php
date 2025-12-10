<?php
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;

Route::get('/', [MainController::class, 'Index'])->name('home');

Route::get("/login", [AuthController::class, 'LoginShow'])->name('login.view');
Route::post("/login", [AuthController::class, 'Login'])->name('login');

Route::get("/register", [AuthController::class, 'RegisterShow'])->name('register.view');
Route::post("/register", [AuthController::class, 'Register'])->name('register');

// apenas usuarios logados podem acessar as rotas dentro deste grupo
Route::middleware(['auth'])->group(function() {
    Route::post("/logout", [AuthController::class, 'Logout'])->name('logout');

    Route::get('/articles/create', [ArticleController::class, 'CreateShow'])->name('articles.create.view');
    Route::post('/articles/store', [ArticleController::class, 'Create'])->name('articles.create');

    Route::get('/articles/{article}', [ArticleController::class, 'Show'])->name('articles.show');

    Route::get('/articles/{article}/edit', [ArticleController::class, 'EditShow'])->name('articles.edit.view');
    Route::put('/articles/{article}/edit', [ArticleController::class, 'Edit'])->name('articles.update');

    Route::delete('/articles/{article}/delete', [ArticleController::class, 'Delete'])->name('articles.delete');

    Route::get('/profile', [ProfileController::class, 'Show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'EditShow'])->name('profile.edit.view');
    Route::put('/profile/edit', [ProfileController::class, 'Edit'])->name('profile.update');

    Route::get('/profile/{id}', [ProfileController::class, 'ShowPublic'])->name('profile.public.show');

    Route::delete('/profile/delete', [ProfileController::class, 'Delete'])->name('profile.delete');

    Route::get('/search', [MainController::class, 'Search'])->name('search.users');
});

