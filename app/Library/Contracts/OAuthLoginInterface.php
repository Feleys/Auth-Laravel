<?php
namespace App\Library\Contracts;

use Illuminate\Http\Request;

Interface OAuthLoginInterface
{
    public function authUrl();
    public function user($code);
    public function login(Request $request);
    public function getConfig();
}