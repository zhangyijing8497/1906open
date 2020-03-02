<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Model\GithubModel;
use App\Model\UserModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;


class GithubController extends Controller
{
    public function index()
    {
        return view('github.index');
    }


    public function callback()
    {

        $client = new Client();

        echo '<pre>';print_r($_GET);echo '</pre>';

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
        echo $body;echo '<hr>';

        $info = json_decode($body,true);
        $access_token = $info['access_token'];

        // 使用access_token获取用户信息
        $uri = 'https://api.github.com/user';
        $response = $client->request('GET',$uri,[
            'headers'     => [
                'Authorization' => 'token '.$access_token
            ]
        ]);
        $body = $response->getBody();
        $user_info = json_decode($body,true);
        echo '<pre>';print_r($user_info);echo '</pre>';  
        
        // 判断用户是否存在 ,存在提示欢迎回来,否则将新用户入库
        $u = GithubModel::where(['github_id'=>$user_info['id']])->first();
        $uid = $u->uid;
        if($u){
            echo "欢迎回来";echo '</br>';
        }else{
            echo "欢迎新用户";echo '</br>';

            // 在用户主表中记录用户
            $u_data = [
                'email' => $user_info['email']
            ];

            $uid = UserModel::insertGetId($u_data);  //生成主表uid 关联github用户表
            
            $github_user_info = [
                'uid'       => $uid,
                'github_id' => $user_info['id'],
                'location'  => $user_info['location'],
                'email'  => $user_info['email'],
            ];

            $gid = GithubModel::insertGetId($github_user_info);  
        }


        $token = Str::random(16); //生成token 返回客户端
        Cookie::queue('token',$token,60); 
        // 将token保存到redis中
        $redis_h_token = "h:token:" . $token;

        $login_info = [
            'uid'           => $uid,
            'login_time'    => time()
        ];
        Redis::hMset($redis_h_token,$login_info);
        Redis::expire($redis_h_token,60*60);

        echo "<script>alert('登陆成功,跳转至个人中心');location='/login/personal'</script>";
    }
    
}
