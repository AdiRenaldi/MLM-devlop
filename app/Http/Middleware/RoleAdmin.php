<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !session()->has('akses')) {
            return redirect('/');
        }

        $akses = explode(", ", session('akses'));
        $url = $request->segment(1);
        $hakAkses = in_array($url, $akses);
        if (!$hakAkses) {
            abort(404);
        }
        return $next($request);
    }
}
