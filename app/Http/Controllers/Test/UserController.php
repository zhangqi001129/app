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
use Illuminate\Support\Facades\Redis;

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
        $re=useModel::limit(1)->get()->toArray();
        if($rs){
            $response = [
                'errno' => 0,
                'data'=>$re,
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
        static $i=1;
         $i=$i++;
    $rs=useModel::limit($i)->get()->toArray();
        $response = [
            'data' => $rs,
        ];
        return $response;
    }
















public function tokenlogin(Request $request){
    $name = $request->input('name');
    $pwd=$request->input('pwd');
    $where=[
        'name'=>$name,
    ];
    $rs=UserModel::where($where)->first();
    $uid=$rs['id'];
    if(!empty($uid)){
        $response = [
            'errno' => 0,
            'uid'=>$uid,
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


    public  function code(){
        $key="token_app";
        $token=Redis::spop($key);
        return view('test.code',['token'=>$token]);
    }
    public function coderedis(Request $request){
        $token = $request->input('token');
        $uid = $request->input('uid');
        $res=Redis::set($token,$uid,60);
        if($res){
            $response = [
                'errno' => 0,
                'uid'=>$uid,
                'msg' => '扫描成功',
            ];
        }else{
            $response = [
                'errno' => 40003,
                'msg' => '扫描失败',
            ];
        }
        return $response;
    }
    public  function loginredis(Request $request){
        $token = $request->input('token');
        $id=Redis::get($token);
        if($id){
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
}
