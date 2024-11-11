<?php

use App\Models\DaftarUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\SkemaController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\HomepageController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DaftarUserController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\PendaftaranController;

Route::middleware([Authenticate::class])->group(function(){
    Route::resource('pasien', PasienController::class);
    Route::resource('daftar', DaftarController::class);
    //projek real
    Route::resource('pendaftaran', PendaftaranController::class);
    Route::resource('peserta', PesertaController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('skema', SkemaController::class);
    Route::resource('transaksi', TransaksiController::class);
    // Route::resource('order', DaftarUser::class);

    //asesi
    // Route::get('order', [PendaftaranController::class, 'create']);

    // Route::get('/', [HomeController::class, 'index'])->name('home');

//pindahkan route data yg perlu hak akses lainya di sini
});

Route::get('/daftar_user/{skema_id}', [DaftarUserController::class, 'create'])->name('daftar_user.create');


// multi user
// Rute untuk admin
// Route::middleware(['role:admin'])->group(function () {
//     Route::resource('skema', SkemaController::class);
//     Route::resource('pendaftaran', PendaftaranController::class);
// });

// // Rute untuk user
// Route::middleware(['role:user'])->group(function () {
//     Route::get('/pendaftaran/create', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
//     Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
// });
// end multi user

Route::get('logout', function(){
    Auth::logout();
    return redirect('/');
});

// Route::get('login', function(){
//     Auth::login();
//     return redirect('/dashboard');
// });

// Route::get('/', function () {
//     return view('app_homepage');
// }); //halamn homepage

Route::resource('/', HomepageController::class); //halamn homepage

Route::get('profile', function () {
    return 'Hello Word';
});


Route::get('dosen', [DosenController::class, 'index']);
Route::get('dosen/tambah', [DosenController::class, 'tambah']);

Route::resource('matakuliah', MatakuliahController::class);
Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('user');
Route::get('/admin/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
