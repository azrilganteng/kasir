<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KasirLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.kasir-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('kasir')->attempt($credentials)) {
            return redirect()->route('kasir.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout()
    {
        Auth::guard('kasir')->logout();
        return redirect()->route('kasir.login');
    }
}
