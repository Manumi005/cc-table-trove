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
use Illuminate\Support\Facades\Route;

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
    });

    // Restaurant Routes
        Route::get('restaurants', [CustomerController::class, 'listRestaurants'])->name('restaurants');
        Route::get('restaurant/{id}', [CustomerController::class, 'showRestaurant'])->name('restaurant.details');
        Route::get('restaurant/{id}/menu', [CustomerMenuController::class, 'show'])->name('restaurant.menu');
        Route::post('/filter-menu', [CustomerMenuController::class, 'filter'])->name('filter-menu');
        Route::post('/customer/menu/add', [CustomerMenuController::class, 'add'])->name('customer.menu.add');
    });
   
    Route::get('/pre-order', function () {
        return view('pre-order');
    });
    
    Route::post('/submit-order', function (Illuminate\Http\Request $request) {
        // Handle order submission
        // You can save the order to the database or perform other actions
        return response()->json(['success' => true]);
    });


Route::get('/preorders', [PreOrderController::class, 'index'])->name('preorders.index');
Route::get('/preorders/create', [PreOrderController::class, 'create'])->name('preorders.create');
Route::post('/preorders', [PreOrderController::class, 'store'])->name('preorders.store');
Route::get('/preorders/{id}/edit', [PreOrderController::class, 'edit'])->name('preorders.edit');
Route::put('/preorders/{id}', [PreOrderController::class, 'update'])->name('preorders.update');
Route::delete('/preorders/{id}', [PreOrderController::class, 'destroy'])->name('preorders.destroy');
Route::get('/preorder/summary', [PreOrderController::class, 'summary'])->name('preorder.summary');
Route::post('/submit-preorder', [PreOrderController::class, 'submitPreOrder'])->name('submit.preorder');


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
