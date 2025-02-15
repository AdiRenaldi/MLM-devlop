<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    public function pangkat()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Pangkat',
        ];
        $pangkats = Pangkat::all();
        return view('pages.pangkat.pangkat', ['pageConfigs'=>$pageConfigs, 'pangkats'=>$pangkats]);
    }

    public function add()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Pangkat',
            'formTarget' => 'pangkat-created',
            'pageType' => 'add',
        ];
        return view('pages.pangkat.pangkat-add', ['pageConfigs'=>$pageConfigs]);
    }

    public function created(Request $request)
    {
        $request->validate([
            'nama_pangkat' => 'required',
        ],
        [
            'nama_pangkat.required' => 'Pangkat harus diisi',
        ]);

        try {
            $kd_pangkat = Pangkat::orderBy('kd_pangkat', 'desc')->first();
            $ID = 'PT-' . date('y') . date('m') . str_pad( ($kd_pangkat ? intval(substr($kd_pangkat->kd_pangkat, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
            $pangkat = new Pangkat();
            $pangkat->kd_pangkat = $ID;
            $pangkat->nama_pangkat = $request->nama_pangkat;
            $pangkat->save();
            return redirect()->route('pangkat-page')->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Pangkat',
            'formTarget' => 'pangkat-updated',
            'pageType' => 'edit',
        ];
        $pangkat = Pangkat::where('kd_pangkat', $id)->first();
        return view('pages.pangkat.pangkat-add', ['pageConfigs'=>$pageConfigs, 'pangkat'=>$pangkat]);
    }

    public function updated(Request $request, $id)
    {
        $request->validate([
            'nama_pangkat' => 'required',
        ],
        [
            'nama_pangkat.required' => 'Pangkat harus diisi',
        ]);

        try {
            $pangkat = Pangkat::where('kd_pangkat', $id)->first();
            $pangkat->nama_pangkat = $request->nama_pangkat;
            $pangkat->update();
            return redirect()->route('pangkat-page')->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }

    public function deleted($id){
        try {
            $pangkat = Pangkat::where('kd_pangkat', $id)->first();
            if (!$pangkat) {
                return redirect()->route("pangkat-page")->withErrors(['error' => 'Data tidak ditemukan.']);
            }
            $pangkat->delete();
            return redirect()->route("pangkat-page")->with(['success' => 'Data berhasil dihapus!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $th->getMessage()]);
        }
    }
}
