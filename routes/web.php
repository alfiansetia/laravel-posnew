<?php

use App\Http\Controllers\AdjustmentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes([
    'register' => false, // Routes of Registration
    'reset' => false,    // Routes of Password Reset
    'verify' => false,   // Routes of Email Verification
]);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::group(['middleware' => ['active']], function () {

        Route::get('/setting/profile', [SettingController::class, 'profile'])->name('setting.profile');
        Route::post('/setting/profile', [SettingController::class, 'profileUpdate'])->name('setting.profile.update');
        Route::get('/setting/password', [SettingController::class, 'password'])->name('setting.password');
        Route::post('/setting/password', [SettingController::class, 'passwordUpdate'])->name('setting.password.update');

        Route::get('/categories/paginate', [CategoryController::class, 'paginate'])->name('category.paginate');
        Route::resource('/category', CategoryController::class);

        Route::get('/suppliers/paginate', [SupplierController::class, 'paginate'])->name('supplier.paginate');
        Route::resource('/supplier', SupplierController::class);

        Route::get('/products/paginate', [ProductController::class, 'paginate'])->name('product.paginate');
        Route::resource('/product', ProductController::class);

        Route::get('/customers/paginate', [CustomerController::class, 'paginate'])->name('customer.paginate');
        Route::resource('/customer', CustomerController::class);

        Route::resource('/sale', SaleController::class);
        Route::resource('/adjustment', AdjustmentController::class);

        Route::delete('/carts/truncate', [CartController::class, 'truncate'])->name('cart.truncate');
        Route::resource('/cart', CartController::class);

        Route::group(['middleware' => ['admin']], function () {
            Route::get('/setting/company', [SettingController::class, 'company'])->name('setting.company');
            Route::post('/setting/company', [SettingController::class, 'companyUpdate'])->name('setting.company.update');

            Route::resource('/user', UserController::class);
        });
    });
});
