<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Models\Provinsi;

class WilayahController extends Controller
{
    public function provinsi(){
        $provinsi = Provinsi::all();
        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'message' => 'Provinsi berhasil diperoleh',
            'result' => $provinsi
        ], 200);
    }

    public function kabupaten(Request $request){
        $id = $request->query('id_provinsi');
        $kabupaten = Kabupaten::where('provinsi_id', $id)->get();
        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'message' => 'Kabupaten berhasil diperoleh',
            'result' => $kabupaten
        ], 200);
    }

    public function kecamatan(Request $request){
        $id = $request->query('id_kabupaten');
        $kecamatan = Kecamatan::where('kabupaten_id', $id)->get();
        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'message' => 'Kecamatan berhasil diperoleh',
            'result' => $kecamatan
        ], 200);
    }
}
