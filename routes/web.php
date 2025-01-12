<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome'); 
})->name('welcome');




// Routes pour le chatbot
Route::get('/chatbot', function () {
    return view('chatbot');
})->middleware('auth')->name('chatbot');
;

Route::post('/chatbot/query', [ChatbotController::class, 'handleQuery']);
Route::post('/chatbot/message', [ChatbotController::class, 'handleMessage']);

// Routes pour l'authentification
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
// Routes pour la déconnexion 
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login'); 
})->name('logout');
