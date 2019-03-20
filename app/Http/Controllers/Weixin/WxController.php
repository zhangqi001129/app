<?php
/**
 * Created by PhpStorm.
 * User: 张琦
 * Date: 2019/3/6
 * Time: 上午 10:54
 */

namespace App\Http\Controllers\Weixin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\WeixinUser;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp\Client;
class WxController extends Controller
{
    /*
     * 获取微信用户信息
     * */
    public function getUserInfo($openid){
        $url='https://api.weixin.qq.com/cgi-bin/user/info?access_token='.WeixinUser::getAccessToken().'&openid='.$openid.'&lang=zh_CN';
        $data=json_decode(file_get_contents($url),true);
    }
    //标签
    public function tag(){

        $url ='https://api.weixin.qq.com/cgi-bin/tags/create?access_token='.WeixinUser::getAccessToken();
        $data=json_decode(file_get_contents($url),true);
        $data=[
            'tag'=>[
                'name'=> 'qiqi'
            ]
        ];
        $client= new Client();
        $r = $client->Request('POST', $url, [
            'body' => json_encode($data, JSON_UNESCAPED_UNICODE)
        ]);
        $response_arr = json_decode($r->getBody(), true);
        print_r($response_arr);
    }
}