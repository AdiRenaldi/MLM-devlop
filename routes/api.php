<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KatalogController;
use App\Http\Controllers\Api\LaporPoinController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\NotifikasiController;
use App\Http\Controllers\Api\PromoController;
use App\Http\Controllers\Api\RewardController;
use App\Http\Controllers\Api\WilayahController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user()->kd_member;
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profileMember', [MemberController::class, 'profileMember']);
    Route::get('/lihatJaringan', [MemberController::class, 'lihatJaringan']);

    Route::get('/katalogProduk', [KatalogController::class, 'katalog']);
    Route::get('/reward', [RewardController::class, 'reward']);
    Route::get('/promo', [PromoController::class, 'promo']);

    // poin
    Route::post('/laporPoin', [LaporPoinController::class, 'laporPoin']);
    Route::get('/getLaporPoin', [LaporPoinController::class, 'getLaporPoin']);

    Route::get('/getVerifikasiPoin', [LaporPoinController::class, 'getVerifikasiPoin']);
    Route::put('/verifikasiUpline', [LaporPoinController::class, 'verifikasiUpline']);

    Route::get('/getSetujuPoin', [LaporPoinController::class, 'getSetujuPoin']);
    Route::put('/persetujuanAtasan', [LaporPoinController::class, 'persetujuanAtasan']);

    // data wilayah
    Route::get('/provinsi', [WilayahController::class, 'provinsi']);
    Route::get('/kabupaten', [WilayahController::class, 'kabupaten']);
    Route::get('/kecamatan', [WilayahController::class, 'kecamatan']);

    // notifikasi
    Route::get('/notifikasi', [NotifikasiController::class, 'notifikasi']);
    Route::get('/detailNotifikasi', [NotifikasiController::class, 'detailNotifikasi']);
});