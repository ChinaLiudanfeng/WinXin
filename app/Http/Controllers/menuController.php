<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class menuController extends Controller
{
    //菜单添加页面
    public function menu_add()
    {
    	return view('menu.menu_add');
    }

    public function menu_doadd(Request $request)
    {
        $info=$request->all();
         $model = new menu;
         unset($info['s']);
        $res=DB::table('menu')->insert($info);

    }

   //列表展示
    public function menu_index()
    {
          $info=DB::table('menu')->get();
         return view('menu.menu_index',['info'=>$info]);
    }


    //一键同步
    public function create_menu()
    {
        $model = new menu;
       $data=$model->all();
        var_dump($data);die;
    } 
}
