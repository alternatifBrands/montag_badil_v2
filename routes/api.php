<?php

use App\Http\Controllers\API\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\BrandAlternativeController;
use App\Http\Controllers\API\BrandMapBrandAltController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\ProductAlternativeController;
use App\Http\Controllers\API\ProductMapProductAltController;
use App\Models\BrandAlternative;

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
Route::middleware(['web'])->group(function () {
    
    // part 3
    Route::get('brands',[BrandController::class,'index']);
    Route::get('brands/{id}',[BrandController::class,'show']);
    Route::get('brands/search/{keyword}',[BrandController::class,'search']);
    
    Route::get('recentlyViewed',[BrandController::class,'recentlyViewed']);
    
});
// part 4
Route::get('brandsAlternative/search',[BrandAlternativeController::class,'search']);
Route::get('brandsAlternative',[BrandAlternativeController::class,'index']);
Route::get('brandsAlternative/{id}',[BrandAlternativeController::class,'show']);
// part 5
Route::get('products',[ProductController::class,'index']);
Route::get('products/{id}',[ProductController::class,'show']);
Route::get('products/search/{keyword}',[ProductController::class,'search']);
// part 6
Route::get('productsAlternative',[ProductAlternativeController::class,'index']);
Route::get('productsAlternative/{id}',[ProductAlternativeController::class,'show']);
Route::get('productsAlternative/search/{keyword}',[ProductAlternativeController::class,'search']);


Route::get('countries',[CountryController::class,'index']);


Route::middleware('auth:api')->group(function(){
    // part 1
    Route::post('logoutAPI',[AuthController::class,'logout']);
    Route::post('changePassword',[AuthController::class,'changePassword']);
    Route::get('profile',[AuthController::class,'profile']);
    Route::post('updateProfile',[AuthController::class,'updateProfile']);
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

    Route::get('export_example',[BrandAlternativeController::class,'export_example']);
    Route::post('export',[BrandAlternativeController::class,'export']);
    Route::post('import',[BrandAlternativeController::class,'import']);


});
Route::get('settings', [SettingsController::class, 'index']);