<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if (Auth::user()->role != $role) {
            // Redirect based on user's actual role
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()->role == 'siswa') {
                return redirect()->route('siswa.dashboard');
            } else if (Auth::user()->role == 'pelatih') {
                return redirect()->route('pelatih.dashboard');
            } else if (Auth::user()->role == 'anggota') {
                return redirect()->route('anggota.dashboard');
            }
            
            // Fallback if role doesn't match any known roles
            return redirect('/');
        }

        return $next($request);
    }
}