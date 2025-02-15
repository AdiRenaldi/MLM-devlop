<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function loginPage(){
        $page = "login";
        if (!Auth::check()) {
            return view('pages.auth.login', ['page' => $page]);
        }
        return redirect()->route('dashboard-page');
    }

    public function loginAction(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Email Harus Diisi',
            'password.required' => 'Password Harus Diisi',
        ]);

        $user = User::where('email', $request->email)->first();
        if($user == null){
            return back()->withErrors([
                'email' => 'Email Tidak Terdaftar',
            ]);
        }
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if(Auth::attempt($credentials, $request->has('remember'))){
            $request->session()->regenerate();
            $permission = Permission::where('kd_permission_admin', Auth::user()->kd_permission_admin)->first();
            $request->session()->put([
                'tier' => $permission->tier,
                'akses' => $permission->permission,
            ]);
            return redirect()->route('dashboard-page');
        }
        return back()->withErrors([
            'password' => 'Password Anda Salah', 
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
