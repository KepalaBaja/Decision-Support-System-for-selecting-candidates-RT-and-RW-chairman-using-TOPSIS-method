<?php

use App\Http\Controllers\CalonController;
use App\Http\Controllers\DataPenilaianController;
use App\Http\Controllers\HitungController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Penilai;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenilaiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidasiController;

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
Auth::routes();
Route::get('/', function () {
    return view('auth.login');
    
});

Route::get('dashboard_user', [App\Http\Controllers\HomeController::class, 'index'])->name('user.dashboard_user');

//Hitung Controller 
Route::get('/pengumanan_hasil_akhir', [HitungController::class, 'data_hasil_akhir_user'])->name('data_hasil_akhir');

//Pendaftaran
Route::get('/pendaftaran_rt_rw',[PendaftaranController::class,'index_user'])->name('pendaftaran_rt_rw');
Route::get('/form_penfataran_rt_rw',[PendaftaranController::class,'create'])->name('pendaftaran_rt_rw.create');
Route::post('/store',[PendaftaranController::class,'store'])->name('pendaftaran_rt_rw.store');
Route::get('/pendaftaran_rt_rw/{id}/edit_berkas', [PendaftaranController::class, 'edit'])->name('pendaftaran_rt_rw.edit');
Route::put('/pendaftaran_rt_rw/{id}', [PendaftaranController::class, 'update_user'])->name('pendaftaran_rt_rw.update_user');
Route::get('pendaftaran_rt_rw/{id}/detail', [PendaftaranController::class, 'detail_user'])->name('pendaftaran_rt_rw.detail_user');
Route::delete('/pendaftaran_rt_rw/{id}',[PendaftaranController::class,'destroy'])->name('pendaftaran_rt_rw.destroy');

//Status Validasi
Route::get('/status_validasi',[CalonController::class, 'index_user'])->name('status_validasi');

Route::prefix('penilai')->group(function () {
    Route::get('/', [Penilai\Auth\LoginController::class, 'loginForm'])->name('penilai.login');
    Route::get('/login', [Penilai\Auth\LoginController::class, 'loginForm'])->name('penilai.login');
    Route::post('/login', [Penilai\Auth\LoginController::class, 'login']);
    Route::post('/logout', [Penilai\Auth\LoginController::class, 'logout'])->name('penilai.logout');

    // Data Penilaian Controller
    Route::middleware(['penilaiMiddle'])->group(function () {
    Route::get('/dashboard_penilai',[Penilai\HomeController::class,'index'])->name('penilai.dashboard_penilai');
        Route::get('/data_penilaian', [DataPenilaianController::class, 'index_penilai'])->name('penilai.data_penilaian.index');
        Route::get('/data_penilaian/create', [DataPenilaianController::class, 'create_penilai'])->name('penilai.data_penilaian.create');
        Route::post('/data_penilaian', [DataPenilaianController::class, 'store_penilai'])->name('penilai.data_penilaian.store');
        Route::get('/data_penilaian/{id_calon}/{id_kriteria}/{penilai_id}/edit', [DataPenilaianController::class, 'edit_penilai'])->name('penilai.data_penilaian.edit');
        Route::put('/data_penilaian/{nilai_id}', [DataPenilaianController::class, 'update_penilai'])->name('penilai.data_penilaian.update_penilai');
    });

    Route::get('/data_perhitungan', [HitungController::class, 'data_perhitungan_penilai'])->name('penilai.data_perhitungan');
    Route::get('/data_hasil_akhir', [HitungController::class, 'data_hasil_akhir_penilai'])->name('penilai.data_hasil_akhir');

});

Route::prefix('administrator')->group(function(){
    Route::get('/',[Admin\Auth\LoginController::class,'loginForm']);
    Route::get('/login',[Admin\Auth\LoginController::class,'loginForm'])->name('administrator.login');
    Route::post('/login',[Admin\Auth\LoginController::class,'login'])->name('administrator.login');
    Route::get('/dashboard_admin',[Admin\HomeController::class,'index'])->name('administrator.dashboard_admin');
    Route::post('/logout',[Admin\Auth\LoginController::class,'logout'])->name('administrator.logout');

    //Kriteria Controller
    Route::resource('kelola_kriteria', KriteriaController::class);

    //Calon Controller
    Route::resource('kelola_calon', CalonController::class);

    //Validasi
    Route::get('/validasi_calon', [ValidasiController::class, 'index'])->name('administrator.validasi_calon.index');
    Route::get('/proses_validasi/accept/{calon_id}', [ValidasiController::class, 'accept'])->name('administrator.proses_validasi.accept');
    Route::get('/proses_validasi/reject/{calon_id}', [ValidasiController::class, 'reject'])->name('administrator.proses_validasi.reject');
    Route::get('/data_hasil_akhir/terbitkan', [ValidasiController::class, 'terbitkan'])->name('administrator.data_hasil_akhir.terbitkan');
    Route::get('/data_hasil_akhir/tarik_terbitkan', [ValidasiController::class, 'tarik_terbitkan'])->name('administrator.data_hasil_akhir.tarik_terbitkan');

    //DataPenilaian Controller
    // Route::resource('data_penilaian', DataPenilaianController::class);
    Route::get('data_penilaian', [DataPenilaianController::class, 'index'])->name('administrator.data_penilaian.index');
    // Route::get('data_penilaian/{id_calon}/{id_kriteria}/edit', [DataPenilaianController::class, 'edit'])->name('administrator.data_penilaian.edit');

    //Hitung Controller 
    Route::get('/data_perhitungan', [HitungController::class, 'data_perhitungan'])->name('administrator.data_perhitungan');
    Route::get('/data_hasil_akhir', [HitungController::class, 'data_hasil_akhir'])->name('administrator.data_hasil_akhir');
    Route::get('/cetak-pdf', [HitungController::class, 'cetakPDF'])->name('administrator.cetakPDF');

    //DataPendaftaran Controller
    Route::get('/data_pendaftaran_rt_rw',[PendaftaranController::class,'index'])->name('administrator.data_pendaftaran_rt_rw');
    Route::put('/data_pendaftaran_rt_rw/{id}', [PendaftaranController::class, 'update'])->name('administrator.data_pendaftaran_rt_rw.update');
    Route::get('data_pendaftaran_rt_rw/{id}/detail', [PendaftaranController::class, 'detail'])->name('administrator.data_pendaftaran_rt_rw.detail');

    //Admin Controller
    Route::get('/manajemen_akun/kelola_admin', [AdminController::class, 'index'])->name('administrator.manajemen_akun/kelola_admin');
    Route::get('/manajemen_akun/kelola_admin/create', [AdminController::class, 'create'])->name('administrator.manajemen_akun/kelola_admin.create');
    Route::post('/manajemen_akun/kelola_admin', [AdminController::class, 'store'])->name('administrator.manajemen_akun/kelola_admin.store');
    Route::get('/manajemen_akun/kelola_admin/{id}', [AdminController::class, 'show'])->name('administrator.manajemen_akun/kelola_admin.show');
    Route::get('/manajemen_akun/kelola_admin/{id}/edit', [AdminController::class, 'edit'])->name('administrator.manajemen_akun/kelola_admin.edit');
    Route::put('/manajemen_akun/kelola_admin/{id}', [AdminController::class, 'update'])->name('administrator.manajemen_akun/kelola_admin.update');
    Route::delete('/manajemen_akun/kelola_admin/{id}', [AdminController::class, 'destroy'])->name('administrator.manajemen_akun/kelola_admin.destroy');

    //Penilai Controller
    Route::get('/manajemen_akun/kelola_penilai', [PenilaiController::class, 'index'])->name('administrator.manajemen_akun/kelola_penilai');
    Route::get('/manajemen_akun/kelola_penilai/create', [PenilaiController::class, 'create'])->name('administrator.manajemen_akun/kelola_penilai.create');
    Route::post('/manajemen_akun/kelola_penilai', [PenilaiController::class, 'store'])->name('administrator.manajemen_akun/kelola_penilai.store');
    Route::get('/manajemen_akun/kelola_penilai/{id}', [PenilaiController::class, 'show'])->name('administrator.manajemen_akun/kelola_penilai.show');
    Route::get('/manajemen_akun/kelola_penilai/{id}/edit', [PenilaiController::class, 'edit'])->name('administrator.manajemen_akun/kelola_penilai.edit');
    Route::put('/manajemen_akun/kelola_penilai/{id}', [PenilaiController::class, 'update'])->name('administrator.manajemen_akun/kelola_penilai.update');
    Route::delete('/manajemen_akun/kelola_penilai/{id}', [PenilaiController::class, 'destroy'])->name('administrator.manajemen_akun/kelola_penilai.destroy');

    //User Controller
    Route::get('/manajemen_akun/kelola_user', [UserController::class, 'index'])->name('administrator.manajemen_akun/kelola_user');
    Route::get('/manajemen_akun/kelola_user/create', [UserController::class, 'create'])->name('administrator.manajemen_akun/kelola_user.create');
    Route::post('/manajemen_akun/kelola_user', [UserController::class, 'store'])->name('administrator.manajemen_akun/kelola_user.store');
    Route::get('/manajemen_akun/kelola_user/{id}', [UserController::class, 'show'])->name('administrator.manajemen_akun/kelola_user.show');
    Route::get('/manajemen_akun/kelola_user/{id}/edit', [UserController::class, 'edit'])->name('administrator.manajemen_akun/kelola_user.edit');
    Route::put('/manajemen_akun/kelola_user/{id}', [UserController::class, 'update'])->name('administrator.manajemen_akun/kelola_user.update');
    Route::delete('/manajemen_akun/kelola_user/{id}', [UserController::class, 'destroy'])->name('administrator.manajemen_akun/kelola_user.destroy');
}); 