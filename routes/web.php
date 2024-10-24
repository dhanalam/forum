<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\ThreadsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('threads', [ThreadsController::class, 'index'])->name('threads.index');
Route::post('threads', [ThreadsController::class, 'store'])->name('threads.store');
Route::get('threads/create', [ThreadsController::class, 'create'])->name('threads.create');
Route::get('threads/{channel}', [ThreadsController::class, 'index']);
Route::get('threads/{channel}/{thread}', [ThreadsController::class, 'show'])->name('threads.show');
Route::post('/threads/{channel}/{thread}/replies', [RepliesController::class, 'store'])->name('threads.reply.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
