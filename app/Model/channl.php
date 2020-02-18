<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Wechat;
use App\Model\channel;

class channl extends Model
{
    protected $table = 'channl';
    protected $primaryKey = 'c_id';
    public $timetamps = false;
    protected $guarded = [];//批量添加需要的指定属性


   public static function chanNumber($c_num)
   {
   	  $res=Self::where(['c_80'=>$c_num])->increment('channl_num');
   	   dd($res);
   }
    

}
