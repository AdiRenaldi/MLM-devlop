<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function pengaturan(){
        return view('pages.pengaturan.pengaturan');
    }
}
