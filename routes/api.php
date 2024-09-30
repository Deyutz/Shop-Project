<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class,"loginUser"])->name("login"); 
Route::get('/register', [AuthController::class,"createUser"])->name("register"); 
        
Route::middleware("auth:sanctum")->group (function () {
    Route::get('/user', [UserController::class,"show"])->name("retrive"); 
    Route::post('/logout', [AuthController::class,"logoutUser"])->name("logout");   
    
Route::controller(CategoryController::class)->group(function () {
    
    Route::get('tree', 'ShowTree'); 
    Route::get('categories', 'index'); 
    Route::post('category/add', 'store'); 
    Route::get('category/{id}', 'show');
    Route::post('category/update/{id}', 'update'); 
    Route::delete('category/delete/{id}', 'delete');
    Route::group(["prefix"=>"category/{id}"],function():void{
        Route::get('/',"show");
        Route::get("/subcategories","findSubcategories");
    });
});

Route::controller(ProductController::class)->group(function () {
    Route::get("/products", "index");
    Route::get("/search", "searchProducts");
    Route::post("/product/add", "store");
    Route::get("/product/{id}", "show");
    Route::post("/product/update/{id}", "update");
    Route::delete("/product/delete/{id}", "delete");
});


Route::prefix("/product/{id}")->group(function () {
    Route::controller(PictureController::class)->group(function () {
        Route::get("/images", "index");
        Route::post("/image/add", action: "store");
        Route::get("/image/{id2}", "show");
        Route::post("/image/update/{id2}", "update");
        Route::delete("/image/delete/{id2}", "delete");
    });
});

Route::controller(OrderController::class)->group(function () {
    Route::get("/orders", "index");
    Route::post("/order/add", "store");
    Route::get("/order/{id}", "show");
    Route::post("/order/update/{id}", "update");
    Route::delete("/order/delete/{id}", "delete");
});
});