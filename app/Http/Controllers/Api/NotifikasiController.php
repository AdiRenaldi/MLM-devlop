<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function notifikasi(Request $request)
    {
        // $member = Member::find($memberId);
        $member = $request->user();

        $notifikasi = Notifikasi::whereHas('notifikasiMember', function ($query) use ($member) {
            $query->where('notifikasi_member.kd_member', $member->kd_member);
        })->get();


        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil diperoleh',
            'result' => $notifikasi
        ], 200);
    }

    public function detailNotifikasi(Request $request)
    {
        $id = $request->query('notifikasi');
        $notifikasi = Notifikasi::findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail notifikasi berhasil diperoleh',
            'result' => $notifikasi
        ], 200);
    }
}
