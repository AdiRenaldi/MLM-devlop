<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Products;
use App\Models\SaldoGudang;
use Illuminate\Http\Request;
use App\Models\StokGudangUtama;

class GudangUtamaController extends Controller
{
    public function gudangUtama()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Gudang Utama',
        ];
        $saldo = SaldoGudang::orderBy('kd_saldoGudang', 'desc')->first();
        $stokGudang = StokGudangUtama::with('product')->get();
        return view('pages.gudangUtama.gudangUtama', ['pageConfigs'=>$pageConfigs, 'stokGudang'=>$stokGudang , 'saldo' => $saldo]);
    }

    public function detail($id)
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Detail Gudang Utama',
        ];

        $stokGudang = StokGudangUtama::with('product')->where('kd_stokGudangUtama', $id)->first();
        return view('pages.gudangUtama.gudangUtama-detail', ['pageConfigs'=>$pageConfigs, 'stokGudang'=>$stokGudang]);
    }

    public function add()
    {
        $pageConfigs = [
            'title' => 'Tambah Stok',
            'formTarget' => 'gudang-utama-stok-created',
            'pageType' => 'add',
        ];
        $products = Products::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('pages.gudangUtama.gudangUtama-add', ['pageConfigs'=>$pageConfigs, 'products'=>$products]);
    }

    public function tambahSaldo(Request $request)
    {
        $request->validate([
            'saldo' => 'required|numeric',
        ],[
            'saldo.required' => 'Jumlah saldo harus diisi',
            'saldo.numeric' => 'Jumlah saldo harus angka',
        ]);
        try {
            $kd_saldo = SaldoGudang::orderBy('kd_saldoGudang', 'desc')->first();
            $ID = 'SGD-' . date('y') . date('m') . str_pad( ($kd_saldo ? intval(substr($kd_saldo->kd_saldoGudang, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);

            SaldoGudang::create([
                'kd_saldoGudang' => $ID,
                'saldo' => $request->saldo,
            ]);

            return redirect()->route("gudang-utama")->with(['success' => 'Data berhasil ditambahkan!']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }

    public function created(Request $request)
    {
        $request->validate([
            'jumlah_stok' => 'required|numeric',
            'stok_masuk' => 'required|date',
            'masa_expire' => 'required|date',
        ],[
            'jumlah_stok.required' => 'Jumlah stok harus diisi',
            'jumlah_stok.numeric' => 'Jumlah stok harus angka',
            'stok_masuk.required' => 'Stok harus diisi',
            'stok_masuk.date' => 'Stok harus tanggal',
            'masa_expire.required' => 'Masa expire harus diisi',
            'masa_expire.date' => 'Masa Expire harus tanggal',
        ]);
        try {
            $kd_stokGudangUtama = StokGudangUtama::orderBy('kd_stokGudangUtama', 'desc')->first();
            $ID = 'PGU-' . date('y') . date('m') . str_pad( ($kd_stokGudangUtama ? intval(substr($kd_stokGudangUtama->kd_stokGudangUtama, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
            $gudang = Gudang::where('identitas', '0')->first();

            $stokGudangUtama = new StokGudangUtama();
            $stokGudangUtama->kd_stokGudangUtama = $ID;
            $stokGudangUtama->kd_product = $request->kd_product;
            $stokGudangUtama->kd_gudang = $gudang->kd_gudang;
            $stokGudangUtama->stokMasuk = $request->stok_masuk;
            $stokGudangUtama->masaExpire = $request->masa_expire;
            $stokGudangUtama->jumlahStok = $request->jumlah_stok;
            $stokGudangUtama->stokLokasi = $request->stok_lokasi;
            $stokGudangUtama->deskripsi = $request->deskripsi;
            $stokGudangUtama->save();

            return redirect()->route('gudang-utama')->with(['success' => 'Data berhasil ditambahkan!']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menambahkan data: ' . $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Edit Produk',
            'formTarget' => 'gudang-utama-updated',
            'pageType' => 'edit',
        ];
        $products = Products::where('status', 1)
                ->orderBy('created_at', 'desc')
                ->get();

        $stokGudang = StokGudangUtama::with('product')->where('kd_stokGudangUtama', $id)->first();

        return view('pages.gudangUtama.gudangUtama-add', ['pageConfigs'=>$pageConfigs, 'stokGudang'=>$stokGudang, 'products'=>$products]);
    }

    public function updated(Request $request, $id)
    {  
        $request->validate([
            'jumlah_stok' => 'required|numeric',
            'stok_masuk' => 'required|date',
            'masa_expire' => 'required|date',
        ],[
            'jumlah_stok.required' => 'Jumlah stok harus diisi',
            'jumlah_stok.numeric' => 'Jumlah stok harus angka',
            'stok_masuk.required' => 'Stok harus diisi',
            'stok_masuk.date' => 'Stok harus tanggal',
            'masa_expire.required' => 'Masa expire harus diisi',
            'masa_expire.date' => 'Masa Expire harus tanggal',
        ]);
        $gudangUtama = StokGudangUtama::where('kd_stokGudangUtama', $id)->first();
        try {
            $gudangUtama->kd_product = $request->kd_product;
            $gudangUtama->stokMasuk = $request->stok_masuk;
            $gudangUtama->masaExpire = $request->masa_expire;
            $gudangUtama->jumlahStok = $request->jumlah_stok;
            $gudangUtama->deskripsi = $request->deskripsi;
            $gudangUtama->stokLokasi = $request->stok_lokasi;
            $gudangUtama->update();

            return redirect()->route("gudang-utama")->with(['success' => 'Data berhasil diubah!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }

    public function deleted($id){
        try {
            $product = StokGudangUtama::where('kd_stokGudangUtama', $id)->first();
            if (!$product) {
                return redirect()->route("gudang-utama")->withErrors(['error' => 'Data tidak ditemukan.']);
            }
            $product->delete();
            return redirect()->route("gudang-utama")->with(['success' => 'Data berhasil dihapus!']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $th->getMessage()]);
        }
    }




}
