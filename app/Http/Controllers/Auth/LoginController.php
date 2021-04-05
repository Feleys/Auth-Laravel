<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Contracts\CustomAuthInterface;
class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request, CustomAuthInterface $auth)
    {
        if($auth->login($request)){
            toastr()->success('login successfully!', 'Success');
            return redirect()->intended('home');
        }

        toastr()->error('User not exist', 'Error');
        return redirect('login');
    }

    public function logout(CustomAuthInterface $auth)
    {
        $auth->logout();
        toastr()->success('logout successfully!', 'Success');
        return redirect('login');
    }

    public function home()
    {
        return view('home');
    }
}
