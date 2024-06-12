<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TypeController;

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
    return view('hotel');
});

// Route::get('/user/{id}', function($id){
//     return 'User '.$id;
// });

// Route::get('/user/{name?}', function($name='_ALL_'){
//     if($name=='_ALL_'){
//         return 'List User';
//     }
//     else{
//         return $name;
//     }
// });

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

Route::resource('hotel', HotelController::class);

Route::resource('transaction', TransactionController::class);

Route::resource('type', TypeController::class);

Route::get('report/availableHotelRooms', [HotelController::class, 'availableHotelRoom'])->name('reportShowHotel');

Route::get('/product/{id}', [ProductController::class, 'show']);

Route::get('report/hotel/avgPriceByHotelType', [HotelController::class, 'avgHotelPrice']);

Route::get('/tampil-produk/{id}', [ProductController::class, 'tampil-produk'])->name('hotel.tampilProduk');

Route::get('hotel/showProduk', [HotelController::class, 'showProduk'])->name('hotel.showProduk');

Route::post('customTypes/getEditForm', [TypeController::class, 'getEditForm'])->name('type.getEditForm');

Route::post('customTypes/getEditFormB', [TypeController::class, 'getEditFormB'])->name('type.getEditFormB');

Route::post('customtype/saveDataTD',[TypeController::class,'saveDataTD'])->name('type.saveDataTD');

Route::post('customcustomer/getEditForm', [CustomerController::class, 'getEditForm'])->name('customer.getEditForm');

Route::post('customcustomer/deleteData', [CustomerController::class, 'deleteData'])->name('customer.deleteData');

Route::post('customproduct/getEditForm', [ProductController::class, 'getEditForm'])->name('product.getEditForm');

Route::post('customproduct/deleteData', [ProductController::class, 'deleteData'])->name('product.deleteData');

Route::post('customtransaction/getEditForm', [TransactionController::class, 'getEditForm'])->name('transaction.getEditForm');

Route::post('customtransaction/deleteData', [TransactionController::class, 'deleteData'])->name('transaction.deleteData');