<?php

namespace App\Integrations;

use \GuzzleHttp as Guzzle;
use \GuzzleHttp\Exception\BadResponseException as BRE;

trait ApiKernel{

    protected $guzzle;
    protected $guzzleSettings;

    private function headers(){
        $headers = [];
        if(isset(session("security")['token'])){
            $headers = [
                'Token-one' => session("security")['email'],
                'Token-two' => session("security")['token'],
                'Token-three' => session("security")['id'],
            ];
        }

        return $headers;
    }

    public function post( $url, $params )
    {
        try {
            $this->guzzle = new Guzzle\Client( $this->guzzleSettings );
            $call = $this->guzzle->request('POST', $url, ['form_params' => $params, 'headers' => $this->headers()]);

            return json_decode($call->getBody()->getContents());
        } catch (BRE $ex) {
            $response = $ex->getResponse();
            $jsonBody = (string) $response->getBody();

            return 8000;
        }
    }

    public function get( $url, $params )
    {
        $this->guzzle = new Guzzle\Client($this->guzzleSettings);
        $call = $this->guzzle->request('GET',$url,['form_params' => $params, 'headers' => $this->headers()]);

        return $call->getBody()->getContents();
    }
}
