<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        return view('pages.auth.login');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('products.index');
        }
        return back()->withErrors(['email' => 'البريد الالكتروني او كلمة المرور غير صحيحة']);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
