<?php
/**
 * Created by PhpStorm.
 * User: 张琦
 * Date: 2019/3/20
 * Time: 下午 07:13
 */

namespace App\Http\Controllers\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function reg(Request $request){
        $name = $request->input('name');
        $pwd=$request->input('pwd');
        echo $name.'注册成功';
    }
    public function login(Request $request){
        $name = $request->input('name');
        $pwd=$request->input('pwd');
        echo $name."登录成功";
    }
}
