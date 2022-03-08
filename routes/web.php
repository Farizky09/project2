<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\TodolistController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();


Route::middleware(['auth'::class])->group(function(){
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  
    // Route::get('post/insert',[PostController::class,'create'])->name('insert');
    // Route::get('post/delete/{id}',[PostController::class,'destroy'])->name('delete');
    // Route::post('post/data/insert',[PostController::class,'store'])->name('store');
    // Route::put('post/{post}/update',[PostController::class,'update'])->name('update');
    Route::get('/', [TodolistController::class, 'index'])->name('index');
    Route::post('/', [TodolistController::class, 'store'])->name('store');
    Route::delete('/{todolist:id}', [TodolistController::class, 'destroy'])->name('destroy');
    
    Route::get('/post-list',[PostController::class,'index'])->name('post.list');
    Route::get('/post-add',[PostController::class,'addPost'])->name('add.post');
  
});