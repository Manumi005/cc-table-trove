<?php

use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Auth\RestaurantAuthController;
use App\Http\Controllers\RestaurantProfileController;
use App\Http\Controllers\ProfileController; // Ensure this controller exists for customer profiles
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Customer Authentication Routes
Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::get('login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [CustomerAuthController::class, 'login']);
    Route::get('register', [CustomerAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [CustomerAuthController::class, 'register']);
    Route::post('logout', [CustomerAuthController::class, 'logout'])->name('logout');
    
    // Customer Dashboard Route
    Route::get('dashboard', [CustomerAuthController::class, 'dashboard'])->name('dashboard')->middleware('auth:customer');
    
    // Customer Profile Routes
    Route::middleware('auth:customer')->group(function() {
        Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});

// Restaurant Authentication Routes
Route::group(['prefix' => 'restaurant', 'as' => 'restaurant.'], function () {
    Route::get('login', [RestaurantAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [RestaurantAuthController::class, 'login']);
    Route::get('register', [RestaurantAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RestaurantAuthController::class, 'register']);
    Route::post('logout', [RestaurantAuthController::class, 'logout'])->name('logout');
    
    // Restaurant Dashboard Route
    Route::get('dashboard', function () {
        return view('restaurant.dashboard');
    })->name('dashboard')->middleware('auth:restaurant');

    // Restaurant Profile Routes
    Route::middleware('auth:restaurant')->group(function () {
        Route::get('profile', [RestaurantProfileController::class, 'show'])->name('profile.show');
        Route::get('profile/edit', [RestaurantProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [RestaurantProfileController::class, 'update'])->name('profile.update');
        Route::get('profile/add-to-customer-page', [RestaurantProfileController::class, 'addToCustomerPage'])->name('profile.addToCustomerPage');
        Route::get('profile/update-customer-page', [RestaurantProfileController::class, 'updateCustomerPage'])->name('profile.updateCustomerPage');
    });
});
