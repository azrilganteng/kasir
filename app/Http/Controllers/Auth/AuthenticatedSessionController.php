<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Alihkan logika redirect ke method authenticated
        return $this->authenticated($request, Auth::user());
    }

    /**
     * Logika redirect setelah login berdasarkan level pengguna.
     */
    protected function authenticated(Request $request, $user)
    {
        // Cek level pengguna dan arahkan mereka ke dashboard yang sesuai
        if ($user->level == 'admin') {
            return redirect()->intended('/admin/dashboard');
        } elseif ($user->level == 'kasir') {
            return redirect()->intended('/kasir/dashboard');
        }

        // Default redirect jika level tidak cocok
        return redirect()->intended('/home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
