<?php
/**
 * Created by PhpStorm.
 * User: 张琦
 * Date: 2019/3/20
 * Time: 下午 07:13
 */

namespace App\Http\Controllers\Login;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginUserController extends Controller
{
        public function login(Request $request){
            print_r($request);exit;
            $name = $request->input('name');
            $password=$request->input('password');
            $data = [
                'name'    =>  $name,
                'password'     =>  $password
            ];
            $url = 'http://wlssb.lixiaonitongxue.top/api/login';
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_HEADER,0);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response,true);
            return $response;
    }

}