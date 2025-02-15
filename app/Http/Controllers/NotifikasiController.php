<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Notifikasi;
use App\Models\NotifikasiMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotifikasiController extends Controller
{
    public function notifikasi(){
        $notifikasi = Notifikasi::orderBy('created_at', 'desc')->get();

        return view('pages.notifikasi.notifikasi', ['notifikasi' => $notifikasi]);
    }

    public function add(){
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Tambah Notifikasi',
            'formTarget' => 'notifikasi-created',
            'pageType' => 'add'
        ];
        return view('pages.notifikasi.notifikasi-add', ['pageConfigs'=>$pageConfigs]);
    }

    public function created(Request $request){
        $request->validate([
            'nama_notifikasi' => 'required',
            'image_notifikasi' => 'nullable',
            'pesan_notifikasi' => 'required',
            'penerima' => 'required|in:0,1,2',
            'member' => 'nullable',
            'poin_silver' => 'nullable|numeric',
            'poin_platinum' => 'nullable|numeric',

            'tipe_notifikasi' => 'required|in:0,1,2',
            'tanggal_eksekusi' => 'nullable|date_format:Y-m-d\TH:i',
            'periode_awal' => 'nullable|date_format:Y-m-d\TH:i',
            'periode_akhir' => 'nullable|date_format:Y-m-d\TH:i',
        ]);

        DB::beginTransaction();
        try{
            $kdNotifikasi = Notifikasi::orderBy('kd_notifikasi', 'desc')->first();
            $ID = 'NS-' . date('y') . date('m') . str_pad( ($kdNotifikasi ? intval(substr($kdNotifikasi->kd_notifikasi, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
            $notifikasi = new Notifikasi();
            $notifikasi->kd_notifikasi = $ID;
            $notifikasi->pesan = $request->pesan_notifikasi;
            $notifikasi->tipe_notif = $request->penerima;
            $notifikasi->waktu_eksekusi = $request->tanggal_eksekusi;
            $notifikasi->waktu_mulai = $request->periode_awal;
            $notifikasi->waktu_selesai = $request->periode_akhir;
            $notifikasi->tipe_pengiriman = $request->tipe_notifikasi;
            if($request->hasFile('image_notifikasi')){
                $file = $request->file('image_notifikasi');
                $filename = $ID . '.' .  $file->getClientOriginalExtension();
                $file->storeAs('images/notifikasi', $filename, 'public');
                $notifikasi->image = $filename;
            }
            $notifikasi->save();

            if($request->penerima === '0'){
                $idMember = Member::pluck('kd_member')->toArray();
                foreach($idMember as $id){
                    $idNotifikasi = NotifikasiMember::orderBy('kd_notifikasi_member', 'desc')->first();
                    $IDNOT = 'NSM-' . date('y') . date('m') . str_pad( ($idNotifikasi ? intval(substr($idNotifikasi->kd_notifikasi_member, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);

                    $notifikasiMember = new NotifikasiMember();
                    $notifikasiMember->kd_notifikasi_member = $IDNOT;
                    $notifikasiMember->kd_notifikasi = $ID;
                    $notifikasiMember->kd_member = $id;
                    $notifikasiMember->status = 0;
                    $notifikasiMember->save();
                }
            } elseif ($request->penerima === '1'){

                $member = Member::where('kd_member', $request->member)->first();

                if (!$member) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Member tidak ditemukan.');
                }

                $idNotifikasi = NotifikasiMember::orderBy('kd_notifikasi_member', 'desc')->first();
                $IDNOT = 'NSM-' . date('y') . date('m') . str_pad( ($idNotifikasi ? intval(substr($idNotifikasi->kd_notifikasi_member, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);

                $notifikasiMember = new NotifikasiMember();
                $notifikasiMember->kd_notifikasi_member = $IDNOT;
                $notifikasiMember->kd_notifikasi = $ID;
                $notifikasiMember->kd_member = $request->member;
                $notifikasiMember->status = 0;
                $notifikasiMember->save();

            } elseif($request->penerima === '2'){

                $idMemberPoin = Member::whereHas('poinPlatinum', function ($query) use ($request) {
                    $query->where('platinumPasif', '>=', $request->poin_platinum);
                })
                ->whereHas('poinSilver', function ($query) use ($request) {
                    $query->where('silverPasif', '>=', $request->poin_silver);
                })
                ->pluck('kd_member')
                ->toArray();

                if (empty($idMemberPoin)) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Tidak ada member yang memenuhi kriteria.');
                }
            

                $idNotifikasi = NotifikasiMember::orderBy('kd_notifikasi_member', 'desc')->first();
                $IDNOT = 'NSM-' . date('y') . date('m') . str_pad( ($idNotifikasi ? intval(substr($idNotifikasi->kd_notifikasi_member, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
                
                foreach ($idMemberPoin as $id) {
                    $idNotifikasi = NotifikasiMember::orderBy('kd_notifikasi_member', 'desc')->first();
                    $IDNOT = 'NS-' . date('y') . date('m') . str_pad(($idNotifikasi ? intval(substr($idNotifikasi->kd_notifikasi_member, 8)) + 1 : 1), 5, '0', STR_PAD_LEFT);
                
                    NotifikasiMember::create([
                        'kd_notifikasi_member' => $IDNOT,
                        'kd_notifikasi' => $ID,
                        'kd_member' => $id,
                        'status' => 0
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('notifikasi-page')->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }
}
