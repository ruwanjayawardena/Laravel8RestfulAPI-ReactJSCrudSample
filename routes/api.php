<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaincategoryController;
use App\Http\Controllers\Sub1categoryController;
use App\Http\Controllers\Sub2categoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//load combo boxes
Route::get('/cmb/maincategory',[MaincategoryController::class, 'cmbMainCategory']);
Route::get('/cmb/sub1categories/{id}',[Sub1categoryController::class, 'cmbSubCategory']);
Route::get('/cmb/sub2categories/{id}',[Sub2categoryController::class, 'cmbSub2Category']);

// Main Category restful api
Route::get('/maincategories',[MaincategoryController::class, 'index']);
Route::post('/maincategories/filterdata',[MaincategoryController::class, 'getDataTableFilterData']);
Route::post('/maincategories',[MaincategoryController::class, 'store']);
Route::get('/maincategories/{maincategory}',[MaincategoryController::class, 'show']);
Route::put('/maincategories/{maincategory}',[MaincategoryController::class, 'update']);
Route::delete('/maincategories/{maincategory}',[MaincategoryController::class, 'destroy']);

// Sub1 Category restful api
Route::get('/sub1categories',[Sub1categoryController::class, 'index']);
Route::post('/sub1categories/filterdata',[Sub1categoryController::class, 'getDataTableFilterData']);
Route::post('/sub1categories',[Sub1categoryController::class, 'store']);
Route::get('/sub1categories/{sub1category}',[Sub1categoryController::class, 'show']);
Route::put('/sub1categories/{sub1category}',[Sub1categoryController::class, 'update']);
Route::delete('/sub1categories/{sub1category}',[Sub1categoryController::class, 'destroy']);

// Sub2 Category restful api
Route::get('/sub2categories',[Sub2categoryController::class, 'index']);
Route::post('/sub2categories/filterdata',[Sub2categoryController::class, 'getDataTableFilterData']);
Route::post('/sub2categories',[Sub2categoryController::class, 'store']);
Route::get('/sub2categories/{sub2category}',[Sub2categoryController::class, 'show']);
Route::put('/sub2categories/{sub2category}',[Sub2categoryController::class, 'update']);
Route::delete('/sub2categories/{sub2category}',[Sub2categoryController::class, 'destroy']);

// Product restful api
Route::get('/products',[ProductController::class, 'index']);
Route::post('/products/filterdata',[ProductController::class, 'getDataTableFilterData']);
Route::post('/products',[ProductController::class, 'store']);
Route::get('/products/{product}',[ProductController::class, 'show']);
Route::put('/products/{product}',[ProductController::class, 'update']);
Route::delete('/products/{product}',[ProductController::class, 'destroy']);