<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\LaporPoin;
use App\Models\PoinPlatinum;
use App\Models\PoinSilver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporPoinController extends Controller
{
    private function formatLaporan($laporan)
    {
        $typePoinMap = [
            0 => 'Platinum',
            1 => 'Silver',
        ];
        return [
            'kd_laporan' => $laporan->kd_lapor_poin,
            'kd_member' => $laporan->kd_member,
            'kd_atasan' => $laporan->kd_atasan,
            'kd_upline' => $laporan->kd_upline,
            'nama_member' => $laporan->member->namaLengkap,
            'nama_atasan' => $laporan->atasan->namaLengkap,
            'nama_upline' => $laporan->upline->namaLengkap,
            'type_poin' => $laporan->type_poin,
            'nama_poin' => $typePoinMap[$laporan->type_poin] ?? 'Unknown',
            'jumlah_poin' => $laporan->jumlah_poin,
            'tanggal_transaksi' => $laporan->tanggal_transaksi,
            'status' => $laporan->status,
            'persetujuan_atasan' => $laporan->persetujuan_atasan,
            'verifikasi_upline' => $laporan->verifikasi_upline,
        ];
    }


    public function laporPoin(Request $request)
    {
        $request->validate([
            'kd_upline' => 'required|exists:member,kd_member',
            'kd_atasan' => 'required|exists:member,kd_member',
            'type_poin' => 'required',
            'jumlah_poin' => 'required|integer|min:1',
            'tanggal_transaksi' => 'required|date',
        ],[
            'kd_upline.required' => 'Upline harus diisi',
            'kd_upline.exists' => 'Upline tidak ditemukan',
            'kd_atasan.required' => 'Atasan harus diisi',
            'kd_atasan.exists' => 'Atasan tidak ditemukan',
            'type_poin.required' => 'Type poin harus diisi',
            // 'type_poin.in' => 'Type poin tidak valid',
            'jumlah_poin.required' => 'Jumlah poin harus diisi',
            'jumlah_poin.integer' => 'Jumlah poin harus angka',
            'jumlah_poin.min' => 'Jumlah poin minimal 1',
            'tanggal_transaksi.required' => 'Tanggal transaksi harus diisi',
            'tanggal_transaksi.date' => 'Tanggal transaksi harus berupa tanggal',
        ]);

        DB::beginTransaction();
        try {
            $user = $request->user();
            $laporPoin = LaporPoin::orderBy('kd_lapor_poin', 'desc')->first();
            $ID = 'LP-' . date('y') . date('m') . str_pad( ($laporPoin ? intval(substr($laporPoin->kd_lapor_poin, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
            $laporan = LaporPoin::create([
                'kd_lapor_poin' => $ID,
                'kd_member' => $user->kd_member,
                'kd_upline' => $request->kd_upline,
                'kd_atasan' => $request->kd_atasan,
                'type_poin' => $request->type_poin,
                'jumlah_poin' => $request->jumlah_poin,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'status' => '0',
                'verifikasi_upline' => '0',
                'persetujuan_atasan' => '0',
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'statusCode' => 201,
                'message' => 'Laporan poin berhasil disimpan',
                'result' => $this->formatLaporan($laporan),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'statusCode' => 500,
                'message' => 'Terjadi kesalahan tidak terduga',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getLaporPoin(Request $request)
    {
        $member = $request->user();
        $laporans = LaporPoin::with('member', 'upline', 'atasan')
        ->where('kd_member', $member->kd_member)
        ->orderBy('created_at', 'desc')
        ->get();

        if($laporans->isEmpty()){
            return response()->json([
                'success' => false,
                'statusCode' => 404,
                'message' => "Data lapor poin tidak ada",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'message' => 'Data laporan poin ditemukan',
            'result' => collect($laporans)->map(fn($item) => $this->formatLaporan($item)),
        ], 200);
    }

    public function getVerifikasiPoin(Request $request)
    {
        $upline = $request->user();

        $laporans = LaporPoin::with('member', 'upline')
        ->where('kd_upline', $upline->kd_member)
        ->where('verifikasi_upline', '0')
        ->orderBy('created_at', 'desc')
        ->get();

        if ($laporans->isEmpty()) {
            return response()->json([
                'success' => false,
                'statusCode' => 404,
                'message' => "Tidak ada laporan yang perlu diverifikasi",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'message' => "Laporan yang perlu diverifikasi",
            'result' => collect($laporans)->map(fn($item) => $this->formatLaporan($item)),
        ], 200);
    }

    public function verifikasiUpline(Request $request)
    {
        $id = $request->query('laporan');
        DB::beginTransaction();
        try {
            $laporan = LaporPoin::findOrFail($id);
            if ($laporan->verifikasi_upline !== '0') {
                return response()->json([
                    'success' => false,
                    'statusCode' => 400,
                    'message' => 'Laporan sudah diverifikasi oleh upline.',
                ], 400);
            }

            if ($request->status == '1') {
                $laporan->update(['verifikasi_upline' => '1']);
                $message = 'Laporan diverifikasi oleh upline.';
    
                // if ($laporan->persetujuan_atasan === '1') {
                //     $laporan->update(['status' => '1']);
                //     $message = 'Laporan disetujui sepenuhnya.';
                // } elseif ($laporan->persetujuan_atasan === '2') {
                //     $laporan->update(['status' => '2']);
                //     $message = 'Laporan ditolak sepenuhnya.';
                // } else {
                //     $message = 'Laporan diverifikasi oleh upline, menunggu persetujuan atasan.';
                // }
            } else {
                $laporan->update([
                    'verifikasi_upline' => '2',
                    'status' => '2'
                ]);
                $message = 'Laporan ditolak oleh upline.';
            }
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'statusCode' => 200,
                'message' => $message,
                'result' => $this->formatLaporan($laporan),
            ], 200);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'statusCode' => 500,
                'message' => 'Terjadi kesalahan pada server. Silakan coba lagi nanti.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    


    public function getSetujuPoin(Request $request)
    {
        $atasan = $request->user();

        $laporans = LaporPoin::with('member', 'atasan')
        ->where('kd_atasan', $atasan->kd_member)
        ->where('verifikasi_upline', '1')
        ->where('persetujuan_atasan', '0')
        ->orderBy('created_at', 'desc')
        ->get();

        if ($laporans->isEmpty()) {
            return response()->json([
                'success' => false,
                'statusCode' => 404,
                'message' => "Tidak ada laporan yang perlu diverifikasi",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'message' => "Laporan yang perlu diverifikasi",
            'result' => collect($laporans)->map(fn($item) => $this->formatLaporan($item)),
        ], 200);
    }

    public function persetujuanAtasan(Request $request)
    {
        $id = $request->query('laporan');
        DB::beginTransaction();
        try {
            $laporan = LaporPoin::findOrFail($id);
            
            if ($laporan->persetujuan_atasan !== '0') {
                return response()->json([
                    'success' => false,
                    'statusCode' => 400,
                    'message' => 'Laporan sudah disetujui oleh atasan.',
                ], 400);
            }

            if ($request->status == '1') {
                $laporan->update(['persetujuan_atasan' => '1']);

                if ($laporan->verifikasi_upline === '1') {
                    $laporan->update(['status' => '1']);

                    if($laporan->type_poin === '0'){
                        $tipePoin = PoinPlatinum::where('kd_member', $laporan->kd_member)->first();
                        if($tipePoin){
                            $tipePoin->update([
                                'platinumAktif' => $tipePoin->platinumAktif + $laporan->jumlah_poin
                            ]);
                        }else{
                            $kdPoinPlatinum = PoinPlatinum::orderBy('kd_poinPlatinum', 'desc')->first();
                            $ID = 'PP-' . date('y') . date('m') . str_pad( ($kdPoinPlatinum ? intval(substr($kdPoinPlatinum->kd_poinPlatinum, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
                            PoinPlatinum::create([
                                'kd_poinPlatinum' => $ID,
                                'kd_member' => $laporan->kd_member,
                                'platinumAktif' => $laporan->jumlah_poin,
                                'platinumPasif' => 0,
                            ]);
                        }
                        $poinAtasan = PoinPlatinum::where('kd_member', $laporan->kd_atasan)->first();
                        if($poinAtasan){
                            $poinAtasan->update([
                                'platinumAktif' => $poinAtasan->platinumAktif - $laporan->jumlah_poin,
                                'platinumPasif' => $poinAtasan->platinumPasif + $laporan->jumlah_poin
                            ]);
                        }
                    }else{
                        $tipePoin = PoinSilver::where('kd_member', $laporan->kd_member)->first();
                        if($tipePoin){
                            $tipePoin->update([
                                'silverAktif' => $tipePoin->silverAktif + $laporan->jumlah_poin
                            ]);
                        }else{
                            $kdPoinSilver = PoinSilver::orderBy('kd_poinSilver', 'desc')->first();
                            $ID = 'PS-' . date('y') . date('m') . str_pad( ($kdPoinSilver ? intval(substr($kdPoinSilver->kd_poinSilver, 8)) + 1 : 1) , 5, '0', STR_PAD_LEFT);
                            PoinSilver::create([
                                'kd_poinSilver' => $ID,
                                'kd_member' => $laporan->kd_member,
                                'silverAktif' => $laporan->jumlah_poin,
                                'silverPasif' => 0,
                            ]);
                        }
                        $poinAtasan = PoinSilver::where('kd_member', $laporan->kd_atasan)->first();
                        if($poinAtasan){
                            $poinAtasan->update([
                                'silverAktif' => $poinAtasan->silverAktif - $laporan->jumlah_poin,
                                'silverPasif' => $poinAtasan->silverPasif + $laporan->jumlah_poin
                            ]);
                        }
                    }
                    $message = 'Laporan disetujui sepenuhnya.';
                } elseif ($laporan->verifikasi_upline === '2') {
                    $laporan->update(['status' => '2']);
                    $message = 'Laporan ditolak sepenuhnya.';
                } else {
                    $message = 'Laporan disetujui oleh atasan, menunggu verifikasi upline.';
                }
            } else {
                $laporan->update([
                    'persetujuan_atasan' => '2',
                    'status' => '2'
                ]);
                $message = 'Laporan ditolak oleh atasan.';
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'statusCode' => 200,
                'message' => $message,
                'result' => $this->formatLaporan($laporan),
            ], 200);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'statusCode' => 500,
                'message' => 'Terjadi kesalahan pada server. Silakan coba lagi nanti.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}
