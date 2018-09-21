<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Integrations\ApiKernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    use ApiKernel;

    public function __construct()
    {
        $this->guzzleSettings = ['base_uri' => 'https://api.qnventory.com/'];
    }

    public function index(){
        return view('own-profile');
    }

    public function refreshUserSession(){
        $userData = $this->get("user/refresh-session",[]);
        session(['user' => json_decode( $userData )]);
        return $userData;
    }
}
