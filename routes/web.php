<?php

use Illuminate\Foundation\Console\RouteCacheCommand;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Exception\RouteCircularReferenceException;

Route::get('/', function () {
    return  redirect()->route('index.action');
});


Route::get('/posts', [App\Http\Controllers\TestController::class, 'testAction'])->name('index.action');
Route::get('/posts/create', [App\Http\Controllers\TestController::class, 'create'])->name('post.create');
Route::post('/posts',[App\Http\Controllers\TestController::class, 'store'])->name('post.store');
Route::get('/posts/{post}',[App\Http\Controllers\TestController::class, 'show'])->name('post.show');
Route::get('/posts/{post}/edit', [App\Http\Controllers\TestController::class, 'edit'])->name('post.edit');
Route::put('/posts/{post}', [App\Http\Controllers\TestController::class, 'update'])->name('post.update');
Route::delete('/posts/{post}', [App\Http\Controllers\TestController::class, 'destroy'])->name('post.destroy');
