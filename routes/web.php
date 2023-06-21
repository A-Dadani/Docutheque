<?php

use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Show Home Page
Route::get('/', function () {
    return view('accueil');
});

// Store Contact Messages (from contact form on the home page)
Route::post('/contactus', [ContactMessageController::class, 'store']);

//Show Contact Messages
Route::get('/messages', [ContactMessageController::class, 'index']);

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->middleware('guest');

// Authenticate User
Route::post('/authenticate', [UserController::class, 'authenticate']);

// Logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');