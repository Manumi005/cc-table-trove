<?php

use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\Auth\RestaurantAuthController;
use App\Http\Controllers\RestaurantProfileController;
use App\Http\Controllers\PreOrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RestaurantMenuController;
use App\Http\Controllers\CustomerMenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerReservationController;
use App\Http\Controllers\RestaurantReservationController;
use App\Http\Controllers\RestaurantPreOrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OffersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomizationController;
use App\Http\Controllers\ReviewController;

// Home Route
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Customer Routes
Route::prefix('customer')->as('customer.')->group(function () {
    // Authentication Routes
    Route::get('login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [CustomerAuthController::class, 'login']);
    Route::get('register', [CustomerAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [CustomerAuthController::class, 'register']);
    Route::post('logout', [CustomerAuthController::class, 'logout'])->name('logout');

    // Authenticated Routes
    Route::middleware('auth:customer')->group(function () {
        Route::get('dashboard', [CustomerAuthController::class, 'dashboard'])->name('dashboard');

        // Profile Routes
        Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

        // Reservations Routes
        Route::get('reservations', [CustomerReservationController::class, 'index'])->name('reservations.index');
        Route::get('reserve', [CustomerReservationController::class, 'create'])->name('reservation.create');
        Route::post('reserve', [CustomerReservationController::class, 'store'])->name('reservations.store');
        Route::get('reservation/{id}', [CustomerReservationController::class, 'show'])->name('reservation.show');
        Route::delete('reserve/{id}', [CustomerReservationController::class, 'destroy'])->name('reservations.destroy');

        // Customizations Routes
        Route::prefix('reservations/{reservation_id}/customizations')->name('reservations.customizations.')->group(function () {
            Route::get('/', [CustomizationController::class, 'index'])->name('index');
            Route::get('/create', [CustomizationController::class, 'create'])->name('create');
            Route::post('/', [CustomizationController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [CustomizationController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CustomizationController::class, 'update'])->name('update');
            Route::delete('/{id}', [CustomizationController::class, 'destroy'])->name('destroy');
        });
    });

    // Restaurant Routes
    Route::get('restaurants', [CustomerController::class, 'listRestaurants'])->name('restaurants');
    Route::get('restaurant/{id}', [CustomerController::class, 'showRestaurant'])->name('restaurant.details');
    Route::get('restaurant/{id}/menu', [CustomerMenuController::class, 'show'])->name('restaurant.menu');
    Route::post('/filter-menu', [CustomerMenuController::class, 'filter'])->name('filter-menu');
    Route::post('/customer/menu/add', [CustomerMenuController::class, 'add'])->name('customer.menu.add');
});

// Pre-Order Routes
Route::get('/preorders/{reservation}', [PreOrderController::class, 'index'])->name('preorders.index');
Route::get('/preorders/create/{reservation}', [PreOrderController::class, 'create'])->name('preorders.create'); // Pass reservation_id
Route::post('/preorders', [PreOrderController::class, 'store'])->name('preorders.store');
Route::get('/preorders/{preorder}/edit', [PreOrderController::class, 'edit'])->name('preorders.edit');
Route::put('/preorders/{preorder}', [PreOrderController::class, 'update'])->name('preorders.update');
Route::delete('/preorders/{preorder}', [PreOrderController::class, 'destroy'])->name('preorders.destroy');
Route::get('/preorder/summary', [PreOrderController::class, 'summary'])->name('preorder.summary');
Route::post('/submit-preorder/{reservation}', [PreOrderController::class, 'submitPreOrder'])->name('submit.preorder');
Route::post('/preorders/{id}/adjust-quantity', [PreOrderController::class, 'adjustQuantity'])->name('preorders.adjustQuantity');
Route::delete('/preorders/{id}', [PreOrderController::class, 'destroy'])->name('preorders.destroy');

// Payment Routes
// Route to show the payment form
Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('showPaymentForm');
Route::post('/processPayment', [PaymentController::class, 'processPayment'])->name('processPayment');
Route::get('/orderSummary', function () {
    return view('customer.orderSummary');
})->name('orderSummary');


Route::post('/order/approve', [OrderController::class, 'approveOrder'])->name('order.approve');
Route::post('/order/cancel', [OrderController::class, 'cancelOrder'])->name('order.cancel');

Route::get('/restaurant/payment', [PaymentController::class, 'showPaymentVerification'])->name('restaurant.payment');
// Restaurant Routes
Route::prefix('restaurant')->as('restaurant.')->group(function () {
    // Authentication Routes
    Route::get('login', [RestaurantAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [RestaurantAuthController::class, 'login']);
    Route::get('register', [RestaurantAuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RestaurantAuthController::class, 'register']);
    Route::post('logout', [RestaurantAuthController::class, 'logout'])->name('logout');

    // Authenticated Routes
    Route::middleware('auth:restaurant')->group(function () {
        Route::get('dashboard', function () {
            return view('restaurant.dashboard');
        })->name('dashboard');

        // Profile Routes
        Route::get('profile', [RestaurantProfileController::class, 'show'])->name('profile.show');
        Route::get('profile/edit', [RestaurantProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile', [RestaurantProfileController::class, 'update'])->name('profile.update');

        // Restaurant Management Routes
        Route::get('create', [RestaurantProfileController::class, 'create'])->name('create');
        Route::post('store', [RestaurantProfileController::class, 'store'])->name('store');
        Route::get('summary', [RestaurantProfileController::class, 'showSummary'])->name('summary');
        Route::get('details/{id}', [RestaurantProfileController::class, 'showRestaurantDetails'])->name('details');
        Route::delete('destroy/{id}', [RestaurantProfileController::class, 'destroy'])->name('destroy');

        // Menu Routes
        Route::get('menu', [RestaurantMenuController::class, 'index'])->name('menu.index');
        Route::get('menu/create', [RestaurantMenuController::class, 'create'])->name('menu.create');
        Route::post('menu', [RestaurantMenuController::class, 'store'])->name('menu.store');
        Route::get('menu/{menu}/edit', [RestaurantMenuController::class, 'edit'])->name('menu.edit');
        Route::put('menu/{menu}', [RestaurantMenuController::class, 'update'])->name('menu.update');
        Route::delete('menu/{menu}', [RestaurantMenuController::class, 'destroy'])->name('menu.destroy');

        // Reservation Routes
        Route::get('reservations', [RestaurantReservationController::class, 'index'])->name('reservation.index');
        Route::post('reservation/{id}/approve', [RestaurantReservationController::class, 'approve'])->name('reservation.approve');
        Route::post('reservation/{id}/cancel', [RestaurantReservationController::class, 'cancel'])->name('reservation.cancel');
        Route::delete('reservation/{id}', [RestaurantReservationController::class, 'destroy'])->name('reservation.destroy');

        // Pre-Order Routes
        Route::get('/restaurant/preorders', [RestaurantPreOrderController::class, 'index'])->name('preorders.index');
        Route::get('/restaurant/preorders/create', [RestaurantPreOrderController::class, 'create'])->name('preorders.create');
        Route::post('/restaurant/preorders', [RestaurantPreOrderController::class, 'store'])->name('preorders.store');
        Route::get('/restaurant/preorders/{id}/edit', [RestaurantPreOrderController::class, 'edit'])->name('preorders.edit');
        Route::put('/restaurant/preorders/{id}', [RestaurantPreOrderController::class, 'update'])->name('preorders.update');
        Route::delete('/restaurant/preorders/{id}', [RestaurantPreOrderController::class, 'destroy'])->name('preorders.destroy');
        Route::get('restaurant/preorder/summary', [RestaurantPreOrderController::class, 'summary'])->name('preorder.summary');
    });
});

// Routes for customers (viewing offers)
Route::get('/customer/offers', [OffersController::class, 'customerIndex'])->name('customer.offers.index');

// Group routes for restaurant management and apply middleware
Route::middleware(['auth:restaurant'])->group(function () {
    Route::get('/restaurant/offers', [OffersController::class, 'restaurantIndex'])->name('restaurant.offers.index');
    Route::get('/restaurant/offers/create', [OffersController::class, 'create'])->name('restaurant.offers.create');
    Route::post('/restaurant/offers', [OffersController::class, 'store'])->name('restaurant.offers.store');
    Route::get('/restaurant/offers/{offer}/edit', [OffersController::class, 'edit'])->name('restaurant.offers.edit');
    Route::put('/restaurant/offers/{offer}', [OffersController::class, 'update'])->name('restaurant.offers.update');
    Route::delete('/restaurant/offers/{offer}', [OffersController::class, 'destroy'])->name('restaurant.offers.destroy');
});

// Additional Routes
Route::get('/restaurant/menu/order', [CustomerMenuController::class, 'orderMenu'])->name('customer.menu.ordermenu');
Route::get('/customer/menu/ordermenu/{restaurantId}', [CustomerMenuController::class, 'orderMenu'])->name('customer.menu.ordermenu');
Route::get('/customer/menu/ordermenu/{restaurantId}/{reservationId}', [CustomerMenuController::class, 'showOrderMenu'])->name('customer.menu.ordermenu');

// Consolidated Customization Routes
Route::prefix('customer/reservations/{reservation_id}/customizations')->name('customer.reservations.customizations.')->group(function () {
    Route::get('/', [CustomizationController::class, 'index'])->name('index');
    Route::get('/create', [CustomizationController::class, 'create'])->name('create');
    Route::post('/', [CustomizationController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [CustomizationController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CustomizationController::class, 'update'])->name('update');
    Route::delete('/{id}', [CustomizationController::class, 'destroy'])->name('destroy');
});

Route::get('/restaurant/customizations/{id}', [CustomizationController::class, 'show'])->name('restaurant.customizations.show');
Route::get('/restaurant/customizations/{reservation}', [CustomizationController::class, 'show'])->name('restaurant.customizations');

// Review Routes
Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/reviews/{restaurantId}', [ReviewController::class, 'show'])->name('reviews.show');
Route::get('restaurants/{id}', [ReviewController::class, 'show'])->name('customer.restaurant.details');


// Payment Routes
// Route to show the payment form
Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment');

// Route to process the payment
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process.payment');


