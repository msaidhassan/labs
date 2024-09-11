<?php
use App\Http\Controllers\PostController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::post('/posts/restore/{id}', [PostController::class, 'restore'])->name('posts.restore');
// Route::resource('posts', PostController::class);
Route::post('posts/{post}/comments', [PostController::class, 'addComment'])->name('posts.addComment');
// Route::prefix('posts')->group(function () {
    
    // Place the static route first
Route::get('posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
    
    // Define the dynamic route after
    Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show')->where('id', '[0-9]+');
// });
// Route::resource('posts', PostController::class);
// Route::post('posts/{post}/comments', [PostController::class, 'addComment'])->name('posts.addComment');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
