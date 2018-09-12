<?php

namespace App\Http\Controllers\Auth;

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
        $this->guzzleSettings = ['base_uri' => 'http://api.freezermanager.dev.cc/'];
    }


}
