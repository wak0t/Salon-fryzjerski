<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Wyświetlanie formularza logowania
    public function showLoginForm()
    {
        return view('login');
    }

    // Obsługa logowania
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Przekierowanie na podstawie roli użytkownika
            if ($user->role_id == 1) {
                return redirect('/admin');
            } elseif ($user->role_id == 2) {
                return redirect('/employee');
            } elseif ($user->role_id == 3) {
                return redirect('/client');
            }

            return redirect('/')->with('error', 'Nieprawidłowa rola użytkownika.');
        }

        return redirect('/login')->with('error', 'Nieprawidłowe dane logowania.');
    }

    // Wylogowanie użytkownika
    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('success', 'Wylogowano pomyślnie.');
    }

    // Wyświetlanie formularza rejestracji
    public function showRegisterForm()
    {
        return view('register');
    }

    // Obsługa rejestracji
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role_id' => 3, // Domyślna rola dla klientów
        ]);
    
        return redirect()->back()->with('success', 'Poprawnie zarejestrowano. Możesz się teraz zalogować.');
    }
}    
