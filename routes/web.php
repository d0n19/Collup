<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('welcome');
});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');
    Route::resource('projects', ProjectController::class);
    Route::post('/projects/{project}/apply', [ProjectController::class, 'apply'])
    ->name('projects.apply');
    Route::get('/my-projects', [ProjectController::class, 'myProjects'])->name('my-projects');
    Route::get('/feed', function () { return view('dashboard'); })->name('social.newsfeed');
    Route::get('/find-team', [ProjectController::class, 'index'])->name('social.find-team');

    Route::get('/friends', function () {return view('friends.index');})->name('friends');
    Route::get('/social-friends', function () { return view('friends.index'); })->name('social.friends');
    Route::get('/messenger', function () { return view('chats.index'); })->name('chat');
    Route::get('/chats', function () { return view('chats.index'); })->name('chats');
    Route::get('/social-chats', function () { return view('chats.index'); })->name('social.chats');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});