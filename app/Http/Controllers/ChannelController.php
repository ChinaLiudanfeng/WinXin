<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Wechat;
use DB;

class channelController extends Controller
{
     //渠道展示页面
    public function channel_add()
    {
        return view('channel\channel_add');
    }

    //处理添加
    public function channel_doadd(Request $request)
    {
        // 如果post请求 ，添加入库
        if(!$request->isMethod('post'))
        {
                echo "<script>alert('请使用post传输数据');location.href='channel_add';</script>>";die;
        }
        $info=$request->all();//接收渠道名和渠道标识
//        dd($info);
        $c_80=$info['c_80'];//二维码标识
         $filename=Wechat::two_WMa($c_80);
        $res=DB::table('channl')->insert([
            'c_name'=>$info['c_name'],
            'c_80'=>$info['c_80'],
            'jpg_path'=>"channel/$filename",
            'add_time'=>time(),
        ]);
        if(!empty($res)){
            return redirect('channel_index');
        }
    }

    public function channel_index()
    {
        $info=DB::table('channl')->get();

        return view('channel\channel_index',['info'=>$info]);
    }
}
