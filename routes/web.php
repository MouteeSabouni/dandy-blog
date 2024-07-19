<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FinderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;

Route::get('/', [FinderController::class, 'home'])->name('home');
Route::get('/services/{service}', [FinderController::class, 'loadServiceView'])->name('service');

Route::middleware('auth')->group(function () {
    Route::resource('/posts', PostController::class);

    Route::post('/posts/{post}/like', [LikesController::class, 'like'])->name('posts.like');
    Route::post('/posts/{post}/unlike', [LikesController::class, 'unlike'])->name('posts.unlike');

    Route::get('oldest-posts', [PostController::class, 'getOldest'])->name('posts.oldest');
    Route::get('short-posts', [PostController::class, 'getShort'])->name('posts.short');
    Route::get('featured-posts', [PostController::class, 'getFeatured'])->name('posts.featured');
    Route::get('posts-by-user/{user}', [PostController::class, 'getByUser'])->name('posts.by-user');
    Route::get('posts-by-tag/{tag}', [PostController::class, 'getByTag'])->name('posts.by-tag');

    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::patch('/posts/{post}/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}/delete', [CommentController::class, 'destroy']);

    Route::get('/search', [FinderController::class, 'search'])->name('search');

    Route::patch('/users/{user}', [UserController::class, 'updateProfile'])->name('users.update-profile');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{user}/password', [UserController::class, 'updatePassword'])->name('users.update-password');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
});

Auth::routes();
