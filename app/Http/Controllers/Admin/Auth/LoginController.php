<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $guard='adminMiddle';
    protected $redirectTo='administrator/dashboard_admin';

    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function guard(){
        return auth()->guard('adminMiddle');
    }

    public function loginForm(){
        if(auth()->guard('adminMiddle')->user()){
            return back();
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if(auth()->guard('adminMiddle')->attempt(['email' => $request->email, 'password' => $request->password]))
        {
            $admin = auth()->guard('adminMiddle')->user();
            //Session::put('success','Anda Berhasil Login');
            return redirect()->route('administrator.dashboard_admin');
        }else{
            return back()->with('Error','email atau password salah!');
        }
    }

    public function logout(Request $request)
    {
        auth()->guard('adminMiddle')->logout();
        //Session::flush();
        //Session::put('success','Anda Berhasil keluar dari halaman admnistrasi');
        return redirect(url('administrator/login'));
    }
    
}