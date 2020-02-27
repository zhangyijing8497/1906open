<?php

namespace App\Http\Controllers\Index;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UsersModel;

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
        if($pwd != $pwd1){
            echo "<script>alert('密码与确认密码不一致'); window.history.back(-1); </script>";

        }
        $pwd = password_hash($pwd,PASSWORD_BCRYPT);
        $data = [
            'cname' => $request->input('cname'),
            'username' => $request->input('username'),
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
        $res=UsersModel::insert($data);
        if($res){
            echo "<script>alert('注册成功',location='/login/login')</script>";
        }else{
            echo "<script>alert('注册失败',location='/login/reg')</script>";
        }
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
        $res = UsersModel::where(['username'=>$u])->orWhere(['tel'=>$u])->orWhere(['email'=>$u])->first();
        if($res == NULL){
            echo "<script>alert('用户不存在,请先注册用户!');location='/login/reg'</script>";
        }

        if(!password_verify($pwd,$res->password)){
            echo "<script>alert('密码不正确,请重新输入..'); window.history.back(-1); </script>";die;
        }

        echo "<script>alert('登陆成功');location='/'</script>";
    }
}
