<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('posts',[PostController::class,'index']);
Route::get('create',[PostController::class,'create']);
Route::post('createpost',[PostController::class,'createpost']);
Route::get('editpost/{id}',[PostController::class,'editpost']);
Route::get('deletepost/{id}',[PostController::class,'deletepost']);
Route::post('updatepost/{id}',[PostController::class,'updatepost']);
