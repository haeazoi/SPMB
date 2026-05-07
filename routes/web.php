<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cobaController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\JalurController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\BajuController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\daftarController;
use App\Http\Controllers\pembayaranController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\undanganController;
use App\Http\Controllers\prestasiController;
use App\Http\Controllers\regulerController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\OrangTuaController;


Route::get('/', function () {
    return view('siswa.main');
});

Route::get('/jalur_pendaftaran', [JalurController::class, "jalur"]);
Route::get('/pendaftaran', [PendaftaranController::class, "index"])->name('pendaftaran.index');
Route::post('/pendaftaran', [PendaftaranController::class, "store"])->name('pendaftaran.store');
Route::get('/pendaftaran/sukses', [PendaftaranController::class, 'sukses'])->name('pendaftaran.sukses');

Route::get('/daftar', [daftarController::class, "index"])->name('daftar.index');
Route::post('/daftar', [daftarController::class, "store"])->name('daftar.store');
Route::get('/daftar/sukses', [daftarController::class, 'sukses'])->name('daftar.sukses');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::get('/login/tu', [loginController::class, "TU"])->name('login.tu');
Route::get('/login/siswa', [loginController::class, "siswa"])->name('login.siswa');
Route::post('/login', [loginController::class, "login_process"]);

 Route::get('/daftar_ulang_info', [daftarController::class, "ulang"]);

Route::group(['middleware' => 'auth:web,pendaftar'], function () {
    Route::get('/logout', [loginController::class, 'logout']);

    Route::group(['middleware' => 'checkrole:tu'], function () {
        Route::get('/tu/dashboard', [cobaController::class, "index"]);

        Route::get('/info', [InfoController::class, "info"]);
        Route::get('/jurusan', [JurusanController::class, 'jurusan']);
        Route::get('/jalur', [JalurController::class, 'jalurTU']);
        Route::get('/baju', [BajuController::class, "baju"]);

        Route::get('/siswa', [SiswaController::class, "index"]);
        Route::get('/detail/{id}/siswa', [SiswaController::class, "show"]);

        Route::get('/orangtua', [OrangTuaController::class, "index"]);
        Route::get('/detail/{id}/orangtua', [OrangTuaController::class, "show"]);

        Route::get('/undangan', [undanganController::class, "index"]);
        Route::post('/undangan/{id}/Terverifikasi', [undanganController::class, "update"]);
        Route::post('/undangan/{id}/Ditolak', [undanganController::class, "reject"]);
        Route::get('/pembayaran/undangan', [undanganController::class, "bayar"]);
        Route::put('/pembayaran/undangan/update/{id}', [undanganController::class, 'updateBayar'])->name('pembayaran.undangan.update');
        Route::post('/pembayaran/undangan/reject/{id}', [undanganController::class, 'rejectBayar'])->name('pembayaran.undangan.reject');

        Route::get('/prestasi', [prestasiController::class, "index"]);
        Route::post('/prestasi/{id}/Terverifikasi', [prestasiController::class, "update"]);
        Route::post('/prestasi/{id}/Ditolak', [prestasiController::class, "reject"]);
        Route::get('/pembayaran/prestasi', [prestasiController::class, "bayar"]);
        Route::put('/pembayaran/prestasi/update/{id}', [prestasiController::class, 'updateBayar'])->name('pembayaran.prestasi.update');
        Route::post('/pembayaran/prestasi/reject/{id}', [prestasiController::class, 'rejectBayar'])->name('pembayaran.prestasi.reject');

        Route::get('/reguler', [regulerController::class, "index"]);
        Route::post('/reguler/{id}/Terverifikasi', [regulerController::class, "update"]);
        Route::post('/reguler/{id}/Ditolak', [regulerController::class, "reject"]);
        Route::get('/pembayaran/reguler', [regulerController::class, "bayar"]);
        Route::put('/pembayaran/reguler/update/{id}', [regulerController::class, 'updateBayar'])->name('pembayaran.reguler.update');
        Route::post('/pembayaran/reguler/reject/{id}', [regulerController::class, 'rejectBayar'])->name('pembayaran.reguler.reject');
    });

    Route::group(['middleware' => 'checkrole:siswa'], function () {

        Route::get('/status_pendaftaran', [pembayaranController::class, "index"])->name('status.pendaftaran');
        Route::get('/hasil_pendaftar', [pembayaranController::class, "pembayaran"])->name('hasil.pendaftaran');
        Route::post('/bayar', [pembayaranController::class, "store"])->name('pembayaran');
        Route::get('/daftar_ulang', [pembayaranController::class, "formDaftarUlang"])->name('daftar_ulang.form');
        Route::post('/daftar_ulang', [pembayaranController::class, "submitDaftarUlang"])->name('daftar_ulang.submit');


    });

    Route::group(['middleware' => 'checkrole:superadmin'], function () {
        Route::get('/superadmin/dashboard', [SuperadminController::class, 'index']);
        Route::get('/management_user', [SuperadminController::class, 'show'])->name('user.index');
        Route::post('/management_user', [SuperadminController::class, 'store'])->name('user.store');
        Route::put('/management_user/{id}', [SuperadminController::class, 'update'])->name('user.update');
        Route::delete('/management_user/{id}', [SuperadminController::class, 'destroy'])->name('user.destroy');

        Route::get('superadmin/info', [InfoController::class, "index"]);
        Route::post('superadmin/info', [InfoController::class, "store"]);
        Route::put('superadmin/info/{id}', [InfoController::class, 'update'])->name('info.update');
        Route::delete('superadmin/info/{id}', [InfoController::class, 'destroy'])->name('info.destroy');

        Route::get('superadmin/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
        Route::post('superadmin/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
        Route::put('superadmin/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
        Route::delete('superadmin/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');

        Route::get('superadmin/jalur', [JalurController::class, 'index'])->name('jalur.index');
        Route::post('superadmin/jalur', [JalurController::class, 'store'])->name('jalur.store');
        Route::put('superadmin/jalur/{id}', [JalurController::class, 'update'])->name('jalur.update');
        Route::delete('superadmin/jalur/{id}', [JalurController::class, 'destroy'])->name('jalur.destroy');

        Route::get('superadmin/baju', [BajuController::class, "index"]);
        Route::post('superadmin/baju', [BajuController::class, "store"]);
        Route::put('superadmin/baju/{id}', [BajuController::class, 'update'])->name('baju.update');
        Route::delete('superadmin/baju/{id}', [BajuController::class, 'destroy'])->name('baju.destroy');

        Route::get('superadmin/undangan', [undanganController::class, "undangan"]);
        Route::get('superadmin/pembayaran/undangan', [undanganController::class, "bayarUndangan"]);
        Route::get('superadmin/prestasi', [prestasiController::class, "prestasi"]);
        Route::get('superadmin/pembayaran/prestasi', [prestasiController::class, "bayarPrestasi"]);
        Route::get('superadmin/reguler', [regulerController::class, "reguler"]);
        Route::get('superadmin/pembayaran/reguler', [regulerController::class, "bayarReguler"]);

        Route::get('superadmin/siswa', [SiswaController::class, "indexAdmin"]);
        Route::get('superadmin/detail/{id}/siswa', [SiswaController::class, "showAdmin"]);

        Route::get('superadmin/orangtua', [OrangTuaController::class, "indexAdmin"]);
        Route::get('superadmin/detail/{id}/orangtua', [OrangTuaController::class, "showAdmin"]);
    });
});
