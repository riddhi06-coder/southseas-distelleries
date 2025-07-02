<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Backend\CareerListingController;
use App\Http\Controllers\Backend\CareerCategoryListingController;
use App\Http\Controllers\Backend\JobDetailsController;


use App\Http\Controllers\Frontend\HomeController;

Route::get('/', function () {
    return view('frontend.home');
});
  
// Authentication Routes
Route::get('/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('admin.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::get('/change-password', [LoginController::class, 'change_password'])->name('admin.changepassword');
Route::post('/update-password', [LoginController::class, 'updatePassword'])->name('admin.updatepassword');

// Admin Routes with Middleware
Route::group(['middleware' => ['auth:web', \App\Http\Middleware\PreventBackHistoryMiddleware::class]], function () {
    Route::get('/dashboard', function () {
        return view('backend.dashboard'); 
    })->name('admin.dashboard');
});


// ==== Manage Career Category
Route::resource('manage-career-category', CareerListingController::class);

// ==== Manage Career Category Listing
Route::resource('manage-category-listing', CareerCategoryListingController::class);

// ==== Manage Career Category Listing
Route::resource('manage-job-details', JobDetailsController::class);



// ===================================================================Frontend================================================================


Route::group(['prefix'=> '', 'middleware'=>[\App\Http\Middleware\PreventBackHistoryMiddleware::class]],function(){


    Route::get('/careers', [HomeController::class, 'index'])->name('careers.page');
    Route::get('/careers-form', [HomeController::class, 'careers_form'])->name('careers.form');
    Route::get('/career-category/{slug}', [HomeController::class, 'career_category'])->name('career.category');
    Route::get('/job-details/{slug}', [HomeController::class, 'job_details'])->name('job.details');

    
});