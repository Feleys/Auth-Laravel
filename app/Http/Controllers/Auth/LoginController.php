<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Library\GoogleOAuthLogin;
use Illuminate\Http\Request;
use App\Library\CustomAuth;

class LoginController extends Controller
{

    public function index()
    {
        $this->middleware('guest');
        return view('auth.login', ['googleAuthUrl' => GoogleOAuthLogin::provider()->authUrl()]);
    }

    public function login(Request $request)
    {
        if(CustomAuth::provider()->login($request)){
            toastr()->success('login successfully!', 'Success');
            return redirect()->intended('home');
        }

        toastr()->error('User not exist', 'Error');
        return redirect('login');
    }

    public function logout()
    {
        CustomAuth::provider()->logout();
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
            GoogleOAuthLogin::provider()->login($request);
            return redirect('/home');
        } catch (\Exception $e){
            toastr()->error($e->getMessage(), 'Error');
            return redirect('/login');
        }
    }
}
