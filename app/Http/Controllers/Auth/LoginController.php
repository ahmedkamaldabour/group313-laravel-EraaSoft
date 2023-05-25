<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use function view;

class LoginController extends Controller
{

    public function loginPage()
    {
        return view('Admin.pages.login.adminLogin');
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);
        if (auth()->attempt($credentials ) && (auth()->user()->role == 'admin')) {
            return redirect()->route('admin');
        }
        $this->handleLogout();
        return redirect()->back()->with(['error' => 'Invalid Credentials']);
    }

    public function logout()
    {
        $this->handleLogout();
        return redirect()->route('admin.loginPage');
    }


    private function handleLogout() {
        Auth::logout();
        session()->flush();
        session()->regenerate();
    }
}
