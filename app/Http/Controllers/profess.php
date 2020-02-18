<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class profess extends Controller
{
    //添加页面
   public function profess_add()
   {
   	return view('profess.profess_add');
   }

   //处理添加
   public function profess_doadd(Request $request)
   {
       $data=$request->all();
       dd($data);
   }
}
