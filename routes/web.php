<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthManager;


Route::group(['middleware' => 'auth'], function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthManager::class, 'login'])->name('login')->middleware('throttle:20,1');;
    Route::get('/', [AuthManager::class, 'signup'])->name('signup')->middleware('throttle:20,1');;
    Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
    Route::post('/signup', [AuthManager::class, 'signupPost'])->name('signup.post');
});

