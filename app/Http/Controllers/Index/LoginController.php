<?php

namespace App\Http\Controllers\Index;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserModel;
use App\Model\AppModel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;


class LoginController extends Controller
{
    /**
     * 展示注册视图
     */
    public function reg()
    {
        return view('index.login.reg');
    }

    /**
     * 执行注册
     */
    public function doReg(Request $request) 
    {
        $pwd = $request->input('password');
        $pwd1 = $request->input('password1');
        $username = $request->input('username');
        if($pwd != $pwd1){
            echo "<script>alert('密码与确认密码不一致'); window.history.back(-1); </script>";

        }
        $pwd = password_hash($pwd,PASSWORD_BCRYPT);
        $data = [
            'cname' => $request->input('cname'),
            'username' => $username,
            'password' => $pwd,
            'people' => $request->input('people'),
            'address' => $request->input('address'),
            'tel' => $request->input('tel'),
            'email' => $request->input('email'),
        ];
        if(request()->hasFile('logo')) {
            $data['logo']=$this->upload('logo');
        }
        // dd($data);
        $uid = UserModel::insertGetId($data);
  

        if($uid>0){
            echo "<script>alert('注册成功',location='/login/login')</script>";
        }else{
            echo "<script>alert('注册失败',location='/login/reg')</script>";
        }

        // 为用户生成APPID SECRET
        $appid = UserModel::gernerateAPPId($username);
        $secret = UserModel::gernerateSECRET();
        // 写入app表中
        $app_info = [
            'uid'       => $uid,
            'appid'     => $appid,
            'secret'    => $secret,
        ]; 
        $app_id = AppModel::insertGetId($app_info);
    }

     /**
      * 上传文件
      */
     public function upload($file)
    {
        $file = request()->file($file);
        $path = $file->store('public');
        $path=strstr($path,'/');
        return $path;
    } 

    /**
     * 展示登陆视图
     */
    public function login()
    {
        return view('index.login.login');
    }

    /**
     * 执行登陆
     */
    public function doLogin(Request $request)
    {
        $u = $request->input('u');
        $pwd = $request->input('password');
        $res = UserModel::where(['username'=>$u])->orWhere(['tel'=>$u])->orWhere(['email'=>$u])->first();
        if($res == NULL){
            echo "<script>alert('用户不存在,请先注册用户!');location='/login/reg'</script>";
        }

        if(!password_verify($pwd,$res->password)){
            echo "<script>alert('密码不正确,请重新输入..'); window.history.back(-1); </script>";die;
        }

        $token = Str::random(16); //生成token 返回客户端
        Cookie::queue('token',$token,60);
        // 将token保存到redis中
        $redis_h_token = "h:token:" . $token;

        $login_info = [
            'uid'           => $res->id,
            'username'      => $res->username,
            'login_time'    => time()
        ];
        Redis::hMset($redis_h_token,$login_info);
        Redis::expire($redis_h_token,60*60);

        echo "<script>alert('登陆成功,正在跳转至个人中心');location='/login/personal'</script>";
    }

    /**
     * 个人中心
     */
    public function personal()
    {
        $token = Cookie::get('token');
        if(empty($token)){
            echo "<script>alert('请先去登陆');location='/login/login'</script>";
        }

        // echo '<pre>';print_r($token);echo '</pre>';

        // 获取到token 拼接redis key
        $redis_h_token = "h:token:" . $token;
        // echo $key = $redis_h_token;
        $login_info = Redis::hgetAll($redis_h_token);
        // echo '<pre>';print_r($login_info);echo '</pre>';

        // 获取用户应用信息
        $app_info = AppModel::where(['uid'=>$login_info['uid']])->first()->toArray();
        // echo '<pre>';print_r($app_info);echo '</pre>';

        echo "欢迎来到个人中心:".$login_info['username'];echo '</br>';
        echo "APPId:".$app_info['appid'];echo '</br>';
        echo "SECRET:".$app_info['secret'];echo '</br>';
    }
}
