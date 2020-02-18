<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class oil extends Controller
{
    //搜索框展示
    public function oil()
    {
       return view('exam.oil');
    }

    //处理油价搜搜
      public function oil_soso(Request $request)
    {

       $info=$request->all();
       if(request()->ajax()){

    		$city = request('city');
            
    		$cache_name= 'weacherData_'.$city; 
            $data = Cache::get($cache_name);
            if(empty($data)){
    		   
         $url = 'http://apis.juhe.cn/cnoil/oil_city?key=e3e420d5d8e86b99a4ecbc127db8143e';
       
         $data = file_get_contents($url);
         $data=json_decode($data,true);
 
          foreach ($data['result'] as $key => $value) {
               if($value['city'] =$city){
                     $data=$value;
               }
          	
          }
         
         //86400 24小时时间戳、
         $time24 = strtotime(date("Y-m-d H:i:s"))+86400;
         $second = $time24 - time();
         Cache::put($cache_name,$data,$second);
         }
	     
	          
		     echo json_encode($data,JSON_UNESCAPED_UNICODE);die; 
	     }
    }
    
}
