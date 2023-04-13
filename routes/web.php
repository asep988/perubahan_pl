<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\SekretariatController;
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
// Route::get('/testing', 'HomeController@testing');
// Route::get('/dd', 'HomeController@dd');
// Route::get('/registration_def', 'HomeController@registration_def');
// Route::get('/truncate-reset', 'HomeController@reset');

//home
Route::get('/', [LoginController::class, 'index'])->name('login.form');
Route::get('/redirection', 'HomeController@redirection')->name('redirection');

//chat
Route::post('/skkl/chat/create/{id}', 'SkklController@chatCreate')->name('skkl.chat.create');
Route::post('/skkl/chat/update/{id}', 'SkklController@chatUpdate')->name('skkl.chat.update');
Route::get('/skkl/notif/update/{id}', 'SkklController@notifUpdate')->name('skkl.notif.update');

Route::post('/pkplh/chat/create/{id}', 'PkplhController@chatCreate')->name('pkplh.chat.create');
Route::post('/pkplh/chat/update/{id}', 'PkplhController@chatUpdate')->name('pkplh.chat.update');
Route::get('/pkplh/notif/update/{id}', 'PkplhController@notifUpdate')->name('pkplh.notif.update');

Route::get('/ptsp', 'PtspController@login')->name('ptsp');
Route::post('/ptsp/login', 'PtspController@authenticate')->name('ptsp.login');
Route::get('/ptsp/skkl/8c7a5370e747a69ad6941f97c80dc06a', 'PtspController@skklIndex')->name('ptsp.skkl.index');
Route::get('/ptsp/pkplh/842998c9fbab1a005e7fb0eb8f1f3765', 'PtspController@pkplhIndex')->name('ptsp.pkplh.index');
Route::get('/datatable/skkl', [SekretariatController::class, 'datatableSkkl'])->name('datatable.skkl');
Route::get('/datatable/pkplh', [SekretariatController::class, 'datatablePkplh'])->name('datatable.pkplh');

Route::group(['middleware' => ['auth', 'cekRole:Pemrakarsa']], function() {
    //skkl
    Route::get('/Pemrakarsa', 'HomeController@index')->name('pemrakarsa.index');
    Route::get('/Pemrakarsa/skkl/form', 'SkklController@create')->name('skkl.create');
    Route::get('/Pemrakarsa/skkl/edit/{id}', 'SkklController@edit')->name('skkl.edit');
    Route::get('/Pemrakarsa/skkl/download/{id}', 'SkklController@download_skkl')->name('skkl.download-skkl');
    Route::post('/Pemrakarsa/skkl/create', 'SkklController@store')->name('skkl.store');
    Route::put('/Pemrakarsa/skkl/update/{id}', 'SkklController@update')->name('skkl.update');
    Route::put('/Pemrakarsa/skkl/batal/{id}', 'SkklController@batal')->name('skkl.batal');
    Route::get('/Pemrakarsa/skkl/regist/{id}', 'SkklController@regist')->name('skkl.regist');
    Route::get('/Pemrakarsa/skkl/chat/{id}', 'SkklController@chat')->name('skkl.chat');
    //pkplh
    Route::get('/Pemrakarsa/pkplh', 'PkplhController@index')->name('pkplh.index');
    Route::get('/Pemrakarsa/pkplh/form', 'PkplhController@create')->name('pkplh.create');
    Route::get('/Pemrakarsa/pkplh/edit/{id}', 'PkplhController@edit')->name('pkplh.edit');
    Route::post('/Pemrakarsa/pkplh/create', 'PkplhController@store')->name('pkplh.store');
    Route::put('/Pemrakarsa/pkplh/update/{id}', 'PkplhController@update')->name('pkplh.update');
    Route::put('/Pemrakarsa/pkplh/batal/{id}', 'PkplhController@batal')->name('pkplh.batal');
    Route::get('/Pemrakarsa/pkplh/regist/{id}', 'PkplhController@regist')->name('pkplh.regist');
    Route::get('/Pemrakarsa/pkplh/chat/{id}', 'PkplhController@chat')->name('pkplh.chat');
    //rkl
    Route::get('/Pemrakarsa/rkl/create/{id}', 'RklController@create')->name('rkl.create');
    Route::post('/Pemrakarsa/rkl/delete/{id}', 'RklController@delete')->name('rkl.delete');
    Route::get('/Pemrakarsa/rkl/ubah/{id}', 'RklController@ubah')->name('rkl.ubah');
    Route::post('/Pemrakarsa/rkl/update/{id}', 'RklController@update')->name('rkl.update');
    Route::post('/Pemrakarsa/rkl', 'RklController@store_rkl')->name('rkl.store_rkl');
    Route::post('/Pemrakarsa/rkl/import/{id}', 'RklController@import')->name('rkl.import');

    //ukl_upl
    Route::get('/Pemrakarsa/uklupl/create/{id}', 'UkluplController@create')->name('uklupl.create');
    Route::post('/Pemrakarsa/uklupl/delete/{id}', 'UkluplController@delete')->name('uklupl.delete');
    Route::get('/Pemrakarsa/uklupl/ubah/{id}', 'UkluplController@ubah')->name('uklupl.ubah');
    Route::post('/Pemrakarsa/uklupl/update/{id}', 'UkluplController@update')->name('uklupl.update');
    Route::post('/Pemrakarsa/uklupl', 'UkluplController@store')->name('uklupl.store');
    Route::post('/Pemrakarsa/uklupl/{id}', 'UkluplController@import')->name('uklupl.import');

    //rpl
    Route::get('/Pemrakarsa/rpl/create/{id}', 'RplController@create')->name('rpl.create');
    Route::post('/Pemrakarsa/rpl/delete/{id}', 'RplController@delete')->name('rpl.delete');
    Route::get('/Pemrakarsa/rpl/ubah/{id}', 'RplController@ubah')->name('rpl.ubah');
    Route::post('/Pemrakarsa/rpl/update/{id}', 'RplController@update')->name('rpl.update');
    Route::post('/Pemrakarsa/rpl', 'RplController@store_rpl')->name('rpl.store_rpl');
    Route::post('/Pemrakarsa/rpl/import/{id}', 'RplController@import')->name('rpl.import');

    //lampiran
    Route::get('/pemrakarsa/lampiran/satu/{id}', 'SkklController@download_lampiranI')->name('pemrakarsa.download.lampiran1');
    Route::get('/pemrakarsa/pertek/{id}', 'SkklController@download_pertek')->name('pemrakarsa.download.pertek');
    Route::get('/pemrakarsa/rintek/{id}', 'SkklController@download_rintek')->name('pemrakarsa.download.rintek');
    Route::get('/pemrakarsa/pertek/pkplh/{id}', 'PkplhController@download_pertek')->name('pemrakarsa.pkplh.pertek');
    Route::get('/pemrakarsa/rintek/pkplh/{id}', 'PkplhController@download_rintek')->name('pemrakarsa.pkplh.rintek');
});

Route::group(['middleware' => ['auth', 'cekRole:Operator']], function() {
    Route::get('/Operator', 'OperatorController@index')->name('operator.index');
    Route::get('/Operator/search', 'OperatorController@search')->name('operator.search');
    Route::put('/Operator/skkl/periksa/{id}', 'OperatorController@periksa')->name('operator.skkl.periksa');
    Route::put('/Operator/skkl/rpd/{id}', 'OperatorController@rpd_skkl')->name('operator.skkl.rpd');
    Route::get('/Operator/skkl/chat/{id}', 'SkklController@chat')->name('skkl.operator.chat');

    Route::put('/Operator/pkplh/rpd/{id}', 'OperatorController@rpd_pkplh')->name('operator.pkplh.rpd');
    Route::get('/Operator/download/{id}', 'OperatorController@download')->name('operator.download');
    Route::get('/Operator/preview/{id}', 'OperatorController@preview')->name('operator.preview');
    Route::put('/Operator/upload_file', 'OperatorController@upload_file')->name('operator.upload_file');
    Route::get('/Operator/file/delete/{id}', 'OperatorController@destroyFile')->name('operator.destroy.file');

    Route::get('/Operator/pkplh', 'PkplhController@operatorIndex')->name('operator.pkplh.index');
    Route::get('/Operator/pkplh/preview/{id}', 'PkplhController@operatorPreview')->name('operator.pkplh.preview');
    Route::put('/Operator/pkplh/upload_file', 'PkplhController@uploadFile')->name('operator.pkplh.upload');
    Route::get('/Operator/pkplh/file/delete/{id}', 'PkplhController@destroyFile')->name('operator.pkplh.destroy');
    Route::get('/Operator/pkplh/download/{id}', 'PkplhController@download')->name('operator.pkplh.download');
    Route::get('/Operator/pkplh/chat/{id}', 'PkplhController@chat')->name('pkplh.operator.chat');

    //Print doc RKL RPL
    Route::get('/Operator/printrkl/download/{id}', 'PrintRklController@download')->name('printrkl.download');
    Route::get('/Operator/printrpl/download/{id}', 'PrintRplController@download')->name('printrpl.download');
    //Print doc UKL-UPL
    Route::get('/Operator/uklupl/download/{id}', 'PrintUkluplController@download')->name('printuklupl.download');
    //Print Lampiran I, Pertek dan Rintek
    Route::get('/Operator/lampiran/satu/{id}', 'SkklController@download_lampiranI')->name('operator.download.lampiran1');
    Route::get('/Operator/pertek/{id}', 'SkklController@download_pertek')->name('operator.download.pertek');
    Route::get('/Operator/rintek/{id}', 'SkklController@download_rintek')->name('operator.download.rintek');
    Route::get('/Operator/pkplh/pertek/{id}', 'PkplhController@download_pertek')->name('operator.pkplh.pertek');
    Route::get('/Operator/pkplh/rintek/{id}', 'PkplhController@download_rintek')->name('operator.pkplh.rintek');
});

Route::group(['middleware' => ['auth', 'cekRole:Sekretariat']], function() {
    Route::get('/Sekretariat', 'SekretariatController@index')->name('sekre.skkl.index');
    Route::put('/Sekretariat/penugasan/update', 'SekretariatController@assign')->name('sekre.skkl.update');
    Route::put('/Sekretariat/skkl/reject/{id}', 'SekretariatController@skklReject')->name('sekre.skkl.reject');
    Route::get('/Sekretariat/pkplh', 'SekretariatController@pkplhIndex')->name('sekre.pkplh.index');
    Route::put('/Sekretariat/pkplh/update', 'SekretariatController@pkplhAssign')->name('sekre.pkplh.update');
    Route::put('/Sekretariat/pkplh/reject/{id}', 'SekretariatController@pkplhReject')->name('sekre.pkplh.reject');
    Route::get('/Sekretariat/skkl/chat/{id}', 'SkklController@chat')->name('skkl.sekretariat.chat');
    Route::get('/Sekretariat/pkplh/chat/{id}', 'PkplhController@chat')->name('pkplh.sekretariat.chat');

    // buton aksi pkplh
    Route::get('/Sekretariat/pkplh/preview/{id}', 'PkplhController@operatorPreview')->name('sekretariat.pkplh.preview');
    Route::get('/Sekretariat/uklupl/download/{id}', 'PrintUkluplController@download')->name('sekretariat.printuklupl.download');
    Route::get('/Sekretariat/pkplh/pertek/{id}', 'PkplhController@download_pertek')->name('sekretariat.pkplh.pertek');
    Route::get('/Sekretariat/pkplh/rintek/{id}', 'PkplhController@download_rintek')->name('sekretariat.pkplh.rintek');
    Route::get('/Sekretariat/pkplh/download/{id}', 'PkplhController@download')->name('sekretariat.pkplh.download');

    // buton aksi skkl
    Route::get('/Sekretariat/skkl/preview/{id}', 'OperatorController@preview')->name('sekretariat.skkl.preview');
    Route::get('/Sekretariat/skkl/download/{id}', 'OperatorController@download')->name('sekretariat.skkl.download');
    Route::get('/Sekretariat/printrkl/download/{id}', 'PrintRklController@download')->name('sekretariat.printrkl.download');
    Route::get('/Sekretariat/printrpl/download/{id}', 'PrintRplController@download')->name('sekretariat.printrpl.download');
    Route::get('/Sekretariat/lampiran/satu/{id}', 'SkklController@download_lampiranI')->name('sekretariat.download.lampiran1');
    Route::get('/Sekretariat/pertek/{id}', 'SkklController@download_pertek')->name('sekretariat.download.pertek');
    Route::get('/Sekretariat/rintek/{id}', 'SkklController@download_rintek')->name('sekretariat.download.rintek');
});

Route::group(['middleware' => ['auth']], function() {
    Route::get('/skkl/review/{id}', 'SkklController@review')->name('skkl.review');
    Route::get('/pkplh/review/{id}', 'PkplhController@review')->name('pkplh.review');
    Route::get('/rkl/preview/{id}', 'PreviewController@preview_rkl')->name('preview.rkl');
    Route::get('/rpl/preview/{id}', 'PreviewController@preview_rpl')->name('preview.rpl');
    Route::get('/uklupl/preview/{id}', 'PreviewController@preview_uklupl')->name('preview.uklupl');
});


//Percobaan multi-user authentication
Route::group(['middleware' => ['auth', 'cekRole:Pemrakarsa']], function() {
    Route::get('/cekRole', 'HomeController@cekRole');
});
