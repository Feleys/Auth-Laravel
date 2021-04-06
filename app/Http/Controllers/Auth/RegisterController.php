<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Contracts\CustomAuthInterface;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request, CustomAuthInterface $auth)
    {
        $auth->register($request);
        toastr()->success('Register successfully!', 'Success');
        return redirect('login');
    }
}
