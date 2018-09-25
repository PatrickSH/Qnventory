<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Integrations\ApiKernel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ScanController extends Controller
{
    use ApiKernel;

    public function __construct()
    {
        $this->guzzleSettings = ['base_uri' => 'https://api.qnventory.com/'];
    }

    public function routeScanAction($org_id, $code_uid)
    {
        $status = json_decode($this->get("organization/$org_id/$code_uid/status",[]))[0];
        /*
         * 2 : Ready to use
         * 1 : Code has created and attached item if it will be scanned now it will delete product from freezer
         * 0 : Code has created product and has been scanned
         * 99 : QR code does not exists for specified organization
         */

        if($status == 2){
            return view('scan.bind-code',compact('org_id','code_uid'));
        }else if($status == 1){
            return view('scan.use-code',compact('org_id','code_uid'));
        }else if($status == 0){
            return view('scan.invalid-code');
        }else{

        }
    }
}
