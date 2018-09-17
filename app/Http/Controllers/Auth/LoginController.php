<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Integrations\ApiKernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use ApiKernel;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->guzzleSettings = ['base_uri' => 'https://api.qnventory.com/'];
    }

    public function doLogin(Request $request)
    {
        $data = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        $userData = $this->post("user/login", $data);

        if($userData == "8000"){ //Error in logging in
            echo "error";
        }else{
            session(['user' => $userData]);
            session(['security' =>
                [
                    'email' => base64_encode($userData->email),
                    'token' => $userData->logged_in_token,
                    'id' => base64_encode($userData->id)
                ]]);
        }
    }

    public function showFirstLogin(){
        return view('firstlogin');
    }

}
