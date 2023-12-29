<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class AuthAdminController extends Controller
{
    use AuthenticatesUsers;

    protected $maxAttempts = 3;
    protected $decayMinutes = 2;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('postLogout');
    }

    function getLogin()
    {
        return view('auth.admin.login');
    }

    function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        if (auth()->guard('admin')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return redirect()->intended();
        } else {
            $this->incrementLoginAttempts($request);

            return redirect()->back()->withInput()->withErrors(["Incorect user login details!"]);
        }
    }

    function postLogout()
    {
        auth()->guard('admin')->logout();
        session()->flush();

        return redirect('login');
        // ->route('admin.login');
    }
}
