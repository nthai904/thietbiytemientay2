<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $login = $request->input('email') ?? $request->input('user_name');
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'user_name';

        $status = Auth::attempt([$fieldType => $login, 'password' => $password], $remember);
        if ($status) {
            $user = Auth::user();
            if ($user->is_admin == 1) {
                return redirect()->route('dashboard.index');
            } else {
                return redirect()->route('product.index');
            }
        }
        return back()->with('error', 'Thông tin đăng nhập không chính xác!');
    }


    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Đăng xuất thành công');
    }
}
