<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use app\model\Wechat;

class reply extends Model
{
    protected $table = 'reply';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性


}
