<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\Contracts\CustomAuthInterface;

class RegisterController extends Controller
{
    private $customAuth;

    public function __construct(CustomAuthInterface $CustomAuthInterface)
    {
        $this->customAuth = $CustomAuthInterface;
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try{
            $this->customAuth->register($request);
            toastr()->success('Register successfully!', 'Success');
            return redirect('login');
        } catch (\Exception $e){
            toastr()->error($e->getMessage(), 'Error');
            return redirect('register');
        }
    }
}
