<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterMahasiswaController;
use App\Http\Controllers\RegisterDosenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalKelasController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\JadwalKelasContoller;


// 🏠 Home Page
// Route::get('/', function () {
//     return view('welcome');
// });

// 🔐 Auth
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 📝 Register Mahasiswa & Dosen
Route::get('/register-mahasiswa', [RegisterMahasiswaController::class, 'showRegisterForm'])->name('register.mahasiswa');
Route::post('/register-mahasiswa', [RegisterMahasiswaController::class, 'register']);

Route::get('/register-dosen', [RegisterDosenController::class, 'showRegisterForm'])->name('register.dosen');
Route::post('/register-dosen', [RegisterDosenController::class, 'register']);

// 📊 Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Route::middleware(['auth', 'isMahasiswa'])->get('/dashboard/mahasiswa', [DashboardController::class, 'mahasiswaDashboard'])->name('dashboard.mahasiswa');

Route::middleware(['auth', 'isDosen'])->get('/dashboard/dosen', [DashboardController::class, 'dosenDashboard'])->name('dashboard.dosen');

// 👨‍🏫 Dosen: Manage Jadwal Kelas
Route::middleware(['auth', 'isDosen'])->group(function () {
    Route::resource('/jadwal-kelas', JadwalKelasController::class);
    Route::get('/rekap-absensi/{jadwal}', [AbsensiController::class, 'rekap'])->name('rekap.absensi');

});

Route::middleware(['auth', 'isMahasiswa'])->group(function () {
    Route::get('/dashboard/mahasiswa', [DashboardController::class, 'mahasiswaDashboard'])->name('dashboard.mahasiswa');

    Route::get('/absensi/form-input/{jadwalId}', [AbsensiController::class, 'formInput'])->name('absensi.form');
    Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');

    Route::get('/rekap-absensi-mahasiswa', [AbsensiController::class, 'index'])->name('absensi.rekap.mahasiswa');
});


// Route::get('/rekap-absensi/{jadwalId}', [AbsensiController::class, 'rekap'])->middleware(['auth', 'isDosen'])->name('absensi.rekap');
// Route::middleware(['auth', 'isMahasiswa'])->get('/absensi/form-input/{jadwalId}', [AbsensiController::class, 'formInput'])->name('absensi.form');


Route::put('/jadwal/update-inline/{id}', [JadwalKelasController::class, 'updateInline'])->name('jadwal.update.inline');


// 🎓 Mahasiswa: Absensi & Rekap
Route::middleware(['auth', 'isMahasiswa'])->group(function () {
    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');
});

Route::get('/register', function() {
    return view('register.choice');
})->name('register.choice');



