<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\HomeController;
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

Route::group(['prefix'=>'user', 'middleware'=>['isUser','auth']], function(){
    Route::get('/', [HomeController::class, 'index']);
});

Route::group(['prefix'=>'transporter', 'middleware'=>['isTransporter','auth']], function(){
    Route::get('/', function () {
        return "transporter Profile";
    });
});

Route::group(['prefix'=>'individual', 'middleware'=>['isIndividual','auth']], function(){
    Route::get('/', function () {
        return "individual Profile";
    });
});

Route::group(['prefix'=>'distribute', 'middleware'=>['isDistribute','auth']], function(){
    Route::get('/', function () {
        return "distribute Profile";
    });
});
