<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ModalController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/loginform', 'HomeController@loginform');

//home
Route::get('/', [LoginController::class, 'index'])->name('login.form');
Route::get('/redirection', 'HomeController@redirection')->name('redirection');

// Route::get('/', 'SkklController@create')->middleware('auth');
Route::group(['middleware' => ['auth', 'cekRole:Pemrakarsa,Operator']], function() {
    Route::get('/Pemrakarsa', 'HomeController@index')->name('pemrakarsa.index');
    Route::get('/Pemrakarsa/skkl/form', 'SkklController@create')->name('skkl.create');
    Route::get('/Pemrakarsa/skkl/edit/{id}', 'SkklController@edit')->name('skkl.edit');
    Route::post('/Pemrakarsa/skkl/create', 'SkklController@store')->name('skkl.store');
    Route::put('/Pemrakarsa/skkl/update/{id}', 'SkklController@update')->name('skkl.update');
    
    //rkl
    Route::get('/Pemrakarsa/rkl/create/{id}', 'RklController@create')->name('rkl.create');
    Route::post('/Pemrakarsa/rkl/delete/{id}', 'RklController@delete')->name('rkl.delete');
    Route::get('/Pemrakarsa/rkl/ubah/{id}', 'RklController@ubah')->name('rkl.ubah');
    Route::post('/Pemrakarsa/rkl/update/{id}', 'RklController@update')->name('rkl.update');
    Route::post('/Pemrakarsa/rkl', 'RklController@store_rkl')->name('rkl.store_rkl');

    //rpl
    Route::get('/Pemrakarsa/rpl/create/{id}', 'RplController@create')->name('rpl.create');
    Route::post('/Pemrakarsa/rpl/delete/{id}', 'RplController@delete')->name('rpl.delete');
    Route::get('/Pemrakarsa/rpl/ubah/{id}', 'RplController@ubah')->name('rpl.ubah');
    Route::post('/Pemrakarsa/rpl/update/{id}', 'RplController@update')->name('rpl.update');
    Route::post('/Pemrakarsa/rpl', 'RplController@store_rpl')->name('rpl.store_rpl');

    //Print doc RKL RPL
    Route::get('/Pemrakarsa/printrkl/download/{id}', 'PrintRklController@download')->name('printrkl.download');
    Route::get('/Pemrakarsa/printrpl/download/{id}', 'PrintRplController@download')->name('printrpl.download');
});

Route::group(['middleware' => ['auth', 'cekRole:Operator,Pemrakarsa']], function() {
    Route::get('/Operator', 'OperatorController@index')->name('operator.index');
    Route::get('/Operator/search', 'OperatorController@search')->name('operator.search');
    Route::get('/Operator/download/{id}', 'OperatorController@download')->name('operator.download');
    Route::get('/Operator/preview/{id}', 'OperatorController@preview')->name('operator.preview');
    Route::put('/Operator/upload_file', 'OperatorController@upload_file')->name('operator.upload_file');
    Route::get('/Operator/file/delete/{id}', 'OperatorController@destroyFile')->name('operator.destroy.file');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/review/{id}', 'SkklController@review')->name('skkl.review');
});

//Percobaan multi-user authentication
Route::group(['middleware' => ['auth', 'cekRole:Pemrakarsa']], function() {
    Route::get('/cekRole', 'HomeController@cekRole');
});
