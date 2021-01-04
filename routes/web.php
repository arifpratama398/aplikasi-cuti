<?php

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

Route::redirect('/', '/login');

Auth::routes();

Route::get('/admin/home', 'App\Http\Controllers\HomeController@adminHome')->name('admin.home')->middleware('is_admin');
Route::get('/admin/cuti', 'App\Http\Controllers\HomeController@adminCuti')->name('admin.cuti.home')->middleware('is_admin');
Route::get('/cuti/destroy/{id}', 'App\Http\Controllers\HomeController@deleteCuti')->name('admin.delete')->middleware('is_admin');
Route::get('/cuti/accept/{id}', 'App\Http\Controllers\HomeController@acceptCuti')->name('admin.accept')->middleware('is_admin');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('is_user');
Route::get('/pengajuan',[App\Http\Controllers\HomeController::class, 'addcuti'])->name('pengajuan')->middleware('is_user');
Route::post('/pengajuan',[App\Http\Controllers\HomeController::class, 'store_cuti'])->name('pengajuan')->middleware('is_user');
Route::post('/pendaftaran',[App\Http\Controllers\HomeController::class, 'store_user'])->name('pendaftaran')->middleware('is_admin');
Route::get('/users/destroy/{id}', 'App\Http\Controllers\HomeController@deleteUser')->name('admin.deleteUser')->middleware('is_admin');
Route::get('/users/edit/{id}', 'App\Http\Controllers\HomeController@editUser')->name('admin.editUser')->middleware('is_admin');
Route::post('/update/user',[App\Http\Controllers\HomeController::class, 'updateUser'])->name('updateUser')->middleware('is_admin');

// Add profile page for all user
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('user.profile');
Route::resource('karyawan', 'App\Http\Controllers\KaryawanController');

// Define manajemen cuti 
// TODO - Refactor this
Route::resource('cuti', 'App\Http\Controllers\CutiController');
Route::get('/hrd/cuti/action/{id}/{action}', 'App\Http\Controllers\CutiController@hrdAction')->name('hrd.cuti.action');
Route::get('/manager/cuti/action/{id}/{action}', 'App\Http\Controllers\CutiController@managerAction')->name('manager.cuti.action');

Route::group(['middleware' => ['is_admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', 'App\Http\Controllers\DashboardController@dashboard')->name('dashboard');
    Route::resource('users', 'App\Http\Controllers\UsersController');
    Route::resource('roles', 'App\Http\Controllers\RolesController');
    Route::resource('karyawan', 'App\Http\Controllers\KaryawanController');

    // Datamaster
    Route::group(['prefix' => 'datamaster'], function () {
        Route::get('list', 'App\Http\Controllers\DataMasterController@list')
            ->name('datamaster.list');
        Route::get('detail/{name}', 'App\Http\Controllers\DataMasterController@detail')
            ->name('datamaster.detail');
        Route::post('store/{name}', 'App\Http\Controllers\DataMasterController@store')
            ->name('datamaster.store');
        Route::put('store/{name}', 'App\Http\Controllers\DataMasterController@update')
            ->name('datamaster.update');
        Route::delete('store/{name}', 'App\Http\Controllers\DataMasterController@destroy')
            ->name('datamaster.destroy');
    });    
    //Autocomple ADMIN
    Route::group(['prefix' => 'autocomplete'], function () {
        Route::get('agama', 'App\Http\Controllers\AutocompleteController@agama');
    });
});
