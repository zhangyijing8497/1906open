<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    public  $primaryKey="id";

    protected $table = 'users';

    public $timestamps = false;
 


    // 黑名单   表设计中允许为空的字段
    protected $guarded = [];
}
