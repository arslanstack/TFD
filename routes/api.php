<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\UserContactController;


Route::group(['middleware' => 'api'], function ($router) {
    // Users Routes group with route for inquiry/contact form
    Route::group(['prefix' => 'inquire'], function () {
        Route::post('/', [UserContactController::class, 'store']);
    });
});
