<?php

namespace App\Http\Controllers\Penilai\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'penilaiMiddle';
    protected $redirectTo = '/penilai/dashboard_penilai';

    public function __construct()
    {
        // Middleware 'guest' sudah ditangani oleh grup rute
        // $this->middleware('guest:penilaiMiddle')->except('logout');
    }

    public function loginForm()
    {
        return view('penilai.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->guard('penilaiMiddle')->attempt($credentials)) {
            return redirect()->route('penilai.dashboard_penilai')->with('success', 'Anda berhasil login');
        } else {
            return back()->withInput($credentials)->withErrors(['email' => 'Email atau password salah']);
        }
    }

    public function logout(Request $request)
    {
        auth()->guard('penilaiMiddle')->logout();
        return redirect()->route('penilai.login')->with('success', 'Anda berhasil keluar');
    }
}