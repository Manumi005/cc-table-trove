<?php

use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Auth\RestaurantAuthController;
use App\Http\Controllers\RestaurantProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RestaurantMenuController;
use App\Http\Controllers\CustomerMenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerReservationController;
use App\Http\Controllers\RestaurantReservationController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Customer Authentication Routes
Route::prefix('customer')->as('customer.')->group(function () {
    Route::get('login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [CustomerAuthController::class, 'login']);
    Route::get('register', [CustomerAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [CustomerAuthController::class, 'register']);
    Route::post('logout', [CustomerAuthController::class, 'logout'])->name('logout');

    // Customer Dashboard Route
    Route::middleware('auth:customer')->get('dashboard', [CustomerAuthController::class, 'dashboard'])->name('dashboard');

    // Customer Profile Routes
    Route::middleware('auth:customer')->group(function () {
        Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    });

    // Customer Restaurant Routes
    Route::get('restaurants', [CustomerController::class, 'listRestaurants'])->name('restaurants');
    Route::get('restaurant/{id}', [CustomerController::class, 'showRestaurant'])->name('restaurant.details');
    Route::get('restaurant/{id}/menu', [CustomerMenuController::class, 'show'])->name('restaurant.menu');
    Route::post('filter-menu', [CustomerMenuController::class, 'filter'])->name('menu.filter');

    // Customer Reservation Routes
    Route::middleware('auth:customer')->group(function () {
        Route::get('reservations', [CustomerReservationController::class, 'index'])->name('reservations.index');
        Route::get('reserve', [CustomerReservationController::class, 'create'])->name('reservation.create');
        Route::post('reserve', [CustomerReservationController::class, 'store'])->name('reservations.store');
        Route::get('reservation/{id}', [CustomerReservationController::class, 'show'])->name('reservation.show');
        Route::delete('reservation/{id}', [CustomerReservationController::class, 'destroy'])->name('reservation.destroy');
    });
});

// Restaurant Authentication Routes
Route::prefix('restaurant')->as('restaurant.')->group(function () {
    Route::get('login', [RestaurantAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [RestaurantAuthController::class, 'login']);
    Route::get('register', [RestaurantAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RestaurantAuthController::class, 'register']);
    Route::post('logout', [RestaurantAuthController::class, 'logout'])->name('logout');

    // Restaurant Dashboard Route
    Route::middleware('auth:restaurant')->get('dashboard', function () {
        return view('restaurant.dashboard');
    })->name('dashboard');

    // Restaurant Profile Routes
    Route::middleware('auth:restaurant')->group(function () {
        Route::get('profile', [RestaurantProfileController::class, 'show'])->name('profile.show');
        Route::get('profile/edit', [RestaurantProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [RestaurantProfileController::class, 'update'])->name('profile.update');
    });

    // Restaurant Management Routes
    Route::middleware('auth:restaurant')->group(function () {
        Route::get('create', [RestaurantProfileController::class, 'create'])->name('create');
        Route::post('store', [RestaurantProfileController::class, 'store'])->name('store');
        Route::get('summary', [RestaurantProfileController::class, 'showSummary'])->name('summary');
        Route::get('details/{id}', [RestaurantProfileController::class, 'showRestaurantDetails'])->name('details');
        Route::delete('destroy/{id}', [RestaurantProfileController::class, 'destroy'])->name('destroy');
    });

    // Restaurant Menu Routes
    Route::middleware('auth:restaurant')->group(function () {
        Route::get('menu', [RestaurantMenuController::class, 'index'])->name('menu.index');
        Route::get('menu/create', [RestaurantMenuController::class, 'create'])->name('menu.create');
        Route::post('menu', [RestaurantMenuController::class, 'store'])->name('menu.store');
        Route::get('menu/{menu}/edit', [RestaurantMenuController::class, 'edit'])->name('menu.edit');
        Route::put('menu/{menu}', [RestaurantMenuController::class, 'update'])->name('menu.update');
        Route::delete('menu/{menu}', [RestaurantMenuController::class, 'destroy'])->name('menu.destroy');
    });

    // Restaurant Reservation Routes
    Route::middleware('auth:restaurant')->group(function () {
        Route::get('reservations', [RestaurantReservationController::class, 'index'])->name('reservation.index');
        Route::post('reservation/{id}/approve', [RestaurantReservationController::class, 'approve'])->name('reservation.approve');
        Route::delete('reservation/{id}', [RestaurantReservationController::class, 'destroy'])->name('reservation.destroy');
    });
});
