<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Api\UserMember;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Pangkat;
use App\Models\Provinsi;
use App\Models\Reward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function member()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Member',
        ];

        $members = Member::with(['userMember', 'rewards', 'poinPlatinum', 'poinSilver', 'pangkat']);

        if (request()->has('cari_member')) {
            // $members->where('namaLengkap', 'like', '%'.request()->cari_member.'%');

            $members->where('namaLengkap', 'like', '%'.request()->cari_member.'%')
                ->orWhere('kd_member', 'like', '%'.request()->cari_member.'%');
        }



        $reward = Reward::where('tanggalBerakhir', '>=', now())->get();
        return view('pages.member.member', ['pageConfigs'=>$pageConfigs, 'members'=>$members->get(), 'reward'=>$reward]);
    }

    public function detail($id)
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Detail Member',
        ];

        $member = Member::with(['userMember','poinPlatinum', 'poinSilver', 'pangkat', 'rewards', 'provinsi', 'kabupaten', 'kecamatan'])->where('kd_member', $id)->first();

        return view('pages.member.member-detail', ['pageConfigs'=>$pageConfigs, 'member'=>$member]);
    }

    // ajax
    public function kabupaten($id){
        $kabupaten = Kabupaten::where('provinsi_id', $id)->get();
        return response()->json($kabupaten);
    }
    public function kecamatan($id){
        $kecamatan = Kecamatan::where('kabupaten_id', $id)->get();
        return response()->json($kecamatan);
    }

    public function pencarianLanjutan()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Pencarian',
            'formTarget' => 'member-pencarianLanjutan',
        ];
        return view('pages.member.member-pencarianLanjutan', ['pageConfigs'=>$pageConfigs]);
    }

    public function Reward()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Reward Member',
            'formTarget' => 'member-reward',
        ];
        return view('pages.member.member-reward', ['pageConfigs'=>$pageConfigs]);
    }

    public function add()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Tambah Member Ready',
            'formTarget' => 'member-created',
            'pageType' => 'add',
        ];
        $pangkat = Pangkat::all();
        $provinsi = Provinsi::all();
        return view('pages.member.member-add', ['pageConfigs'=>$pageConfigs, 'pangkat'=>$pangkat, 'provinsi'=>$provinsi]);
    }
    public function addNew()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Tambah Member Baru',
            'formTarget' => 'member-created',
            'pageType' => 'addNew',
        ];
        $pangkat = Pangkat::all();
        $provinsi = Provinsi::all();
        return view('pages.member.member-add', ['pageConfigs'=>$pageConfigs, 'pangkat'=>$pangkat, 'provinsi'=>$provinsi]);
    }

    public function created(Request $request)
    {
        $request->validate([
            'namaLengkap' => 'required',
            'email' => 'required|email|unique:user_member,email',
            'password' => 'required|string|min:8',
            'passwordConfirm' => 'required|same:password',
            'nomorHp' => 'required|numeric|unique:member,nohp|min_digits:11|max_digits:13',
            'nomorWa' => 'required|numeric|unique:member,nowhatsapp|min_digits:11|max_digits:13',
            'pangkat' => 'required',
            'upline_utama' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kodePos' => 'required|numeric',
        ],[
            'namaLengkap.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak sesuai',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password terlalu pendek',
            'passwordConfirm.required' => 'Konfirmasi password harus diisi',
            'passwordConfirm.same' => 'Password tidak sama',
            'nomorHp.required' => 'Nomor hp harus diisi',
            'nomorHp.numeric' => 'Nomor hp harus angka',
            'nomorHp.unique' => 'Nomor hp sudah terdaftar',
            'nomorHp.min_digits' => 'Nomor hp terlalu pendek',
            'nomorHp.max_digits' => 'Nomor hp terlalu panjang',
            'nomorWa.required' => 'Nomor whatsapp Harus Diisi',
            'nomorWa.numeric' => 'Nomor whatsapp harus angka',
            'nomorWa.unique' => 'Nomor whatsapp sudah terdaftar',
            'nomorWa.min_digits' => 'Nomor whatsapp terlalu pendek',
            'nomorWa.max_digits' => 'Nomor whatsapp terlalu panjang',
            'pangkat.required' => 'Pangkat harus diisi',
            'upline_utama.required' => 'Upline utama harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'provinsi.required' => 'Provinsi harus diisi',
            'kabupaten.required' => 'Kabupaten harus diisi',
            'kecamatan.required' => 'Kecamatan harus diisi',
            'kodePos.required' => 'Kode pos harus diisi',
            'kodePos.numeric' => 'Kode pos harus angka',
        ]);

        $kd_admin = Auth::user()->kd_user;

        do {
            $date = now()->format('ymd');
            $random = mt_rand(10, 99);
            $ID = $date . $random;
        } while (Member::where('kd_member', $ID)->exists());

        try {
            DB::beginTransaction();

            $member = new Member();
            $member->kd_member = $ID;
            $member->namaLengkap = $request->namaLengkap;
            $member->kd_pangkat = $request->pangkat;
            $member->kd_upline = $request->upline_utama;   
            if ($request->upline_atasan){
                $member->kd_atasan = $request->upline_atasan;
            }else{
                $member->kd_atasan = $request->upline_utama;
            }
            $member->nohp = $request->nomorHp;
            $member->nowhatsapp = $request->nomorWa;
            $member->provinsi_id = $request->provinsi;
            $member->kabupaten_id = $request->kabupaten;
            $member->kecamatan_id = $request->kecamatan;
            $member->kodepos = $request->kodePos;
            $member->alamat = $request->alamat;
            
            if($member->save()){
                $member= UserMember::create([
                    'kd_user_member' => $ID,
                    'kd_member' => $ID,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            }

            DB::commit();

            return redirect()->route("member-page")->with(['success' => 'Data berhasil ditambahkan!']);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }

    public function edit($id){
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Edit Member',
            'formTarget' => 'member-updated',
            'pageType' => 'edit',
        ];
        $member = Member::with(['pangkat','provinsi','kabupaten','kecamatan'])->where('kd_member', $id)->first();
        $provinsi = Provinsi::all();
        $kabupaten = Kabupaten::where('provinsi_id', $member->provinsi->id)->get();
        $pangkat = Pangkat::all();
        $kecamatan = Kecamatan::where('kabupaten_id', $member->kabupaten->id)->get();

        return view('pages.member.member-add', ['pageConfigs'=>$pageConfigs, 'member'=>$member, 'pangkat'=>$pangkat, 'provinsi'=>$provinsi, 'kabupaten'=>$kabupaten, 'kecamatan'=>$kecamatan]);
    }

    public function updated(Request $request, $id){
        $request->validate([
            'namaLengkap' => 'required',
            'nomorHp' => [
                'required',
                'numeric',
                'min:11',
                Rule::unique('member', 'nohp')->ignore($id, 'kd_member'),
            ],
            'nomorWa' => [
                'required',
                'numeric',
                'min:11',
                Rule::unique('member', 'nowhatsapp')->ignore($id, 'kd_member'),
            ],
            'pangkat' => 'required',
            'alamat' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kodePos' => 'required|numeric',
        ],[
            'namaLengkap.required' => 'Nama harus diisi',
            'nomorHp.required' => 'Nomor hp harus diisi',
            'nomorHp.numeric' => 'Nomor hp harus angka',
            'nomorHp.unique' => 'Nomor hp sudah terdaftar',
            'nomorHp.min' => 'Nomor hp terlalu pendek',
            'nomorHp.max' => 'Nomor hp terlalu panjang',
            'nomorWa.required' => 'Nomor whatsapp Harus Diisi',
            'nomorWa.numeric' => 'Nomor whatsapp harus angka',
            'nomorWa.unique' => 'Nomor whatsapp sudah terdaftar',
            'nomorWa.min' => 'Nomor whatsapp terlalu pendek',
            'nomorWa.max' => 'Nomor whatsapp terlalu panjang',
            'pangkat.required' => 'Pangkat harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'provinsi.required' => 'Provinsi harus diisi',
            'kabupaten.required' => 'Kabupaten harus diisi',
            'kecamatan.required' => 'Kecamatan harus diisi',
            'kodePos.required' => 'Kode pos harus diisi',
            'kodePos.numeric' => 'Kode pos harus angka',
        ]);
        $member = Member::where('kd_member', $id)->first();
        try {
            DB::beginTransaction();

            $member->namaLengkap = $request->namaLengkap;
            $member->kd_pangkat = $request->pangkat;
            $member->nohp = $request->nomorHp;
            $member->nowhatsapp = $request->nomorWa;
            $member->alamat = $request->alamat;
            $member->provinsi_id = $request->provinsi;
            $member->kabupaten_id = $request->kabupaten;
            $member->kecamatan_id = $request->kecamatan;
            $member->kodepos = $request->kodePos;
            $member->update();

            DB::commit();
            return redirect()->route("member-page")->with(['success' => 'Data berhasil diubah!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data: ' . $th->getMessage()]);
        }
    }

    public function deleted($id){
        try {
            $member = Member::where('kd_member', $id)->first();
            if (!$member) {
                return redirect()->route("member-page")->withErrors(['error' => 'Data tidak ditemukan.']);
            }
            $member->delete();
            return redirect()->route("member-page")->with(['success' => 'Data berhasil dihapus!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $th->getMessage()]);
        }
    }

    public function jaringan($id){
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Jaringan Member',
        ];
        $member = Member::with(['upline', 'downlines', 'atasan', 'bawahans','pangkat'])->find($id);
        return view('pages.member.jaringan-member', ['pageConfigs'=>$pageConfigs, 'member'=>$member]);
    }
}
