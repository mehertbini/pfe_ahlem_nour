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
    Route::patch('/users/toggle-status/{id}', [AdminController::class, 'toggleStatus'])->name('toggleUserStatus');


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

    Route::post('/member/{id}/confirm',[FarmerController::class, 'confirmUserAndAddToMembers'])->name('confirmUserAndAddToMembers');
    Route::get('/member/show',        [FarmerController::class, 'showMember'])->name('showMember');
    Route::put('/member/update/{id}', [FarmerController::class,'handleUpdateMember'])->name('handleUpdateMember');
    Route::get('/member/delete/{id}', [FarmerController::class, 'handleDeleteMember'])->name('handleDeleteMember');

    Route::get('/tasks',              [FarmerController::class, 'showTask'])->name('tasks.index');
    Route::post('/tasks/add',         [FarmerController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/update/{id}',  [FarmerController::class, 'update'])->name('tasks.update');
    Route::get('/tasks/delete/{id}',  [FarmerController::class, 'destroy'])->name('tasks.destroy');

    // web.php
    Route::get('/projects/{id}/individuals', [FarmerController::class, 'getProjectIndividuals'])->name('getProjectIndividuals');


    Route::get('/event/show',         [FarmerController::class, 'showEvent'])->name('showEvent');
    Route::post('/event/add',         [FarmerController::class, 'handleAddEvent'])->name('handleAddEvent');
    Route::put('/event/update/{id}',  [FarmerController::class, 'handleUpdateEvent'])->name('handleUpdateEvent');
    Route::get('/event/delete/{id}',  [FarmerController::class, 'handleDeleteEvent'])->name('handleDeleteEvent');


    Route::get('/project/show',      [FarmerController::class, 'showProject'])->name('showProject');
    Route::post('/project/add/',     [FarmerController::class, 'handleAddProject'])->name('handleAddProject');
    Route::put('/project/update/{id}',[FarmerController::class, 'handleUpdateProject'])->name('handleUpdateProject');
    Route::delete('/project/delete/{id}',[FarmerController::class, 'handleDeleteProject'])->name('handleDeleteProject');



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

    Route::get('/individual/tasks-by-project', [IndividualController::class, 'getTasksByProject'])->name('getTasksByProject');

    Route::get('/notifications/mark-as-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.markAsRead');

});

Route::group(['prefix'=>'distributor', 'middleware'=>['isDistributor','auth']], function(){
    Route::get('/', [distributorController::class, 'index'])->name('distributor');
    Route::post('/add', [distributorController::class, 'handleAddDistributor'])->name('handleAddDistributor');
    Route::put('/update/{id}', [distributorController::class, 'handleUpdateDistributor'])->name('handleUpdateDistributor');
    Route::delete('/delete/{id}', [distributorController::class, 'handleDeleteDistributor'])->name('handleDeleteDistributor');

    Route::get('/change-profile',         [distributorController::class, 'showDistributorControllerPageChangeProfile'])->name('showDistributorPageChangeProfile');
    Route::put('/change-profile/update',  [FarmerController::class, 'changeProfile'])->name('changeDistributorProfile');

    Route::get('/change-password',        [distributorController::class, 'showDistributorPageChangePassword'])->name('showDistributorPageChangePassword');
    Route::post('/change-password/update',[AdminController::class, 'changePassword'])->name('changeDistributorPassword');
});

Route::group(['prefix'=>'transporter', 'middleware'=>['isTransporter','auth']], function(){
    Route::get('/', [transporterController::class, 'index'])->name('transporter');
    Route::post('/add', [transporterController::class, 'handleAddTransporter'])->name('handleAddTransporter');
    Route::put('/update/{id}', [TransporterController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [TransporterController::class, 'destroy'])->name('delete');


    Route::get('/trip/show', [transporterController::class, 'showRoute'])->name('showRoute');
    Route::post('/add-trip', [transporterController::class, 'handleAddTrip'])->name('handleAddTrip');
    Route::put('routes/{id}', [transporterController::class, 'handleUpdateRoute'])->name('handleUpdateRoute');
    Route::delete('routes/{id}', [transporterController::class, 'destroyRoute'])->name('destroyRoute');

    Route::get('/trip/{id}/map', [transporterController::class, 'showMap'])->name('showMap');




    Route::get('/change-profile',         [TransporterController::class, 'showTransporterPageChangeProfile'])->name('showTransporterPageChangeProfile');
    Route::put('/change-profile/update',  [FarmerController::class, 'changeProfile'])->name('changeTransporterProfile');

    Route::get('/change-password',        [TransporterController::class, 'showTransporterPageChangePassword'])->name('showTransporterPageChangePassword');
    Route::post('/change-password/update',[AdminController::class, 'changePassword'])->name('changeTransporterPassword');
});
