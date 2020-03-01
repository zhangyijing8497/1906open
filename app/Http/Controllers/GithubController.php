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
        $uri = "https://github.com/login/oauth/access_token";

        $response = $client->request("POST",$uri,[
            'headers'       => [
                'Accept'    => 'application/json'
            ],
            'form_params'   => [
                'client_id'         => env('GITHUB_CLIENT_ID'),
                'client_secret'     => env('GITHUB_CLIENT_SECRET'),
                'code'              => $code
            ]
        ]);
        $body = $response->getBody();
        echo $body;die;
    }
    
}
