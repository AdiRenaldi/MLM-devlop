<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\ManageStok;
use App\Models\Member;
use App\Models\PoinPlatinum;
use App\Models\PoinSilver;
use App\Models\Products;
use Carbon\Carbon;
use App\Models\SaldoGudang;
use App\Models\StokGudangCabang;
use App\Models\StokGudangUtama;
use App\Models\TransaksiMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StokController extends Controller
{
    // ajax
    public function listProducts(Request $request){
        $kd_gudang = $request->input('kd_gudangAwal');
        $gudang = Gudang::where('kd_gudang', $kd_gudang)->first();
        if($gudang->identitas == 0){
            $stok = StokGudangUtama::with('product')
            ->where('masaExpire', '>=', Carbon::now()) 
            ->orderBy('created_at', 'desc')
            ->get();
        }else{
            $stok = StokGudangCabang::with(['product', 'stokGudangUtama'])
            ->where('kd_gudang', $kd_gudang)
            ->whereHas('stokGudangUtama', function ($query) {
                $query->where('masaExpire', '>=', Carbon::now());
            })->orderBy('created_at', 'desc')
            ->get();
        }
        return response()->json([
            'status' => 'success',
            'data' => $stok
        ]);
    }

    public function stok(){
        $pageConfigs = [
            'title' => 'Pindah Stok',
            'formTarget' => 'stok',
        ];
        $manageStok = ManageStok::with('product', 'gudangAwal', 'gudangTujuan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.stok.stok', ['pageConfigs'=>$pageConfigs, 'manageStok'=>$manageStok]);
    }

    public function transaksiMember(){
        $pageConfigs = [
            'title' => 'Transaksi Member',
            'formTarget' => 'transaksi-member',
            'pageType' => 'add',
        ];
        $manageMember = TransaksiMember::with('product', 'gudangAwal', 'member')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.stok.transaksi-member', ['pageConfigs'=>$pageConfigs, 'manageMember'=>$manageMember]);
    }

    public function pindahStok(){
        $pageConfigs = [
            'title' => 'Pindah Stok',
            'formTarget' => 'pindah-stok-ToGudang',
            'pageType' => 'add',
        ];
        $gudangs = Gudang::all();
        return view('pages.stok.pindah-stok', ['pageConfigs'=>$pageConfigs, 'gudangs'=>$gudangs]);
    }

    public function pindahStokToGudang(Request $request){
        $request->validate([
            'kd_gudangAwal' => 'required',
            'kd_gudangTujuan' => 'required',
            'kd_stokGudang' => 'required',
            'status_gudang' => 'required',
            'total_stok' => 'required|numeric',
            'carier' => 'required',
            'harga_kargo' => 'required|numeric',
        ],[
            'kd_gudangAwal.required' => 'Gudang awal harus diisi',
            'kd_gudangTujuan.required' => 'Gudang tujuan harus diisi',
            'kd_stokGudang.required' => 'Stok harus diisi',
            'total_stok.required' => 'Total stok harus diisi',
            'total_stok.numeric' => 'Total stok harus angka',
            'status_gudang.required' => 'Status gudang harus dipilih',
            'carier.required' => 'Carier harus diisi',
            'harga_kargo.required' => 'Harga kargo harus diisi',
            'harga_kargo.numeric' => 'Harga kargo harus angka',
        ]);
        DB::beginTransaction();
        try {
            $manageStok = ManageStok::orderBy('kd_menageStock', 'desc')->first();
            $idMenage = 'MS-' . date('y') . date('m') . str_pad( ($manageStok ? intval(substr($manageStok->kd_menageStock, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
            $gudangCabang = StokGudangCabang::orderBy('kd_stokGudangCabang', 'desc')->first();
            $idGudang = 'PGC-' . date('y') . date('m') . str_pad( ($gudangCabang ? intval(substr($gudangCabang->kd_stokGudangCabang, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);

            $gudangAwal = Gudang::where('kd_gudang', $request->kd_gudangAwal)->first();
            if($gudangAwal->identitas == 0){
                $cekStok = StokGudangUtama::where('kd_stokGudangUtama', $request->kd_stokGudang)->where('kd_gudang', $request->kd_gudangAwal)->first();
                if($cekStok->jumlahStok < $request->total_stok){
                    throw ValidationException::withMessages([
                        'total_stok' => 'Stok tidak mencukupi.',
                    ]);
                }
            }else{
                $stokGudangCabang = StokGudangCabang::where('kd_stokGudangUtama', $request->kd_stokGudang)->where('kd_gudang', $request->kd_gudangAwal)->first();
                if($stokGudangCabang->jumlahStok < $request->total_stok){
                    throw ValidationException::withMessages([
                        'total_stok' => 'Stok tidak mencukupi.',
                    ]);
                }
            }


            $gudangTujuan = Gudang::where('kd_gudang', $request->kd_gudangTujuan)->first();
            
            $manage = new ManageStok();
            $manage->kd_menageStock = $idMenage;
            $manage->kd_gudangAwal = $request->kd_gudangAwal;
            $manage->kd_gudangTujuan = $request->kd_gudangTujuan;
            $manage->kd_product = $request->kdProduct;
            $manage->qty = $request->total_stok;
            $manage->carier = $request->carier;
            $manage->harga_kargo = $request->harga_kargo;
            $manage->status_pengiriman = $request->status_gudang;
            if($manage->save()){
                $saldoGudang = SaldoGudang::orderBy('kd_saldoGudang', 'desc')->first();
                $saldoGudang->saldo -= $request->harga_kargo;
                $saldoGudang->update();
                if($gudangAwal->identitas == 0){
                    $kdGudangCabang = StokGudangCabang::where('kd_stokGudangUtama', $request->kd_stokGudang)->where('kd_gudang', $request->kd_gudangTujuan)->first();
                    if($kdGudangCabang){
                        $kdGudangCabang->jumlahStok += $request->total_stok;
                        $kdGudangCabang->update();
                    }else{
                        $stok = new StokGudangCabang();
                        $stok->kd_stokGudangCabang = $idGudang;
                        $stok->kd_gudang = $request->kd_gudangTujuan;
                        $stok->kd_product = $request->kdProduct;
                        $stok->kd_stokGudangUtama = $request->kd_stokGudang;
                        $stok->jumlahStok = $request->total_stok;
                        $stok->status = $request->status;
                        $stok->stokLokasi = $request->lokasi_stok;
                        $stok->save();
                    }
                    $stokGudang = StokGudangUtama::where('kd_stokGudangUtama', $request->kd_stokGudang)->where('kd_gudang', $request->kd_gudangAwal)->first();
                    $stokGudang->jumlahStok -= $request->total_stok;
                    $stokGudang->update();
                }else{
                    if($gudangTujuan->identitas == 0){
                        $stokGudangUtama = StokGudangUtama::where('kd_stokGudangUtama', $request->kd_stokGudang)->where('kd_gudang', $request->kd_gudangTujuan)->first();
                        $stokGudangUtama->jumlahStok += $request->total_stok;
                        if($stokGudangUtama->update()){
                            $stokGudangCabang = StokGudangCabang::where('kd_stokGudangUtama', $request->kd_stokGudang)->where('kd_gudang', $request->kd_gudangAwal)->first();
                            $stokGudangCabang->jumlahStok -= $request->total_stok;
                            $stokGudangCabang->update();
                        }
                    }else{
                        $stokGudangCabang = StokGudangCabang::where('kd_gudang', $request->kd_gudangTujuan)->where('kd_stokGudangUtama', $request->kd_stokGudang)->first();
                        if($stokGudangCabang){
                            $stokGudangCabang->jumlahStok += $request->total_stok;
                            if($stokGudangCabang->update()){
                                $stokGudangCabang = StokGudangCabang::where('kd_stokGudangUtama', $request->kd_stokGudang)->where('kd_gudang', $request->kd_gudangAwal)->first();
                                $stokGudangCabang->jumlahStok -= $request->total_stok;
                                $stokGudangCabang->update();
                            }
                        }else{
                            $stok = new StokGudangCabang();
                            $stok->kd_stokGudangCabang = $idGudang;
                            $stok->kd_gudang = $request->kd_gudangTujuan;
                            $stok->kd_product = $request->kdProduct;
                            $stok->kd_stokGudangUtama = $request->kd_stokGudang;
                            $stok->jumlahStok = $request->total_stok;
                            $stok->status = $request->status;
                            $stok->stokLokasi = $request->lokasi_stok;
                            $stok->save();
                            $stokGudang = StokGudangCabang::where('kd_stokGudangUtama', $request->kd_stokGudang)->where('kd_gudang', $request->kd_gudangAwal)->first();
                            $stokGudang->jumlahStok -= $request->total_stok;
                            $stokGudang->update();
                        }
                    }
                }
            }
            DB::commit();
            return redirect()->route('stok-page')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }

    public function pengirimanGudang(Request $request){
        try {
            $manageStok = ManageStok::where('kd_menageStock', $request->kd_menageStock)->first();
            $manageStok->status_pengiriman = $request->status_gudang;
            $manageStok->update();

            return redirect()->route('stok-page')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }

    public function pindahStokMember(){
        $pageConfigs = [
            'title' => 'Pindah Stok',
            'formTarget' => 'pindah-stok-ToMember',
            'pageType' => 'add',
        ];
        $gudangs = Gudang::all();
        return view('pages.stok.pindah-stok', ['pageConfigs'=>$pageConfigs, 'gudangs'=>$gudangs]);
    }


    function pindahStokToMember(Request $request){
        $request->validate([
            'kd_gudangAwal' => 'required',
            'idMember' => [
                // 'required',
                // 'numeric',
                Rule::exists('member', 'kd_member')
            ],
            'kd_stokGudang' => 'required',
            'status_gudang' => 'required',
            'total_stok' => 'required|numeric',
            'carier' => 'required',
            'harga_kargo' => 'required|numeric',
        ],[
            'kd_gudangAwal.required' => 'Gudang awal harus diisi',
            'idMember.exists' => 'ID Member tidak ditemukan.',
            // 'idMember.required' => 'Member harus diisi',
            // 'idMember.numeric' => 'Member harus angka',
            'kd_stokGudang.required' => 'Stok harus diisi',
            'status_gudang.required' => 'Status gudang harus diisi',
            'total_stok.required' => 'Total stok harus diisi',
            'total_stok.numeric' => 'Total stok harus angka',
            'carier.required' => 'Carier harus diisi',
            'harga_kargo.required' => 'Harga kargo harus diisi',
            'harga_kargo.numeric' => 'Harga kargo harus angka',
        ]);

        DB::beginTransaction();
        try {
            $manageStok = TransaksiMember::orderBy('kd_transaksiMember', 'desc')->first();
            $idMenage = 'TM-' . date('y') . date('m') . str_pad( ($manageStok ? intval(substr($manageStok->kd_transaksiMember, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);

            $gudangAwal = Gudang::where('kd_gudang', $request->kd_gudangAwal)->first();
            if($gudangAwal->identitas == 0){
                $cekStok = StokGudangUtama::where('kd_stokGudangUtama', $request->kd_stokGudang)->where('kd_gudang', $request->kd_gudangAwal)->first();
                if($cekStok->jumlahStok < $request->total_stok){
                    throw ValidationException::withMessages([
                        'total_stok' => 'Stok tidak mencukupi.',
                    ]);
                }
            }else{
                $stokGudangCabang = StokGudangCabang::where('kd_stokGudangUtama', $request->kd_stokGudang)->where('kd_gudang', $request->kd_gudangAwal)->first();
                if($stokGudangCabang->jumlahStok < $request->total_stok){
                    throw ValidationException::withMessages([
                        'total_stok' => 'Stok tidak mencukupi.',
                    ]);
                }
            }

            $transaksiMember = new TransaksiMember();
            $transaksiMember->kd_transaksiMember = $idMenage;
            $transaksiMember->kd_gudangAwal = $request->kd_gudangAwal;
            $transaksiMember->kd_member = $request->idMember;
            $transaksiMember->kd_product = $request->kdProduct;
            $transaksiMember->qty = $request->total_stok;
            $transaksiMember->carier = $request->carier;
            $transaksiMember->harga_kargo = $request->harga_kargo;
            $transaksiMember->status_pengiriman = $request->status_gudang;
            if($transaksiMember->save()){
                $saldoGudang = SaldoGudang::orderBy('kd_saldoGudang', 'desc')->first();
                $saldoGudang->saldo -= $request->harga_kargo;
                $saldoGudang->update();
                if($gudangAwal->identitas == 0){
                    $stokGudang = StokGudangUtama::where('kd_stokGudangUtama', $request->kd_stokGudang)->where('kd_gudang', $request->kd_gudangAwal)->first();
                    $stokGudang->jumlahStok -= $request->total_stok;
                    $stokGudang->update();
                }else{
                    $stokGudang = StokGudangCabang::where('kd_stokGudangUtama', $request->kd_stokGudang)->where('kd_gudang', $request->kd_gudangAwal)->first();
                    $stokGudang->jumlahStok -= $request->total_stok;
                    $stokGudang->update();
                }

                $productPoin = Products::where('kd_product', $request->kdProduct)->first();
                $member = Member::where('kd_member', $request->idMember)->first();
                if($productPoin->category_poin == 'platinum'){
                    $platinum = PoinPlatinum::where('kd_member', $request->idMember)->first();
                    if(!$platinum){
                        $kd = PoinPlatinum::orderBy('kd_poinPlatinum', 'desc')->first();
                        $kdPoin = 'PL-' . date('y') . date('m') . str_pad( ($kd ? intval(substr($kd->kd_poinPlatinum, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
                        $platinum = new PoinPlatinum();
                        $platinum->kd_poinPlatinum = $kdPoin;
                        $platinum->kd_member = $request->idMember;
                        $platinum->platinumAktif += $request->total_stok;
                        $platinum->save();
                    }else{
                        $platinum->platinumAktif += $request->total_stok;
                        $platinum->update();
                    }
                }else{
                    $silver = PoinSilver::where('kd_member', $request->idMember)->first();
                    if(!$silver){
                        $kd = PoinSilver::orderBy('kd_poinSilver', 'desc')->first();
                        $kdPoin = 'SL-' . date('y') . date('m') . str_pad( ($kd ? intval(substr($kd->kd_poinSilver, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
                        $silver = new PoinSilver();
                        $silver->kd_poinSilver = $kdPoin;
                        $silver->kd_member = $request->idMember;
                        $silver->silverAktif += $request->total_stok;
                        $silver->save();
                    }else{
                        $silver->silverAktif += $request->total_stok;
                        $silver->update();
                    }
                }

            }

            DB::commit();
            return redirect()->route('transaksi')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }

    public function pengirimanMember(Request $request){
        try {
            $transaksiMember = TransaksiMember::where('kd_transaksiMember', $request->kd_transaksiMember)->first();
            $transaksiMember->status_pengiriman = $request->status_gudang;
            $transaksiMember->update();

            return redirect()->route('transaksi')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            throw $th;
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }
}
