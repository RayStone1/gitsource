<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::post('/login', [AuthController::class,'login'])->name('login');
Route::group(['middleware'=>'auth:api'],function (){
    Route::resource('mun-one',MunOneController::class)->except(['edit','create']);
    Route::resource('mun-one.synonym',MunOneSynonymController::class)->except(['edit','create']);

    Route::resource('mun-two',MunTwoController::class)->only(['show','index','store','update']);
    Route::resource('mun-two.synonym',MunTwoSynonymController::class)->except(['edit','create']);

    Route::resource('names',NameController::class)->only(['show','index','store','update']);
    Route::resource('names.synonym',NameSynonymController::class)->except(['edit','create']);

    Route::resource('province',ProvinceController::class)->only(['show','index']);

    Route::resource('source',SourceController::class)->except(['edit','create']);

    Route::get('/logout', [AuthController::class,'logout'])->name('logout');;
});
