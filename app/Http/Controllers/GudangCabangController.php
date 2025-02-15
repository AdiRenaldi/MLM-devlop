<?php

namespace App\Http\Controllers;

use App\Models\StokGudangCabang;
use Illuminate\Http\Request;

class GudangCabangController extends Controller
{
    public function gudangCabang(){
        $pageConfigs = [
            'title' => 'Gudang Cabang',
        ];
        $stokGudangCabang = StokGudangCabang::with('product', 'gudang')->get();
        return view('pages.gudangCabang.gudang-cabang', ['pageConfigs'=>$pageConfigs, 'stokGudangCabang'=>$stokGudangCabang]);
    }
}