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

        $client = new Client();

        // echo '<pre>';print_r($_GET);echo '</pre>';

        //  获取code
        $code = $_GET['code'];

        // 使用 code 去github接口 获取access_token
        $uri = 'https://github.com/login/oauth/access_token';

        $response = $client->request("POST",$uri,[

            'headers'   => [
                'Accept'    => 'application/json'
            ],

            'form_params'   => [
                'client_id'         =>  env('GITHUB_CLIENT_ID'),
                'client_secret'     =>  env('GITHUB_CLIENT_SECRET'),
                'code'              =>  $code
            ]
        ]);
        //access_token 在响应的数据中
        $body = $response->getBody();
        // echo '<hr>';

        $info = json_decode($body,true);
        $access_token = $info['access_token'];

        // 使用access_token获取用户信息
        $uri = 'https://api.github.com/user';
        $response = $client->request("GET",$uri,[
            'headers'     => [
                'Accept'    => 'application/json',
                'Authorization' => 'token'.$access_token
            ]
        ]);
        $body = $response->getBody();
        $user_info = json_decode($body,true);
        // echo $user_info;
    }
    
}
