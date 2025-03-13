<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return '/admin';
        } elseif ($user->role === 'user') {
            return '/user';
        } elseif ($user->role === 'transporter') {
            return '/transporter/home';
        } elseif ($user->role === 'distributor') {
            return '/distributor/home';
        } elseif ($user->role === 'individual') {
            return '/individual/home';
        }

        return '/error'; // Default redirection
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
