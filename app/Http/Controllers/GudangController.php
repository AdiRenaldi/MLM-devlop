<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    public function profileGudang()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Profile Gudang',
        ];
        $gudang = Gudang::all();
        return view('pages.gudang.gudang-profile', ['pageConfigs'=>$pageConfigs, 'gudangs'=>$gudang]);
    }

    public function add()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Tambah Gudang',
            'formTarget' => 'gudang-profile-created',
            'pageType' => 'add',
        ];
        return view('pages.gudang.gudang-profile-add', ['pageConfigs'=>$pageConfigs]);
    }

    public function created(Request $request)
    {
        $request->validate([
            'nama_gudang' => 'required',
            'identitas_gudang' => 'required',
            'status_gudang' => 'required',
        ],
        [
            'nama_gudang.required' => 'Nama harus diisi',
            'identitas_gudang.required' => 'Identitas harus diisi',
            'status_gudang.required' => 'Status harus diisi',
        ]);
        $gudang = Gudang::orderBy('kd_gudang', 'desc')->first();
        $ID = 'GD-' . date('y') . date('m') . str_pad( ($gudang ? intval(substr($gudang->kd_gudang, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
        try {
            $gudang = new Gudang();
            $gudang->kd_gudang = $ID;
            $gudang->nama_gudang = $request->nama_gudang;
            $gudang->identitas = $request->identitas_gudang;
            $gudang->status = $request->status_gudang;
            $gudang->save();    
            return redirect()->route("profile-gudang")->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Edit Gudang',
            'formTarget' => 'gudang-profile-updated',
            'pageType' => 'edit',
        ];
        $gudang = Gudang::find($id);
        return view('pages.gudang.gudang-profile-add', ['pageConfigs'=>$pageConfigs, 'gudang'=>$gudang]);
    }

    public function updated(Request $request, $id)
    {
        $request->validate([
            'nama_gudang' => 'required',
            'identitas_gudang' => 'required',
            'status_gudang' => 'required',
        ],
        [
            'nama_gudang.required' => 'Nama harus diisi',
            'identitas_gudang.required' => 'Identitas harus diisi',
            'status_gudang.required' => 'Status harus diisi',
        ]);
        try {
            $gudang = Gudang::where('kd_gudang', $id)->first();
            $gudang->nama_gudang = $request->nama_gudang;
            $gudang->identitas = $request->identitas_gudang;
            $gudang->status = $request->status_gudang;
            $gudang->update();
            return redirect()->route("profile-gudang")->with(['success' => 'Data berhasil disimpan!']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }
}
