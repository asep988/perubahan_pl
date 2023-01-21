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
Route::get('/query-check', 'HomeController@queryCheck');

//home
Route::get('/', [LoginController::class, 'index'])->name('login.form');
Route::get('/redirection', 'HomeController@redirection')->name('redirection');

Route::group(['middleware' => ['auth', 'cekRole:Pemrakarsa']], function() {
    //skkl
    Route::get('/Pemrakarsa', 'HomeController@index')->name('pemrakarsa.index');
    Route::get('/Pemrakarsa/skkl/form', 'SkklController@create')->name('skkl.create');
    Route::get('/Pemrakarsa/skkl/edit/{id}', 'SkklController@edit')->name('skkl.edit');
    Route::post('/Pemrakarsa/skkl/create', 'SkklController@store')->name('skkl.store');
    Route::put('/Pemrakarsa/skkl/update/{id}', 'SkklController@update')->name('skkl.update');
    //pkplh
    Route::get('/Pemrakarsa/pkplh', 'PkplhController@index')->name('pkplh.index');
    Route::get('/Pemrakarsa/pkplh/form', 'PkplhController@create')->name('pkplh.create');
    Route::get('/Pemrakarsa/pkplh/edit/{id}', 'PkplhController@edit')->name('pkplh.edit');
    Route::post('/Pemrakarsa/pkplh/create', 'PkplhController@store')->name('pkplh.store');
    Route::put('/Pemrakarsa/pkplh/update/{id}', 'PkplhController@update')->name('pkplh.update');
    //rkl
    Route::get('/Pemrakarsa/rkl/create/{id}', 'RklController@create')->name('rkl.create');
    Route::post('/Pemrakarsa/rkl/delete/{id}', 'RklController@delete')->name('rkl.delete');
    Route::get('/Pemrakarsa/rkl/ubah/{id}', 'RklController@ubah')->name('rkl.ubah');
    Route::post('/Pemrakarsa/rkl/update/{id}', 'RklController@update')->name('rkl.update');
    Route::post('/Pemrakarsa/rkl', 'RklController@store_rkl')->name('rkl.store_rkl');

    //ukl_upl
    Route::get('/Pemrakarsa/uklupl/create/{id}', 'UkluplController@create')->name('uklupl.create');
    Route::post('/Pemrakarsa/uklupl/store/{id}', 'UkluplController@store')->name('uklupl.store');
    Route::post('/Pemrakarsa/uklupl/delete/{id}', 'UkluplController@delete')->name('uklupl.delete');
    Route::get('/Pemrakarsa/uklupl/ubah/{id}', 'UkluplController@ubah')->name('uklupl.ubah');
    Route::post('/Pemrakarsa/uklupl/update/{id}', 'UkluplController@update')->name('uklupl.update');

    //rpl
    Route::get('/Pemrakarsa/rpl/create/{id}', 'RplController@create')->name('rpl.create');
    Route::post('/Pemrakarsa/rpl/delete/{id}', 'RplController@delete')->name('rpl.delete');
    Route::get('/Pemrakarsa/rpl/ubah/{id}', 'RplController@ubah')->name('rpl.ubah');
    Route::post('/Pemrakarsa/rpl/update/{id}', 'RplController@update')->name('rpl.update');
    Route::post('/Pemrakarsa/rpl', 'RplController@store_rpl')->name('rpl.store_rpl');
});

Route::group(['middleware' => ['auth', 'cekRole:Operator']], function() {
    Route::get('/Operator', 'OperatorController@index')->name('operator.index');
    Route::get('/Operator/search', 'OperatorController@search')->name('operator.search');
    Route::put('/Operator/skkl/periksa/{id}', 'OperatorController@periksa')->name('operator.skkl.periksa');
    Route::get('/Operator/download/{id}', 'OperatorController@download')->name('operator.download');
    Route::get('/Operator/preview/{id}', 'OperatorController@preview')->name('operator.preview');
    Route::put('/Operator/upload_file', 'OperatorController@upload_file')->name('operator.upload_file');
    Route::get('/Operator/file/delete/{id}', 'OperatorController@destroyFile')->name('operator.destroy.file'); 
    
    Route::get('/Operator/pkplh', 'PkplhController@operatorIndex')->name('operator.pkplh.index');
    Route::get('/Operator/pkplh/preview/{id}', 'PkplhController@operatorPreview')->name('operator.pkplh.preview');
    Route::put('/Operator/pkplh/upload_file', 'PkplhController@uploadFile')->name('operator.pkplh.upload');
    Route::get('/Operator/pkplh/file/delete/{id}', 'PkplhController@destroyFile')->name('operator.pkplh.destroy');
    Route::get('/Operator/pkplh/download/{id}', 'PkplhController@download')->name('operator.pkplh.download');

    //Print doc RKL RPL
    Route::get('/Operator/printrkl/download/{id}', 'PrintRklController@download')->name('printrkl.download');
    Route::get('/Operator/printrpl/download/{id}', 'PrintRplController@download')->name('printrpl.download');
    //Print doc UKL-UPL
    Route::get('/Operator/uklupl/download/{id}', 'PrintUkluplController@download')->name('printukupl.download');
});

Route::group(['middleware' => ['auth', 'cekRole:Sekretariat']], function() {
    Route::get('/Sekretariat', 'SekretariatController@index')->name('sekre.penugasan.index');
    Route::put('/Sekretariat/penugasan/update/{id}', 'SekretariatController@assign')->name('sekre.penugasan.update');
    Route::get('/Sekretariat/pkplh', 'SekretariatController@pkplhIndex')->name('sekre.pkplh.index');
    Route::put('/Sekretariat/pkplh/update/{id}', 'SekretariatController@pkplhAssign')->name('sekre.pkplh.update');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/skkl/review/{id}', 'SkklController@review')->name('skkl.review');
    Route::get('/pkplh/review/{id}', 'PkplhController@review')->name('pkplh.review');
});


//Percobaan multi-user authentication
Route::group(['middleware' => ['auth', 'cekRole:Pemrakarsa']], function() {
    Route::get('/cekRole', 'HomeController@cekRole');
});
