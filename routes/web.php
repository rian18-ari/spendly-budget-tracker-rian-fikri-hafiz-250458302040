<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\Admin\Budget;
use App\Livewire\Admin\ChartBudget;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\EditBudget;
use App\Livewire\Admin\EditKaryawan;
use App\Livewire\Admin\EditTransaksi;
use App\Livewire\Admin\FormBudget;
use App\Livewire\Admin\FormBudgetMaster;
use App\Livewire\Admin\GantiPassword;
use App\Livewire\Admin\Karyawanlist;
use App\Livewire\Admin\ProfilAdmin;
use App\Livewire\Admin\Tambahkaryawan;
use App\Livewire\Admin\Transaksi as AdminTransaksi;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Verify;
use App\Livewire\Karyawan\ChartKaryawan;
use App\Livewire\Karyawan\Dashboard;
use App\Livewire\Karyawan\FormTransaksi;
use App\Livewire\Karyawan\GantiPassword as KaryawanGantiPassword;
use App\Livewire\Karyawan\Profile;
use App\Livewire\Karyawan\Transaksi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'welcome')->name('home');

// karyawan routes
Route::prefix('karyawan')->middleware(['auth','role:karyawan'])
->group( function(){
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/transaksi', Transaksi::class )->name('transaksi');
    Route::get('/transaksi/create', FormTransaksi::class)->name('transaksi.create');
    Route::get('/chart' , ChartKaryawan::class)->name('chart');
    Route::get('/gantipassword/{id}', KaryawanGantiPassword::class)->name('karyawan.gantipassword');
    Route::get('/profile', Profile::class)->name('karyawan.profile');
});



// admin routes
Route::prefix('admin')->middleware(['auth','role:admin'])
->group( function(){    
    Route::get('/dashboard', AdminDashboard::class)->name('dashboardadmin');
    Route::get('/transaksi', AdminTransaksi::class)->name('transaksiadmin');
    Route::get('/karyawan', Karyawanlist::class)->name('admin.karyawan');
    Route::get('/karyawan/tambah', Tambahkaryawan::class)->name('admin.tambahkaryawan');
    Route::get('/karyawan/edit/{id}', Editkaryawan::class)->name('admin.editkaryawan');
    Route::get('/budget', Budget::class)->name('admin.budget');
    Route::get('/budget/edit/{id}', EditBudget::class)->name('admin.editbudget');
    Route::get('/budget/tambah', FormBudget::class)->name('admin.tambahbudget');
    Route::get('/budget/anggaran', FormBudgetMaster::class)->name('admin.budget_master');
    Route::get('/chart', ChartBudget::class)->name('chartadmin');
    Route::get('/transaksi/edit/{id}', EditTransaksi::class)->name('admin.edittransaksi');
    Route::get('/gantipassword/{id}', GantiPassword::class)->name('admin.gantipassword'); 
    Route::get('/profile', ProfilAdmin::class)->name('admin.profile');
});





Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});
