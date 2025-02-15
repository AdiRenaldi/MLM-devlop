<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    public function promo(){
        // $promo = Promo::all();
        $promo = Promo::orderByDesc('type')->get();

        
        return view('pages.promo.promo', ['promo'=>$promo]);
    }

    public function detail($id){
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Detail Promo',
        ];
        $promo = Promo::where('kd_promo', $id)->first();
        return view('pages.promo.promo-detail', ['pageConfigs'=>$pageConfigs, 'promo'=>$promo]);
    }

    public function add(){
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Tambah Promo',
            'formTarget' => 'promo-created',
            'pageType' => 'add',
        ];
        return view('pages.promo.promo-add', ['pageConfigs'=>$pageConfigs]);
    }

    public function created(Request $request){
        $request->validate([
            'nama_promo' => 'required',
            'image_promo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'deskripsi' => 'required',
        ],[
            'nama_promo.required' => 'Nama promo harus diisi',
            'image_promo.required' => 'Image promo harus diisi',
            'image_promo.image' => 'Harus file gambar',
            'image_promo.mimes' => 'Gambar harus berformat jpeg,png,jpg,gif,svg',
            'image_promo.max' => 'Gambar maksimal 1 MB',
            'deskripsi.required' => 'Deskripsi harus diisi',
        ]);


        try {
            $kd_promo = Promo::orderBy('kd_promo', 'desc')->first();
            $ID = 'PRO-' . date('y') . date('m') . str_pad( ($kd_promo ? intval(substr($kd_promo->kd_promo, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
            $promo = new Promo();
            $promo->kd_promo = $ID;
            $promo->nama_promo = $request->nama_promo;
            $promo->deskripsi = $request->deskripsi;
            
            if ($request->hasFile('image_promo')) {
                $file = $request->file('image_promo');
                $filename = $ID . '.' . $file->getClientOriginalExtension();
                $file->storeAs('images/promo', $filename, 'public');
                $promo->gambar = $filename;
            }

            $promo->save();
            return redirect()->route('promo-page')->with('success', 'Promo berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('promo-page')->with('error', 'Promo gagal ditambahkan');
        }
    }

    public function edit($id){
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Edit Promo',
            'formTarget' => 'promo-updated',
            'pageType' => 'edit',
        ];
        $promo = Promo::where('kd_promo', $id)->first();
        return view('pages.promo.promo-add', ['pageConfigs'=>$pageConfigs, 'promo'=>$promo]);
    }

    public function updated(Request $request, $id){
        $request->validate([
            'nama_promo' => 'required',
            'image_promo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'deskripsi' => 'required',
        ],[
            'nama_promo.required' => 'Nama promo harus diisi',
            'image_promo.image' => 'Harus file gambar',
            'image_promo.mimes' => 'Gambar harus berformat jpeg,png,jpg,gif,svg',
            'image_promo.max' => 'Gambar maksimal 1 MB',
            'deskripsi.required' => 'Deskripsi harus diisi',
        ]);

        try {
            $promo = Promo::where('kd_promo', $id)->first();
            $promo->nama_promo = $request->nama_promo;
            $promo->deskripsi = $request->deskripsi;
            if ($request->hasFile('image_promo')) {
                if (!empty($promo->gambar)) {
                    Storage::delete('images/promo/' . $promo->gambar);
                }
                $imageNow = $promo->kd_promo . '.' . $request->file('image_promo')->getClientOriginalExtension();
                $request->file('image_promo')->storeAs('images/promo', $imageNow);
                $promo->gambar = $imageNow;
            }
            $promo->update();
            return redirect()->route('promo-page')->with('success', 'Promo berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('promo-page')->with('error', 'Promo gagal diupdate');
        }
    }

    public function deleted($id){
        try {
            $promo = Promo::where('kd_promo', $id)->first();
            if (!$promo) {
                return redirect()->route("promo-page")->withErrors(['error' => 'Data tidak ditemukan.']);
            }
            if (!empty($promo->gambar)) {
                Storage::delete('images/promo/' . $promo->gambar);
            }
            $promo->delete();
            return redirect()->route("promo-page")->with(['success' => 'Data berhasil dihapus!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $th->getMessage()]);
        }
    }

    public function tampilDashboard(Request $request){
        try {
            $promo = Promo::find($request->kd_promo);

            if($request->type == '1'){
                $cek = Promo::where('type', '1')->where('kd_promo', '!=', $request->kd_promo)->first();
                if($cek){
                    $cek->update([
                        'type' => '0',
                    ]);
                }
                $promo->update([
                    'type' => $request->type,
                ]);
            }else{
                $promo->update([
                    'type' => $request->type,
                ]);
            }

            return redirect()->route('promo-page')->with('success', 'Status promo berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('promo-page')->with('error', 'Status promo gagal diupdate');
        }
    }

    public function tampilSlide(Request $request){
        try {
            $promo = Promo::find($request->kd_promo);
            $promo->update([
                'status' => $request->status,
            ]);
            return redirect()->route('promo-page')->with('success', 'Status promo berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('promo-page')->with('error', 'Status promo gagal diupdate');
        }
    }
}
