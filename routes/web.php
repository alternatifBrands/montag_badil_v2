<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\HomeController;


Route::get('/login',[AuthController::class,'loginView'])->name('login');
Route::post('/login', [AuthController::class,'loginMethod'])->name('login.post');

Route::get('/register',[AuthController::class,'registerView'])->name('register');
Route::post('/register', [AuthController::class,'registerMethod'])->name('register.post');

Route::get('/forget-password', [AuthController::class,'forgetPasswordView'])->name('forget');
Route::post('/forget-password', [AuthController::class,'forgetPasswordMethod'])->name('forget.post');

Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordView'])->name('reset');
Route::post('/reset-password', [AuthController::class, 'resetPasswordMethod'])->name('reset.post');


Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/about',[HomeController::class, 'aboutPage'])->name('about');
Route::get('/contact',[HomeController::class, 'contactPage'])->name('contact');
Route::post('sendMessage',[HomeController::class, 'sendMessage'])->name('sendMessage');
Route::get('/brand/{id}',[HomeController::class, 'show'])->name('brand.details');
Route::get('/brand_alternative/{id}',[HomeController::class, 'showAlt'])->name('brandAlternative.details');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});