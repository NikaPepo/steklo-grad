<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $data = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ];
        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            if (!auth()->user()->is_admin) {

                Auth::logout();
                return back()->withErrors([
                    'email' => 'Access denied.',
                ]);
            }
            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'email' => 'Неверные учетные данные, пожалуйста, попробуйте еще раз.',
        ]);
    }
}
