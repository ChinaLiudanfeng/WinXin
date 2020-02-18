<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
class accredic extends Controller
{
    public function accredic_add()
    {	
    	$appid="wx099976155bdb303b";
    	//urlencode 会将url特殊字符进行转义--
    	$redirect_uri = urlencode("http://www.yuanyuanliuliu.com/accredic_auth");//网页授权在跳转地址
    	$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
         
    	header("location:".$url);die; 
    }
    /*
       1、跳转微信服务器 让用户授权
       2、微信授权成功后，跳转咱们配置的地址(回调地址) 带一个code参数
    
     */

    //授权地址
    public function accredic_auth(Request $reques)
    {
    	$code=request('code');

    	$appid="wx099976155bdb303b";

    	$secret="20a4f8cf9c61a4da527d01a70658de44";
    	$url="https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";
    	$data = file_get_contents($url);

    	$data = json_decode($data,true);
    	// var_dump($data);exit;
    	$openid = $data['openid'];
    	// echo 111;exit;
    	$access_token = $data['access_token'];
    	$userInfo_url="https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
         // var_dump($userInfo_url);die;
    	$data = file_get_contents($userInfo_url);
    	var_dump($data);exit;
    	$data = json_decode($data,true);
    	var_dump($data);die;


    	
    }
}
