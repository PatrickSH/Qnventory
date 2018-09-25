<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Integrations\ApiKernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class QRController extends Controller
{
    use ApiKernel;

    public function __construct()
    {
        $this->guzzleSettings = ['base_uri' => 'https://api.qnventory.com/'];
    }

    public function index(){
        return view('qrcodes');
    }
}
