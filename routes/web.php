<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\distributor\distributorController;
use App\Http\Controllers\farmer\FarmerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\individual\individualController;
use App\Http\Controllers\transporter\transporterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('contact', [HomeController::class, 'showContactPage'])->name('showContactPage');

Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth']], function(){

    Route::get('/',            [AdminController::class, 'index']);
    Route::get('/users',       [AdminController::class, 'showUsers'])->name('showUsers');
    Route::post('/users/add',       [AdminController::class, 'handleAddUser'])->name('handleAddUser');
    Route::put('/users/update/{id}', [AdminController::class,'handleUpdateUser'])->name('handleUpdateUser');
    Route::get('/users/delete/{id}', [AdminController::class, 'handleDeleteUser'])->name('handleDeleteUser');

    Route::get('/change-password',       [AdminController::class, 'showPageChangePassword'])->name('showPageChangePassword');
    Route::post('/change-password/update',[AdminController::class, 'changePassword'])->name('changePassword');

});

Route::group(['prefix'=>'farmer', 'middleware'=>['isUser','auth']], function(){
    Route::get('/', [FarmerController::class, 'index']);
    Route::get('stocks/show',       [FarmerController::class, 'showStocks'])->name('showStocks');
    Route::post('/stock/add',        [FarmerController::class, 'handleAddStock'])->name('handleAddStock');
    Route::put('/stock/update/{id}', [FarmerController::class,'handleUpdateStock'])->name('handleUpdateStock');
    Route::get('/stock/delete/{id}', [FarmerController::class, 'handleDeleteStock'])->name('handleDeleteStock');

    Route::get('/profiles/show',       [FarmerController::class, 'showProfiles'])->name('showProfiles');
    Route::put('/profiles/update/{id}', [FarmerController::class,'handleUpdateProfile'])->name('handleUpdateProfile');


    Route::get('/change-password',       [FarmerController::class, 'showPageChangePassword'])->name('showPageChangePassword');
    Route::post('/change-password/update',[FarmerController::class, 'changePassword'])->name('changePassword');


});

Route::group(['prefix'=>'transporter', 'middleware'=>['isTransporter','auth']], function(){
    Route::get('/', [transporterController::class, 'index']);
});

Route::group(['prefix'=>'individual', 'middleware'=>['isIndividual','auth']], function(){
    Route::get('/', [individualController::class, 'index']);
});

Route::group(['prefix'=>'distributor', 'middleware'=>['isDistributor','auth']], function(){
    Route::get('/', [distributorController::class, 'index']);
});
