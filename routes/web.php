<?php
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiDetailController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\ForgotPasswordController;
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
Route::get('/',[LoginController::class,'index'])->name('login');
Route::post('/login-proses',[LoginController::class,'login_proses'])->name('login-proses');
Route::get('/forgot_password',[LoginController::class,'forgot_password'])->name('forgot_password');

Route::post('/forgot_password_act',[LoginController::class,'forgot_password_act'])->name('forgot_password_act');

Route::get('/validasi_forgot_password/{token}',[LoginController::class,'validasi_forgot_password'])->name('validasi_forgot_password');
Route::post('/validasi_forgot_password_act',[LoginController::class,'validasi_forgot_password_act'])->name('validasi_forgot_password_act');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses',[LoginController::class,'register_proses'])->name('register-proses');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'userAkses:admin'], 'prefix' => 'admin'], function(){

    Route::get('/kategori',[KategoriController::class,'index'])->name('kategori');
    Route::get('/kategori/create',[KategoriController::class,'create'])->name('kategori.create');
    Route::post('/kategori/store',[KategoriController::class,'store'])->name('kategori.store');
    Route::get('/kategori/edit/{id}',[KategoriController::class,'edit'])->name('kategori.edit');
    Route::put('/kategori/update/{id}',[KategoriController::class,'update'])->name('kategori.update');
    Route::delete('/kategori/destroy/{id}',[KategoriController::class,'destroy'])->name('kategori.destroy');

    Route::get('/produk',[ProdukController::class,'index'])->name('produk');
    Route::get('/produk/create',[ProdukController::class,'create'])->name('produk.create');
    Route::post('/produk/store',[ProdukController::class,'store'])->name('produk.store');
    Route::get('/produk/edit/{id}',[ProdukController::class,'edit'])->name('produk.edit');
    Route::put('/produk/update/{id}',[ProdukController::class,'update'])->name('produk.update');
    Route::delete('/produk/destroy/{id}',[ProdukController::class,'destroy'])->name('produk.destroy');

    Route::get('riwayat/index',[RiwayatController::class,'index'])->name('riwayat');    
    Route::post('/riwayat/print', [RiwayatController::class, 'print'])->name('riwayat.print');
    Route::get('/riwayat/pdf', [RiwayatController::class, 'generatePDF'])->name('riwayat.pdf'); 
    Route::delete('riwayat/destroy/{id}',[RiwayatController::class,'destroy'])->name('riwayat.destroy');

    Route::get('/layout/dashboard',[HomeController::class,'dashboard'])->name('dashboard');
    Route::get('/user',[HomeController::class,'index'])->name('index');
    Route::get('/create',[HomeController::class,'create'])->name('user.create');
    Route::post('/store',[HomeController::class,'store'])->name('user.store');
    Route::get('/edit/{id}',[HomeController::class,'edit'])->name('user.edit');
    Route::put('/update/{id}',[HomeController::class,'update'])->name('user.update');
    Route::delete('/delete/{id}',[HomeController::class,'delete'])->name('user.delete');
});

Route::group(['middleware' => ['auth', 'userAkses:karyawan'],'prefix' => 'kasir'], function(){

Route::get('/transaksi',[TransaksiController::class,'index'])->name('transaksi');   
Route::get('transaksi/create',[TransaksiController::class,'create'])->name('transaksi.create');
Route::post('transaksi/store',[TransaksiController::class,'store'])->name('transaksi.store');

Route::get('index/{id}',[TransaksiController::class,'invoice'])->name('invoice');
Route::get('transaksi/edit/{id}',[TransaksiController::class,'edit'])->name('transaksi.edit');
Route::put('transaksi/update/{id}',[TransaksiController::class,'update'])->name('transaksi.update');
Route::delete('transaksi/destroy/{id}',[TransaksiController::class,'destroy'])->name('transaksi.destroy');
Route::get('transaksi/lanjutkan/{id}', [TransaksiController::class, 'lanjutkan'])->name('transaksi.lanjutkan');

Route::get('/transaksidetail',[TransaksiDetailController::class,'index'])->name('transaksidetail');
Route::post('transaksidetail/create',[TransaksiDetailController::class,'create'])->name('transaksidetail.create');
Route::get('transaksidetail/selesai/{id}',[TransaksiDetailController::class,'selesai'])->name('transaksidetail.selesai');
Route::post('transaksidetail/store',[TransaksiDetailController::class,'store'])->name('transaksidetail.store');
Route::get('/admin/transaksidetail/edit/{id}', [TransaksiDetailController::class, 'edit'])->name('admin.transaksi.edit');
Route::put('transaksidetail/update/{id}',[TransaksiDetailController::class,'update'])->name('transaksidetail.update');
Route::delete('/transaksidetail/delete/{id}', [TransaksiDetailController::class, 'delete'])->name('transaksidetail.delete');


// routes/web.php
Route::post('invoice/print/{id}', [TransaksiController::class,'print_invoice'])->name('print.invoice');

});
