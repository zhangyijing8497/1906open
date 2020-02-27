<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class UserModel extends Model
{
    public  $primaryKey="id";

    protected $table = 'p_users';

    public $timestamps = false;
 
    // 黑名单   表设计中允许为空的字段
    protected $guarded = [];

    /**
     * 生成APPID
     */
    public static function gernerateAPPId($username)
    {
        // 根据用户名$username + 时间戳 + 随机数 md5加密生成APPID
        $appid = md5($username.time().mt_rand(111111,999999));
        return 'Ln' . substr($appid,5,14);
    }

    /**
     * 生成SECRET
     */
    public static function gernerateSecret()
    {
        return Str::random(32);
    }
}
