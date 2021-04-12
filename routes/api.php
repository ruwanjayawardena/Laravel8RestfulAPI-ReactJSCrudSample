<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sub1categoryController;
use App\Http\Controllers\MaincategoryController;

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

// Main Category restful api
Route::get('/maincategories',[MaincategoryController::class, 'index']);
Route::post('/maincategories/filterdata',[MaincategoryController::class, 'getDataTableFilterData']);
Route::post('/maincategories',[MaincategoryController::class, 'store']);
Route::get('/maincategories/{maincategory}',[MaincategoryController::class, 'show']);
Route::put('/maincategories/{maincategory}',[MaincategoryController::class, 'update']);
Route::delete('/maincategories/{maincategory}',[MaincategoryController::class, 'destroy']);

// Sub1 Category restful api
Route::get('/sub1categories',[Sub1categoryController::class, 'index']);
Route::post('/sub1categories',[Sub1categoryController::class, 'store']);
Route::get('/sub1categories/{sub1category}',[Sub1categoryController::class, 'show']);
Route::put('/sub1categories/{sub1category}',[Sub1categoryController::class, 'update']);
Route::delete('/sub1categories/{sub1category}',[Sub1categoryController::class, 'destroy']);