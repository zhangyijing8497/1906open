<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GithubModel extends Model
{
    public  $primaryKey="id";

    protected $table = 'p_users_github';

    public $timestamps = false;
 
    // 黑名单   表设计中允许为空的字段
    protected $guarded = [];
}
