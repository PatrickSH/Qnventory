<?php

namespace App\Integrations;

use \GuzzleHttp as Guzzle;
use \GuzzleHttp\Exception\BadResponseException as BRE;

trait ApiKernel{

    protected $guzzle;
    protected $guzzleSettings;


    public function post( $url, $params )
    {
        try {
            $this->guzzle = new Guzzle\Client( $this->guzzleSettings );
            $call = $this->guzzle->request('POST', $url, ['form_params' => $params]);

            return json_decode($call->getBody()->getContents());
        } catch (BRE $ex) {
            $response = $ex->getResponse();
            $jsonBody = (string) $response->getBody();

            return 8000;
        }
    }

    public function get( $url, $params )
    {
        $this->guzzle = new GuzzleHttp\Client($this->guzzleSettings);
        $call = $this->guzzle->request('GET',$url,['form_params' => $params]);

        return $call->getBody()->getContents();
    }
}
