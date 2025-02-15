<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function promo()
    {
        try {
            $promo = Promo::all();

            if ($promo->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'statusCode' => 404,
                    'message' => 'Tidak ada promo ditemukan',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'statusCode' => 200,
                'message' => 'Promo berhasil diperoleh',
                'result' => $promo
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'statusCode' => 500,
                'message' => 'Terjadi kesalahan pada server. Silakan coba lagi nanti.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
