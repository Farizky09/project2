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
   
    Route::get('/', [TodolistController::class, 'index'])->name('index');
    Route::post('/', [TodolistController::class, 'store'])->name('store');
    Route::delete('/{todolist}', [TodolistController::class, 'destroy'])->name('destroy');
    Route::get('/list', [TodolistController::class, 'list'])->name('list');
    Route::put('/{todolist}/update', [TodolistController::class, 'update'])->name('update');
    
    // Route::get('/post-list',[PostController::class,'index'])->name('post.list');
    // Route::get('/post-add',[PostController::class,'addPost'])->name('add.post');
  
});