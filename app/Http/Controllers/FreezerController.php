<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FreezerController extends Controller
{

    public function __construct()
    {
    }

    public function index(){
        return view('freezer');
    }

}
