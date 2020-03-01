<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class GithubController extends Controller
{
    public function index()
    {
        return view('github.index');
    }


    public function callback()
    {
        // echo '<pre>';print_r($_GET);echo '</pre>';

        $client = new Client();

        // 1. 获取code
        $code = $_GET['code'];

        // 2.使用 code 去github接口 获取access_token
        $uri = 'https://github.com/login/oauth/access_token';

        $response = $client->request("POST",$uri,[

            'headers'   => [
                'Accept'    => 'application/json'
            ],

            'form_params'   => [
                'client_id'         =>  '0509ce9400307d30fb22',
                'client_secret'     =>  'a35618783d72b93c5dd5a6f35dee95de1575d7d0',
                'code'              =>  $code
            ]
        ]);
        //access_token 在响应的数据中
        $body = $response->getBody();
        echo $body;die;
    }
    
}
