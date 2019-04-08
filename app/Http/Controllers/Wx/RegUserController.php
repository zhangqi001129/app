<?php

namespace App\Http\Controllers\Wx;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Model\UserModel;
use App\Model\KeyModel;
class RegUserController extends Controller
{
    public function reg()
    {
            return view('login.show');
    }
    public function add(Request $request){
       $name = $request->input('name');
        $num = $request->input('num');
        $tu = $request->input('tu');
        $img = $request->input('img');
        $data = [
            'name' =>$name,
            'num' => $num,
            'tu' =>$tu,
            'img' =>$img,
        ];
        $id = UserModel::insertGetId($data);
        if($id){
            header("Refresh:3;url=/show");
            echo "申请提交成功";
        }else{
            header("Refresh:3;url=/reg");
            echo "申请提交失败";
        }
    }
    public function show(){
        $goods = UserModel::all();
        $data = [
            'data' => $goods
        ];
        return view('login.show1',$data);
    }
    public function shen($id){
        $info=[
            'is_shen'=>1
        ];
        $rs = UserModel::where(['id'=>$id])->update($info);
        $app_key = substr(md5(time() + mt_rand(1000, 9999)), 10, 20);
        $key='a:p:k';
        Redis::set($key,$app_key);
        Redis::setTimeout($key,3600);
        $app_secret=substr(md5(time() + mt_rand(1000, 9999)), 10, 20);
        $r=[
            'app_key'=>$app_key,
            'app_secret'=> $app_secret
        ];
        $rs = UserModel::where(['id'=>$id])->update($r);

        if($rs){
            echo "审核成功";
        }else{
            header("Refresh:3;url=/reg");
            echo "审核失败";
        }
    }



    //加密测试
//    public function test(Request $request){
//        //$str=$request->input('name');
//        $str='88888';
//        $res= encode($str);
//        echo $res; echo '</br>';
//        $n=dncode($res);
//        echo $n;
//
//    }

    public function test()
    {
        return view('test.show');
    }
    public function test2()
    {
        print_r($_FILES);
        $name=file_get_contents($_FILES['file']['tmp_name']);
        file_put_contents('/aaa.jpg',$name,FILE_APPEND);
        echo json_encode(array('success'=>1,'cold'=>0));
    }
}