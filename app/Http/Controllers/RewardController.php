<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Reward;
use App\Models\RewardMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RewardController extends Controller
{
    public function reward (){
        $rewards = Reward::orderBy('tanggalPembuatan', 'desc')->get();
        return view('pages.reward.reward', ['rewards'=>$rewards]);
    }

    public function add(){
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Tambah Reward',
            'formTarget' => 'reward-created',
            'pageType' => 'add',
        ];
        return view('pages.reward.reward-add', ['pageConfigs'=>$pageConfigs]);
    }

    public function created(Request $request){
        $request->validate([
            'nama_reward' => 'required',
            'jumlah_reward' => 'required|numeric',
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date',
            'point_silver' => 'required|numeric',
            'point_platinum' => 'required|numeric',
            'image_reward' => 'required|image',
            'deskripsi' => 'required',
        ],[
            'nama_reward.required' => 'Nama reward harus diisi',
            'jumlah_reward.required' => 'Jumlah reward harus diisi',
            'jumlah_reward.numeric' => 'Jumlah reward harus angka',
            'periode_awal.required' => 'Periode awal harus diisi',
            'periode_awal.date' => 'Periode awal harus tanggal',
            'periode_akhir.required' => 'Periode akhir harus diisi',
            'periode_akhir.date' => 'Periode akhir harus tanggal',
            'point_silver.required' => 'Point silver harus diisi',
            'point_silver.numeric' => 'Point silver harus angka',
            'point_platinum.required' => 'Point platinum harus diisi',
            'point_platinum.numeric' => 'Point platinum harus angka',
            'image_reward.required' => 'Image reward harus diisi',
            'image_reward.image' => 'Image reward harus gambar',
            'deskripsi.required' => 'Deskripsi harus diisi',
        ]);

        try{
            $kd_reward = Reward::orderBy('kd_reward', 'desc')->first();
            $ID = 'RWD-' . date('y') . date('m') . str_pad( ($kd_reward ? intval(substr($kd_reward->kd_reward, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
            $reward = new Reward();
            $reward->kd_reward = $ID;
            $reward->nama = $request->nama_reward;
            $reward->qty = $request->jumlah_reward;
            $reward->tanggalPembuatan = $request->periode_awal;
            $reward->tanggalBerakhir = $request->periode_akhir;
            $reward->point_silver = $request->point_silver;
            $reward->point_platinum = $request->point_platinum;
            $reward->deskripsi = $request->deskripsi;

            if ($request->hasFile('image_reward')) {
                $image = $request->file('image_reward');
                $imageName = $ID . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/reward', $imageName, 'public');
                $reward->image = $imageName;
            }
            $reward->save();
            return redirect()->route('reward-page')->with('success', 'Reward berhasil ditambahkan');
        }catch(\Throwable $th){
            return redirect()->route('reward-page')->with('error', 'Reward gagal ditambahkan');
        }
    }

    public function edit($id)
    {
        $pageConfigs = [
            'pageHeader' => true,
            'title' => 'Edit Reward',
            'formTarget' => 'reward-updated',
            'pageType' => 'edit',
        ];
        $reward = Reward::where('kd_reward', $id)->first();
        // dd($reward);
        return view('pages.reward.reward-add', ['pageConfigs'=>$pageConfigs, 'reward'=>$reward]);
    }

    public function updated(Request $request, $id){
        $request->validate([
            'nama_reward' => 'required',
            'jumlah_reward' => 'required|numeric',
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date',
            'point_silver' => 'required|numeric',
            'point_platinum' => 'required|numeric',
            'deskripsi' => 'required',
        ],[
            'nama_reward.required' => 'Nama reward harus diisi',
            'jumlah_reward.required' => 'Jumlah reward harus diisi',
            'jumlah_reward.numeric' => 'Jumlah reward harus angka',
            'periode_awal.required' => 'Periode awal harus diisi',
            'periode_awal.date' => 'Periode awal harus tanggal',
            'periode_akhir.required' => 'Periode akhir harus diisi',
            'periode_akhir.date' => 'Periode akhir harus tanggal',
            'point_silver.required' => 'Point silver harus diisi',
            'point_silver.numeric' => 'Point silver harus angka',
            'point_platinum.required' => 'Point platinum harus diisi',
            'point_platinum.numeric' => 'Point platinum harus angka',
            'deskripsi.required' => 'Deskripsi harus diisi',
        ]);
        try{
            $reward = Reward::where('kd_reward', $id)->first();
            $reward->nama = $request->nama_reward;
            $reward->qty = $request->jumlah_reward;
            $reward->tanggalPembuatan = $request->periode_awal;
            $reward->tanggalBerakhir = $request->periode_akhir;
            $reward->point_silver = $request->point_silver;
            $reward->point_platinum = $request->point_platinum;
            $reward->deskripsi = $request->deskripsi;

            if ($request->hasFile('image_reward')) {
                $imageName = $request->file('image_reward')->getClientOriginalName();
                if(!empty($reward->image)){
                    Storage::delete('images/reward/' . $reward->image);
                }
                $imageNow = $reward->kd_reward . '.' . $request->file('image_reward')->getClientOriginalExtension();
                $request->file('image_reward')->storeAs('images/reward', $imageNow);
                $reward->image = $imageNow;
            }
            $reward->update();
            return redirect()->route('reward-page')->with('success', 'Reward berhasil diperbarui');
        }catch(\Throwable $th){
            return redirect()->route('reward-page')->with('error', 'Reward gagal diperbarui');
        }
    }   

    public function deleted($id){
        try {
            $reward = Reward::where('kd_reward', $id)->first();
            if (!$reward) {
                return redirect()->route("reward-page")->withErrors(['error' => 'Data tidak ditemukan.']);
            }
            if (!empty($reward->image)) {
                Storage::delete('images/reward/' . $reward->image);
            }
            $reward->delete();
            return redirect()->route("reward-page")->with(['success' => 'Data berhasil dihapus!']);
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data: ' . $th->getMessage()]);
        }
    }

    public function beriReward(Request $request){
        $ids = $request->input('memberIds');
        $rewards = $request->input('rewards');
        if (!is_array($ids)) {
            return response()->json(['error' => 'Invalid input'], 400);
        }
        $members = Member::whereIn('kd_member', $ids)
                ->with(['poinSilver', 'poinPlatinum'])
                ->get();
        if (empty($members)) {
            return response()->json(['message' => 'No valid members found'], 404);
        }
        try {
            foreach ($members as $memberId) {
                $reward = Reward::where('kd_reward', $rewards)->first();
                if (!$memberId->poinSilver || !$memberId->poinPlatinum) {
                    continue;
                }
                foreach ($rewards as $rewardId) {
                    $reward = Reward::where('kd_reward', $rewardId)->first();
            
                    // Pastikan poin cukup untuk ditukar dengan reward
                    if ($memberId->poinSilver->silverPasif >= $reward->point_silver && $memberId->poinPlatinum->platinumPasif >= $reward->point_platinum) {
                        $kd_rewardMember = RewardMember::orderBy('kd_rewardMember', 'desc')->first();
                        $ID = 'RM-' . date('y') . date('m') . str_pad(($kd_rewardMember ? intval(substr($kd_rewardMember->kd_rewardMember, 8)) + 1 : 1), 5, '0', STR_PAD_LEFT);
            
                        $rewardMember = new RewardMember();
                        $rewardMember->kd_rewardMember = $ID;
                        $rewardMember->kd_reward = $rewardId;
                        $rewardMember->kd_member = $memberId->kd_member;

                        if($rewardMember->save()){
                            $memberId->poinSilver->silverPasif -= $reward->point_silver;
                            $memberId->poinPlatinum->platinumPasif -= $reward->point_platinum;
                            $memberId->poinSilver->update();
                            $memberId->poinPlatinum->update();
                        }
                        $reward = Reward::where('kd_reward', $rewardId)->first();
                        $reward->qty -= 1;
                        $reward->update();
                    }
                }
            }
            
    
            return response()->json(['message' => 'successfully'], 200);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['error' => 'Failed: ' . $th->getMessage()], 500);
        }
    }
}