<?php
/**
 * Created by PhpStorm.
 * User: 张琦
 * Date: 2019/3/20
 * Time: 下午 07:13
 */

namespace App\Http\Controllers\Test;
use Illuminate\Http\Request;
use App\Model\UserModel;
use App\Model\UseModel;
use App\Model\NumModel;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function reg(Request $request){
        $name = $request->input('name');
        $pwd=$request->input('pwd');
        $data=[
            'name'=>$name,
            'pwd'=>$pwd
        ];
        $rs =  UserModel::insertGetId($data);
        if ($rs) {
            $response = [
                'errno' => 0,
                'msg' => '注册成功',
            ];
        } else {
            $response = [
                'errno' => 40002,
                'msg' => '注册失败'
            ];
        }
        return $response;
    }
    public function login(Request $request){
        $name = $request->input('name');
        $pwd=$request->input('pwd');
        $where=[
            'name'=>$name,
            'pwd'=>$pwd
        ];
        $rs=UserModel::where($where)->get();
        if($rs){
            $response = [
                'errno' => 0,
                'msg' => '登录成功',
            ];
        }else{
            $response = [
                'errno' => 40003,
                'msg' => '登录失败',
            ];
        }
        return $response;
    }
 public  function select(Request $request){
     $num = $request->input('num');
     $rs=NumModel::first();
     if($num!=$rs['api_num']){
         $response = [
             'errno' => 40001,
             'msg' => 'app需要升级至最新版本',
         ];
     }
     return $response;
 }
    public  function add(){
        $rs=useModel::get()->toArray();
        $response = [
            'data' => $rs,
        ];
        return $response;
    }
}
