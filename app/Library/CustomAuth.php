<?php

namespace App\Library;

use App\Library\Contracts\CustomAuthInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class CustomAuth implements CustomAuthInterface
{
    /**
     * @param Request $request
     * @return bool
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            toastr()->success('login successfully!', 'Success');
            return True;
        }
        return False;
    }

    public function logout()
    {
        Auth::logout();
    }

    /**
     * @param Request $request
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255|unique:users',
            'password'              => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    public static function provider()
    {
        return app(CustomAuth::class);
    }
}