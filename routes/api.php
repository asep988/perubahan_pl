<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppTestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/operator-list', 'OperatorController@OperatorList');

// IMPORTANT NOTE: Nanti Controller Ini Dihapus
Route::get('test/kegiatan', [AppTestController::class, 'kegiatan']);
Route::get('test/afterMeeting', [AppTestController::class,'afterMeeting']);
Route::get('test/datedMeeting', [AppTestController::class,'datedMeeting']);
Route::get('test/incomplete', [AppTestController::class,'incomplete']);
Route::get('test/processed', [AppTestController::class,'processed']);
Route::get('test/ptspValidated', [AppTestController::class,'ptspValidated']);
Route::get('test/reportedMeeting', [AppTestController::class,'reportedMeeting']);
Route::get('test/returnedRejected', [AppTestController::class,'returnedRejected']);
Route::get('test/returnedUnverificated', [AppTestController::class,'returnedUnverificated']);
Route::get('test/undatedVerificated', [AppTestController::class,'undatedVerificated']);
Route::get('test/unverificated', [AppTestController::class,'unverificated']);
Route::get('test/verificated', [AppTestController::class,'verificated']);
