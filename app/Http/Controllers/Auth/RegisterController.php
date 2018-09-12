<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Integrations\ApiKernel;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    use ApiKernel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->guzzleSettings = ['base_uri' => 'http://api.freezermanager.dev.cc/'];
    }


    protected function create(Request $request)
    {
        $initialData = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
        ];
        $meta = ['meta' => [
            ['key' => 'firstname', 'value' => $request->get('firstname')],
            ['key' => 'lastname', 'value' => $request->get('lastname')]
        ]];

        $userData = $this->post("user/create", $initialData);
    }
}
