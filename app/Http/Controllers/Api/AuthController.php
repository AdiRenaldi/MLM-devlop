<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Api\UserMember;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'pangkat' => 'required',
            'upline_utama' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => 'required|email|unique:user_member,email',
            'password' => 'required|string|min:8',
            'nomorHp' => 'required|numeric|unique:member,nohp|min_digits:11|max_digits:13',
            'nomorWa' => 'required|numeric|unique:member,nowhatsapp|min_digits:11|max_digits:13',
            'alamat' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kodePos' => 'required|numeric',
            'email' => 'required|string|email|max:255|unique:user_member',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'statusCode' => 400,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 400);
            }
        }

        DB::beginTransaction();

        try {
            do {
                $date = now()->format('ymd');
                $random = mt_rand(10, 99);
                $ID = $date . $random;
            } while (Member::where('kd_member', $ID)->exists());

            $member = new Member();
            $member->kd_member = $ID;
            $member->kd_pangkat = $request->pangkat;
            $member->namaLengkap = $request->name;
            $member->kd_upline = $request->upline_utama; 
            if ($request->upline_atasan){
                $member->kd_atasan = $request->upline_atasan;
            }else{
                $member->kd_atasan = $request->upline_utama;
            }
            $member->nohp = $request->nohp;
            $member->nowhatsapp = $request->nowhatsapp;
            $member->alamat = $request->alamat;
            $member->provinsi_id = $request->provinsi;
            $member->kabupaten_id = $request->kabupaten;
            $member->kecamatan_id = $request->kecamatan;
            $member->kodepos = $request->kodePos;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $name = $ID . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/member', $name, 'public');
                $member->image = $name;
            }
            $member->save();
            $userMember = UserMember::create([
                'kd_user_member' => $ID,
                'kd_member' =>$ID,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'statusCode' => 500,
                'message' => 'Gagal membuat member',
                'error' => [
                    'message' => $e->getMessage(),
                ]
            ], 500);
        }

        DB::commit();
        return response()->json(['success' => true, 'statusCode' => 201, 'message' => 'Member berhasil dibuat', 'result' => $member], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'statusCode' => 400,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 400);
        }

        try{
            $userMember = UserMember::where('email', $request->email)->first();

            if (!$userMember || !Hash::check($request->password, $userMember->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            $existingTokens = $userMember->tokens()->delete();
            $tokenName = 'member' . $userMember->id;
            $token = $userMember->createToken($tokenName)->plainTextToken;

            return response()->json([
                'success' => true,
                'statusCode' => 200,
                'message' => 'Login successful',
                'result' => [
                    'user' => [
                        'email' => $userMember->email,
                    ],
                    'access_token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => 0,
                ]
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'statusCode' => 500,
                'message' => 'Server Error',
                'error' => [
                    'message' => $e->getMessage(),
                ]
            ], 500);
        }

    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'message' => 'Logout berhasil',
            'result' => [
                'user_id' => $request->user()->kd_user_member,
                'logout_time' => now()->toDateTimeString(),
            ],
        ], 200);
    }
}
