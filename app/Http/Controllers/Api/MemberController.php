<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function profileMember(Request $request)
    {
        $user = $request->user();
        $member = Member::with(['userMember', 'pangkat', 'provinsi', 'kabupaten', 'kecamatan', 'poinPlatinum', 'poinSilver', 'rewards', 'upline', 'atasan', 'bawahans', 'downlines'])
            ->where('kd_member', $user->kd_member)
            ->first();

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'message' => 'Profile member berhasil diperoleh',
            'result' => $member
        ], 200);
    }

    public function lihatJaringan(Request $request){
        $user = $request->user();
        $member = Member::with(['upline', 'atasan', 'bawahans', 'downlines'])
            ->where('kd_member', $user->kd_member)
            ->first();

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'message' => 'Jaringan member berhasil diperoleh',
            'result' => $member
        ], 200);
    }
}
