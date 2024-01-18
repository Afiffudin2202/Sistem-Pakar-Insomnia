<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginAuth(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        
        // authentication login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/beranda');
        }
        // mengembalikan error
        return back()->with('loginError', 'Email atau Password salah');
    }

    public function register()
    {
        return view('auth.registrasi');
    }

    public function registerStore(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'tgl_lahir' => 'required|date',
            'jns_kelamin' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required|min:8'
        ];

        $validated = $request->validate($rules);
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        $request->session()->flash('success', 'berhasil register');
        return redirect('/login');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
