<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\InquiriesController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'  =>  'admin'], function () {
	Route::get('login', [AdminLoginController::class, 'index'])->name('login');
	Route::post('verify_login', [AdminLoginController::class, 'verify_login']);
	Route::get('logout', [AdminLoginController::class, 'logout']);

	Route::group(['middleware' => ['auth:admin']], function () {

		Route::get('/', [InquiriesController::class, 'index'])->name('admin.dashboard');
		Route::get('admin', [AdminController::class, 'index']);
		Route::get('change_password', [AdminController::class, 'change_password']);
		Route::post('update_password', [AdminController::class, 'update_password']);

		Route::group(['prefix'  =>  'inquiry'], function () {
			Route::get('/{id}', [InquiriesController::class, 'details']);
			Route::post('destroy', [InquiriesController::class, 'destroy']);
		});
	});
});
