<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\GudangUtamaController;
use App\Http\Controllers\GudangCabangController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\productsController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\EventController;

// Route::get('/tes', function () {
//   return view('myTamplets.member.member');
// });

// Auth::routes(['verify' => true]);

Route::get('/', [AuthenticationController::class, 'loginPage'])->name('login-page')->name('login');


Route::group(['prefix' => 'auth'], function () {
  Route::get('/login', [AuthenticationController::class, 'loginPage'])->name('login-page')->name('login-page');
  Route::post('/login', [AuthenticationController::class, 'loginAction'])->name('login-action');
  Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout-action')->middleware('Login');
});

Route::middleware(['Login','Admin'])->group(function () {
  Route::get('/dashboard',[DashboardController::class, 'dashboardPage'])->name('dashboard-page');

  // member
  Route::get('/member', [MemberController::class, 'member'])->name('member-page');
  Route::get('/member/detail/{id}', [MemberController::class, 'detail'])->name('member-detail');
  Route::get('/member/reward', [MemberController::class, 'Reward'])->name('member-reward');
  Route::get('/member/add', [MemberController::class, 'add'])->name('member-add');
  Route::get('/member/addNew', [MemberController::class, 'addNew'])->name('member-addNew');
  Route::post('/member/created', [MemberController::class, 'created'])->name('member-created');
  Route::get('/member/edit/{id}', [MemberController::class, 'edit'])->name('member-edit');
  Route::put('/member/updated/{id}', [MemberController::class, 'updated'])->name('member-updated');
  Route::get('/member/deleted/{id}', [MemberController::class, 'deleted'])->name('member-deleted');
  // Route::get('/member/pencarianLanjutan', [MemberController::class, 'pencarianLanjutan'])->name('member-pencarianLanjutan');
  Route::get('/member/jaringan/{id}', [MemberController::class, 'jaringan'])->name('member-jaringan');

  //ajax
  Route::get('/member/kabupaten/{id}', [MemberController::class, 'kabupaten']);
  Route::get('/member/kecamatan/{id}', [MemberController::class, 'kecamatan']);


  // product
  Route::get('/product', [productsController::class, 'index'])->name('product-index');
  Route::get('/product/detail/{id}', [productsController::class, 'detail_index'])->name('product-detail-index');
  Route::get('/product/add', [productsController::class, 'add_index'])->name('product-add-index');
  Route::post('/product/crated', [productsController::class, 'created_index'])->name('product-created-index');
  Route::get('/product/edit/{id}', [productsController::class, 'edit_index'])->name('product-edit-index');
  Route::put('/product/updated/{id}', [productsController::class, 'updated_index'])->name('product-updated-index');
  Route::get('/product/deleted/{id}', [productsController::class, 'deleted_index'])->name('product-delete-index');
  // ajax pindah-stok
  Route::post('/stok/product', [StokController::class, 'listProducts'])->name('product-stok-list');

  // gudangProfile
  Route::get('/profileGudang', [GudangController::class, 'profileGudang'])->name('profile-gudang');
  Route::get('/profileGudang/add/', [GudangController::class, 'add'])->name('profile-gudang-add');
  Route::post('/profileGudang/created', [GudangController::class, 'created'])->name('gudang-profile-created');
  Route::get('/profileGudang/edit/{id}', [GudangController::class, 'edit'])->name('profile-gudang-edit');
  Route::put('/profileGudang/updated/{id}', [GudangController::class, 'updated'])->name('gudang-profile-updated');

  // gudangUtama
  Route::get('/gudangUtama', [GudangUtamaController::class, 'gudangUtama'])->name('gudang-utama');
  Route::get('/gudangUtama/detail/{id}', [GudangUtamaController::class, 'detail'])->name('gudang-utama-detail');
  Route::get('/gudangUtama/stok/add', [GudangUtamaController::class, 'add'])->name('gudang-utama-stok-add');
  Route::post('/gudangUtama/created', [GudangUtamaController::class, 'created'])->name('gudang-utama-stok-created');

  Route::get('/gudangUtama/edit/{id}', [GudangUtamaController::class, 'edit'])->name('gudang-utama-edit');
  Route::put('/gudangUtama/updated/{id}', [GudangUtamaController::class, 'updated'])->name('gudang-utama-updated');
  Route::get('/gudangUtama/deleted/{id}', [GudangUtamaController::class, 'deleted'])->name('gudang-utama-delete');
  Route::post('/gudangUtama/saldo', [GudangUtamaController::class, 'tambahSaldo'])->name('gudang-utama-saldo');
  // ajax gudangUtama
  Route::post('/gudangUtama/product', [productsController::class, 'listProducts'])->name('product-list');
  // Route::get('/gudangUtama/pencarianLanjutan', [GudangUtamaController::class, 'pencarianLanjutan'])->name('gudangUtama-pencarianLanjutan');

  // gudangCabang
  Route::get('/gudangCabang', [GudangCabangController::class, 'gudangCabang'])->name('gudang-cabang-page');

  // gudang to gudang
  Route::get('/stok', [StokController::class, 'stok'])->name('stok-page');
  Route::get('/stok/pindah/togudang', [StokController::class, 'pindahStok'])->name('pindah-stok-ToGudang');
  Route::post('/stok/status/togudang', [StokController::class, 'pengirimanGudang'])->name('status-pengiriman-ToGudang');
  Route::post('/stok/pindah/togudang', [StokController::class, 'pindahStokToGudang'])->name('pindah-stok-ToGudang');

  // gudang to member
  Route::get('/transaksi', [StokController::class, 'transaksiMember'])->name('transaksi');
  Route::get('/transaksi/member', [StokController::class, 'pindahStokMember'])->name('pindah-stok-ToMember');
  Route::post('/stok/status/toMember', [StokController::class, 'pengirimanMember'])->name('status-pengiriman-ToMember');
  Route::post('/transaksi/member', [StokController::class, 'pindahStokToMember'])->name('pindah-stok-ToMember');

  // promo
  Route::get('/promo', [PromoController::class, 'promo'])->name('promo-page');
  Route::get('/promo/detail/{id}', [PromoController::class, 'detail'])->name('promo-detail');
  Route::get('/promo/add', [PromoController::class, 'add'])->name('promo-add');
  Route::post('/promo/created', [PromoController::class, 'created'])->name('promo-created');
  Route::get('/promo/edit/{id}', [PromoController::class, 'edit'])->name('promo-edit');
  Route::put('/promo/updated/{id}', [PromoController::class, 'updated'])->name('promo-updated');
  Route::get('/promo/deleted/{id}', [PromoController::class, 'deleted'])->name('promo-delete');

  Route::post('/promo/dashboard', [PromoController::class, 'tampilDashboard'])->name('promo-dashboard');
  Route::post('/promo/slide', [PromoController::class, 'tampilSlide'])->name('promo-slide');

  // reward
  Route::get('/reward', [RewardController::class, 'reward'])->name('reward-page');
  Route::get('/reward/add', [RewardController::class, 'add'])->name('reward-add');
  Route::post('/reward/created', [RewardController::class, 'created'])->name('reward-created');
  Route::get('/reward/edit/{id}', [RewardController::class, 'edit'])->name('reward-edit');
  Route::put('/reward/updated/{id}', [RewardController::class, 'updated'])->name('reward-updated');
  Route::get('/reward/deleted/{id}', [RewardController::class, 'deleted'])->name('reward-delete');
  // ajax
  Route::post('/reward/beriReward', [RewardController::class, 'beriReward'])->name('beri-reward');

  // pangkat
  Route::get('/pangkat', [PangkatController::class, 'pangkat'])->name('pangkat-page');
  Route::get('/pangkat/add', [PangkatController::class, 'add'])->name('pangkat-add');
  Route::post('/pangkat/created', [PangkatController::class, 'created'])->name('pangkat-created');
  Route::get('/pangkat/edit/{id}', [PangkatController::class, 'edit'])->name('pangkat-edit');
  Route::put('/pangkat/updated/{id}', [PangkatController::class, 'updated'])->name('pangkat-updated');
  Route::get('/pangkat/deleted/{id}', [PangkatController::class, 'deleted'])->name('pangkat-delete');


  // notifikasi
  Route::get('/notifikasi', [NotifikasiController::class, 'notifikasi'])->name('notifikasi-page');
  Route::get('/notifikasi/add', [NotifikasiController::class, 'add'])->name('notifikasi-add');
  Route::post('/notifikasi/created', [NotifikasiController::class, 'created'])->name('notifikasi-created');


  // event
  Route::get('/event', [EventController::class, 'event'])->name('event-page');
  Route::get('/event/add', [EventController::class, 'add'])->name('event-add');
  Route::post('/event/created', [EventController::class, 'created'])->name('event-created');
  Route::get('/event/edit/{id}', [EventController::class, 'edit'])->name('event-edit');
  Route::put('/event/updated/{id}', [EventController::class, 'updated'])->name('event-updated');
  Route::get('/event/deleted/{id}', [EventController::class, 'deleted'])->name('event-delete');

  Route::get('/event/udangFull/{id}', [EventController::class, 'udangFull'])->name('undangan-full');
  Route::get('/event/detail/{id}', [EventController::class, 'detail'])->name('event-detail');

  Route::post('/event/updateNomorKursi', [EventController::class, 'updateNomorKursi'])->name('ubah-nomor-kursi');





  Route::get('/pengaturan', [PengaturanController::class, 'pengaturan'])->name('pengaturan-page');
});



