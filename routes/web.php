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

Route::group(['middleware' => ['is_admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::resource('roles', 'App\Http\Controllers\RolesController');
});
