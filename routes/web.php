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

    Route::get('/change-password',        [AdminController::class, 'showPageChangePassword'])->name('showAdminPageChangePassword');
    Route::post('/change-password/update',[AdminController::class, 'changePassword'])->name('changePassword');

    Route::get('/change-profile',         [AdminController::class, 'showAdminPageChangeProfile'])->name('showAdminPageChangeProfile');
    Route::put('/change-profile/update',  [FarmerController::class, 'changeProfile'])->name('changeAdminProfile');

});

Route::group(['prefix'=>'farmer', 'middleware'=>['isFarmer','auth']], function(){
    Route::get('/', [FarmerController::class, 'index']);
    Route::get('stocks/show',       [FarmerController::class, 'showStocks'])->name('showStocks');
    Route::post('/stock/add',        [FarmerController::class, 'handleAddStock'])->name('handleAddStock');
    Route::put('/stock/update/{id}', [FarmerController::class,'handleUpdateStock'])->name('handleUpdateStock');
    Route::get('/stock/delete/{id}', [FarmerController::class, 'handleDeleteStock'])->name('handleDeleteStock');

    Route::get('/member/show',        [FarmerController::class, 'showMember'])->name('showMember');
    Route::put('/member/update/{id}', [FarmerController::class,'handleUpdateMember'])->name('handleUpdateMember');
    Route::get('/member/delete/{id}', [FarmerController::class, 'handleDeleteMember'])->name('handleDeleteMember');

    Route::get('/event/show',         [FarmerController::class, 'showEvent'])->name('showEvent');
    Route::post('/event/add',         [FarmerController::class, 'handleAddEvent'])->name('handleAddEvent');
    Route::put('/event/update/{id}',  [FarmerController::class, 'handleUpdateEvent'])->name('handleUpdateEvent');
    Route::get('/event/delete/{id}',  [FarmerController::class, 'handleDeleteEvent'])->name('handleDeleteEvent');



    Route::get('/change-password',       [FarmerController::class, 'showPageChangePassword'])->name('showPageChangePassword');
    Route::post('/change-password/update',[FarmerController::class, 'changePassword'])->name('changePassword');

    Route::get('/change-profile',         [FarmerController::class, 'showPageChangeProfile'])->name('showPageChangeProfile');
    Route::put('/change-profile/update', [AdminController::class, 'changeProfile'])->name('changeProfile');

});

Route::group(['prefix'=>'individual', 'middleware'=>['isIndividual','auth']], function(){
    Route::get('/', [individualController::class, 'index']);

    Route::get('/change-profile',         [individualController::class, 'showIndividualPageChangeProfile'])->name('showIndividualPageChangeProfile');
    Route::put('/change-profile/update',  [FarmerController::class, 'changeProfile'])->name('changeIndividualProfile');

    Route::get('/change-password',        [individualController::class, 'showIndividualPageChangePassword'])->name('showIndividualPageChangePassword');
    Route::post('/change-password/update',[AdminController::class, 'changePassword'])->name('changeIndividualPassword');

});

Route::group(['prefix'=>'distributor', 'middleware'=>['isDistributor','auth']], function(){
    Route::get('/', [distributorController::class, 'index']);
});

Route::group(['prefix'=>'transporter', 'middleware'=>['isTransporter','auth']], function(){
    Route::get('/', [transporterController::class, 'index']);
});
