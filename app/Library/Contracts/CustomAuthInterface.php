<?php
namespace App\Library\Contracts;

use Illuminate\Http\Request;

Interface CustomAuthInterface
{
    public function login(Request $request);
    public function logout();
    public function register(Request $request);
}