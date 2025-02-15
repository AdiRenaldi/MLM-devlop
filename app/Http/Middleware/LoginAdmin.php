<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Permission;

class LoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || session()->get('akses') === null) {
            if (Auth::viaRemember()) {
                $permission = Permission::where('kd_permission_admin', Auth::user()->kd_permission_admin)->first();
                if ($permission) {
                    $request->session()->regenerate();
                    $request->session()->put([
                        'tier' => $permission->tier,
                        'akses' => $permission->permission,
                    ]);
                } else {
                    return redirect('/');
                }
            } else {
                return redirect('/');
            }
        }
        return $next($request);
    }
}
