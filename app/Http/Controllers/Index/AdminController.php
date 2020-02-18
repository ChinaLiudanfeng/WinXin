<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Wechat;
class AdminController extends Controller
{
    //后台主页面
       public function index()
        {
            return view('Index/index');
        }


        //后台登录页面
        public function login()
        {
        	return view('Index/login');
        }

        //处理登录页面
       public function dologin(Request $request)
       {
           $info=$request->all();
           $res=DB::table('login')->where('login_name',$info['login_name'])->first();
            if(!empty($res)){
                if (!empty($info['login_name'] == $res->login_name)) {
                    if ($info['login_pwd'] == $res->login_pwd) {
                        session(['login' => $info['login_name']]);
                        $code=session('code');
                          if($info['code'] != $code){
                             echo "<script>alert('验证码不正确');location.href='login';</script>";
                          }
                        echo "<script>alert('登录成功');location.href='Index';</script>";
                    } else {
                        echo "<script>alert('密码和用户名不匹配');location.href='login';</script>";
                    }

                } else {
                    echo "<script>alert('用户名不存在');location.href='login';</script>";
                }
            }else{
                echo "<script>alert('查不到此用户信息');location.href='login';</script>";
            }

       }
       

       //注册账号
     public function register()
     {
         return view('Index\register');
     }

     //处理一个注册登录
    public function do_register(Request $request)
    {
        $info=$request->all();
        if($info['login_pwd'] != $info['login_pwd2']){
            echo "<script>alert('两次密码输入不一致，请输入一致的密码');location.href='register';</script>";die;
        }
       $res=DB::table('login')->insert([
           'login_name'=>$info['login_name'],
           'login_pwd'=>$info['login_pwd'],
       ]);

        if($res){
            echo "<script>alert('注册成功，咱们去登录');location.href='login';</script>";
        }

    }


    //生成验证码 控制器
    public function login_code(Request $request)
    {
       $data=$request->all();  

      
      // if($data['code'] == session('code')){
      //    echo "<script>alert('验证码不正确');location.href='login';</script>";
      // }   
      $res=DB::table('login')->where('login_name',$data['name'])->where('login_pwd',$data['pwd'])->get();
      if(empty($res)){
         echo json_encode(['content'=>'账号或密码不正确','icon'=>5,'code'=>2]);
      }else{
          $access_token = Wechat::getToken();
          $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$access_token}";
          $rand=rand(1000,9999);
            session(['code'=>$rand]);
         $postData='{
           "touser":"ocsMa5xHL7dvaamWPhpAFC--cyTs",
           "template_id":"ia7qkqYMtm0fyCzFuREFUhcxXt90fJ5_C8w2ytTabgg",          
           "data":{
               "code":{
                    "value":'.$rand.',
                    "color":"#1733177"
                },
                "name":{
                    "value":"可爱小袁袁",
                     "color":"#1733177"
                  },
                "time":{
                  "value":"'.date("Y-m-d H:i:s").'",
                   "color":"#1733177"
                }

               }
             }';
          $data=Wechat::curlPost($url,$postData);//生成为ticket
          $data=json_decode($data,true);
          if($data['errcode'] == 0){
            
              echo json_encode(['content'=>'验证码发送成功','icon'=>6,'code'=>1]);
          }else{
             echo json_encode(['content'=>'验证码发送失败','icon'=>5,'code'=>2]);
          }      
        }
        

    }
      

}
