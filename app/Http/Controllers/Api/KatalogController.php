<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function katalog()
    {
        try {
            $produk = Products::all();

            if ($produk->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'statusCode' => 404,
                    'message' => 'Tidak ada produk ditemukan',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'statusCode' => 200,
                'message' => 'Katalog produk berhasil diperoleh',
                'result' => $produk
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
