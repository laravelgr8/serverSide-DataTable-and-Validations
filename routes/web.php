<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/',[PaymentController::class,'pay']);
// Route::post('/',[PaymentController::class,'payment'])->name('make-payment');

Route::get('/',[UserController::class,'index']);
Route::post('/',[UserController::class,'save'])->name('create-student');

Route::get('users', [UserController::class, 'show'])->name('users.index');
Route::get('edit/{id}', [UserController::class, 'edit'])->name('users.edit');
