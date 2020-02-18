<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class profress extends Model
{
    protected $table = 'profress';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];//批量添加需要的指定属性
}
