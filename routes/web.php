<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SanphamController;
Route::get('/', [SanPhamController::class,'index']);
Route::get('/sp/{id}', [SanPhamController::class,'chitiet']);
Route::get('/loai/{id}', [SanPhamController::class,'sptrongloai']);
Route::get('/thongbao', function(){ return view('thongbao'); });
Route::post('/luubinhluan', [SanPhamController::class,'luubinhluan']);
Route::get('/themvaogio/{idsp}/{soluong?}', [SanPhamController::class,'themvaogio']);
Route::get('/hiengiohang', [SanPhamController::class,'hiengiohang']);
Route::get('/xoasptronggio/{idsp}', [SanPhamController::class,'xoasptronggio']);
Route::post('/hiengiohang', [SanPhamController::class,'thanhtoan']);


use App\Http\Controllers\AdminLoaiController;
use App\Http\Controllers\AdminSPController;
Route::group(['prefix' => 'admin', ], function() {
    Route::resource('loai', AdminLoaiController::class); 
    Route::resource('sanpham', AdminSPController::class);
});
