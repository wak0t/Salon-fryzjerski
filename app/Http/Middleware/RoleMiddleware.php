<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Sprawdź, czy użytkownik jest zalogowany
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Musisz być zalogowany.');
        }

        // Pobierz dane zalogowanego użytkownika
        $user = Auth::user();

        // Sprawdź, czy użytkownik ma odpowiednią rolę
        if (($role === 'admin' && $user->role_id != 1) || 
            ($role === 'employee' && $user->role_id != 2) || 
            ($role === 'client' && $user->role_id != 3)) {
            return redirect('/login')->with('error', 'Brak odpowiednich uprawnień.');
        }

        return $next($request);
    }
}
