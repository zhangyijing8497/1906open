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
        $data = $request->except('password1');
        if(request()->hasFile('logo')) {
            $data['logo']=$this->upload('logo');
        }
        // dd($data);
        $res=UsersModel::insert($data);
        if($res){
            echo "<script>alert('注册成功',location='/login/index')</script>";
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

}
