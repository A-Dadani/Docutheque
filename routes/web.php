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

// Show Registeration Requests
Route::get('/users/requests', [UserController::class, 'indexRegistrationRequests'])->middleware('auth');

// Delete a user
Route::delete('/users/requests/{user}', [UserController::class, 'destroy'])->middleware('auth');

// Confirm a user
Route::patch('/users/requests/{user}', [UserController::class, 'confirm'])->middleware('auth');

// Show Register Form
Route::get('/register', [UserController::class, 'register'])->middleware('guest');

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// Authenticate User
Route::post('/authenticate', [UserController::class, 'authenticate']);

// Store User
Route::post('/users', [UserController::class, 'store']);

// Logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Store Contact Messages (from contact form on the home page)
Route::post('/contactus', [ContactMessageController::class, 'store']);

// Show All Contact Messages
Route::get('/messages', [ContactMessageController::class, 'index'])->middleware('auth');

// Delete a Contact Message
Route::delete('/messages/{message}', [ContactMessageController::class, 'destroy'])->middleware('auth');