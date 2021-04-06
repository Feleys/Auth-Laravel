<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Library\GoogleOAuthLogin;
use Illuminate\Http\Request;
use App\Library\Contracts\CustomAuthInterface;

class LoginController extends Controller
{

    public function index()
    {
        $this->middleware('guest');
        return view('auth.login', ['googleAuthUrl' => GoogleOAuthLogin::googleLogin()->authUrl()]);
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

    public function googleRedirectHandler(Request $request)
    {
        try{
            GoogleOAuthLogin::googleLogin()->login($request);
            return redirect('/home');
        } catch (\Exception $e){
            toastr()->error($e->getMessage(), 'Error');
            return redirect('/login');
        }
    }
}
