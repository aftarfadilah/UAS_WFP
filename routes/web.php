<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\HotelTypeController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontEndController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('/auth/login');
});

Route::get('/hotel', function(){
    return view('hotel');
});

Route::get('/kategori/{type?}', function($type=''){
    if($type=='single'){
        #Memanggil kategori hotel bertipe single
        return view('hotel',['kategori' => $type]);
    }
    elseif($type=='single-semi-double'){
        #Memanggil kategori hotel bertipe single semi double
        return view('hotel',['kategori' => $type]);
    }
    elseif($type=='standard-double'){
        #Memanggil kategori hotel bertipe standard double
        return view('hotel',['kategori' => $type]);
    }
    else{
        return view('hotel',['kategori' => $type]);
    }
});

Route::get('/promo/{jenis}', function($jenis){
    if($jenis =='promo-ramadhan'){
        return 'Deskripsi Detail promo Promo-sRamadhan';
    }
});

Route::middleware(['auth'])->group(function () {
    // Hotel
    Route::resource('hotel', HotelController::class);
    Route::get('report/availableHotelRooms', [HotelController::class, 'availableHotelRoom'])->name('reportShowHotel');
    Route::delete('/hotel/{hotel}', [HotelController::class, 'destroy'])->name('hotel.destroy');

    Route::get('hotel/uploadLogo/{hotel_id}', [HotelController::class, 'uploadLogo']);
    Route::post('hotel/simpanLogo', [HotelController::class, 'simpanLogo']);

    Route::resource('hoteltype', HotelTypeController::class, [
        'names' => [
            'index' => 'hotel.type.index',
            'create' => 'hotel.type.create',
            'store' => 'hotel.type.store',
            'show' => 'hotel.type.show',
            'edit' => 'hotel.type.edit',
            'update' => 'hotel.type.update',
            'destroy' => 'hotel.type.destroy'
        ]
    ]);
    Route::post('hoteltype/deleteData', [HotelTypeController::class, 'deleteData'])->name('hotel.type.deleteData');
    Route::post('hoteltype/getEditForm', [HotelTypeController::class, 'getEditForm'])->name('hotel.type.getEditForm');
    Route::post('hoteltype/saveDataTD', [HotelTypeController::class, 'saveDataTD'])->name('hotel.type.saveDataTD');

    // Transaction
    Route::resource('transaction', TransactionController::class);
    Route::post('customtransaction/getEditForm', [TransactionController::class, 'getEditForm'])->name('transaction.getEditForm');
    Route::post('customtransaction/deleteData', [TransactionController::class, 'deleteData'])->name('transaction.deleteData');

    // Product
    Route::resource('product', ProductController::class, [
        'names' => [
            'index' => 'product.index',
            'create' => 'product.create',
            'store' => 'product.store',
            'show' => 'product.show',
            'edit' => 'product.edit',
            'update' => 'product.update',
            'destroy' => 'product.destroy'
        ]
    ]);
    Route::get('product/uploadPhoto/{product_id}', [ProductController::class, 'uploadPhoto']);
    Route::post('product/simpanPhoto', [ProductController::class, 'simpanPhoto']);
    Route::post('product/delPhoto', [ProductController::class, 'delPhoto']);
    Route::post('customproduct/getEditForm', [ProductController::class, 'getEditForm'])->name('product.getEditForm');
    Route::post('customproduct/deleteData', [ProductController::class, 'deleteData'])->name('product.deleteData');
    Route::get('/tampil-produk/{id}', [ProductController::class, 'tampil-produk'])->name('product.tampilProduk');

    // Product Type
    Route::resource('producttype', ProductTypeController::class, [
        'names' => [
            'index' => 'product.type.index',
            'create' => 'product.type.create',
            'store' => 'product.type.store',
            'show' => 'product.type.show',
            'edit' => 'product.type.edit',
            'update' => 'product.type.update',
            'destroy' => 'product.type.destroy'
        ]
    ]);
    Route::post('producttype/deleteData', [ProductTypeController::class, 'deleteData'])->name('product.type.deleteData');
    Route::post('producttype/getEditForm', [ProductTypeController::class, 'getEditForm'])->name('product.type.getEditForm');
    Route::post('producttype/saveDataTD', [ProductTypeController::class, 'saveDataTD'])->name('product.type.saveDataTD');

    // Facilities
    Route::resource('facilities', FacilityController::class, [
        'names' => [
            'index' => 'facilities.index',
            'create' => 'facilities.create',
            'store' => 'facilities.store',
            'show' => 'facilities.show',
            'edit' => 'facilities.edit',
            'update' => 'facilities.update',
            'destroy' => 'facilities.destroy'
        ]
    ]);

    // Customer
    Route::resource('users', UserController::class, [
        'names' => [
            'index' => 'users.index',
            'create' => 'users.create',
            'store' => 'users.store',
            'show' => 'users.show',
            'edit' => 'users.edit',
            'update' => 'users.update',
            'destroy' => 'users.destroy'
        ]
    ]);
    Route::post('users/getEditForm', [UserController::class, 'getEditForm'])->name('users.getEditForm');
    Route::post('users/deleteData', [UserController::class, 'deleteData'])->name('users.deleteData');

});

Route::get('/laralux', [FrontEndController::class, 'index'])->name('laralux.index');
Route::get('/laralux/{laralux}', [FrontEndController::class, 'show'])->name('laralux.show');

Route::middleware(['auth'])->group(function () {
    Route::get('laralux/user/cart', [FrontEndController::class, 'cart'])->name('cart');
    Route::get('laralux/cart/add/{id}', [FrontEndController::class, 'addToCart'])->name('addCart');
    Route::get('laralux/cart/delete/{id}', [FrontEndController::class, 'deleteFromCart'])->name('delFromCart');

    Route::post('laralux/cart/addQty', [FrontEndController::class, 'addQuantity'])->name('addQty');
    Route::post('laralux/cart/reduceQty', [FrontEndController::class, 'reduceQuantity'])->name('redQty');
    Route::get('laralux/cart/checkout', [FrontEndController::class, 'checkout'])->name('checkout');
});
Route::get('report/hotel/avgPriceByHotelType', [HotelController::class, 'avgHotelPrice']);


Route::get('hotel/showProduk', [HotelController::class, 'showProduk'])->name('hotel.showProduk');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

