<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\BrandAlternativeController;
use App\Http\Controllers\API\BrandMapBrandAltController;
use App\Http\Controllers\API\ProductAlternativeController;
use App\Http\Controllers\API\ProductMapProductAltController;

// part 1
Route::post('registerAPI',[AuthController::class,'register']);
Route::post('loginAPI',[AuthController::class,'login']);
Route::post('forgetPassword',[AuthController::class,'forgetPassword']);
Route::post('resetPassword',[AuthController::class,'resetPassword']);
Route::post('resendOTP',[AuthController::class,'resendOTP']);
Route::post('checkOTP',[AuthController::class,'checkOTP']);
// part 2
Route::get('categories',[CategoryController::class,'index']);
Route::get('categories/{id}',[CategoryController::class,'show']);
Route::get('categories/search/{keyword}',[CategoryController::class,'search']);
// part 3
Route::get('brands',[BrandController::class,'index']);
Route::get('brands/{id}',[BrandController::class,'show']);
Route::get('brands/search/{keyword}',[BrandController::class,'search']);
// part 4
Route::get('brandsAlternative',[BrandAlternativeController::class,'index']);
Route::get('brandsAlternative/{id}',[BrandAlternativeController::class,'show']);
Route::get('brandsAlternative/search/{keyword}',[BrandAlternativeController::class,'search']);
// part 5
Route::get('products',[ProductController::class,'index']);
Route::get('products/{id}',[ProductController::class,'show']);
Route::get('products/search/{keyword}',[ProductController::class,'search']);
// part 6
Route::get('productsAlternative',[ProductAlternativeController::class,'index']);
Route::get('productsAlternative/{id}',[ProductAlternativeController::class,'show']);
Route::get('productsAlternative/search/{keyword}',[ProductAlternativeController::class,'search']);


Route::middleware('auth:api')->group(function(){
    // part 1
    Route::post('logoutAPI',[AuthController::class,'logout']);
    Route::post('changePassword',[AuthController::class,'changePassword']);
    Route::get('profile',[AuthController::class,'profile']);
    Route::put('updateProfile',[AuthController::class,'updateProfile']);
    Route::delete('deleteProfile',[AuthController::class,'deleteProfile']);
    // part 3
    Route::post('brands',[BrandController::class,'store']);
    Route::post('brands/{id}',[BrandController::class,'update']);
    // part 4
    Route::post('brandsAlternative',[BrandAlternativeController::class,'store']);
    Route::post('brandsAlternative/{id}',[BrandAlternativeController::class,'update']);
    Route::post('brands_sync_brandsAlternative',[BrandMapBrandAltController::class,'store']);
    // part 5
    Route::post('products',[ProductController::class,'store']);
    Route::post('products/{id}',[ProductController::class,'update']);
    // part 6
    Route::post('productsAlternative',[ProductAlternativeController::class,'store']);
    Route::post('productsAlternative/{id}',[ProductAlternativeController::class,'update']);
    Route::post('products_sync_productsAlternative',[ProductMapProductAltController::class,'store']);
});