<?php

namespace App\Library;

use App\Library\Contracts\GoogleOAuthLoginInterface;
use App\Models\User;
use Google_Client;
use Google_Service_Oauth2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class GoogleOAuthLogin implements GoogleOAuthLoginInterface
{
    /**
     * @var array
     */
    protected array $config = [];

    /**
     * GoogleOAuthLogin constructor.
     */
    public function __construct()
    {
        if(!$this->config){
            $this->getConfig();
        }

        if(!$this->client){
            $client = new Google_Client();
            $this->initGoogle($client);
        }
    }

    /**
     * @var Google_Client|null
     */
    public ?Google_Client $client = null;

    /**
     * @param Google_Client $client
     * @return $this
     */
    public function initGoogle(Google_Client $client): static
    {
        $client->setClientId($this->config['client_id']);
        $client->setClientSecret($this->config['client_secret']);
        $client->setRedirectUri($this->config['redirect']);
        $client->addScope("email");
        $client->addScope("profile");
        $this->client = $client;
        return $this;
    }

    /**
     * @return string
     */
    public function authUrl(): string
    {
        return $this->client->createAuthUrl();
    }

    /**
     * @param $code
     * @return \Google_Service_Oauth2_Userinfo
     */
    public function user($code): \Google_Service_Oauth2_Userinfo
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);
        $this->client->setAccessToken($token['access_token']);

        $googleOauth = new Google_Service_Oauth2($this->client);
        return $googleOauth->userinfo->get();
    }

    /**
     * @return $this
     */
    public function getConfig()
    {
        $this->config = Config::get('app.google');
        return $this;
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    public function login(Request $request)
    {
        $code = $request->code;
        if(!$code){
            throw new \Exception('google login error');
        }
        $user = $this->user($code);
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            auth()->login($existingUser);
        } else {
            $create = [
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make(Str::random(10))
            ];
            $user = User::create($create);
            auth()->login($user);
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    public static function provider()
    {
        return app(GoogleOAuthLogin::class);
    }
}