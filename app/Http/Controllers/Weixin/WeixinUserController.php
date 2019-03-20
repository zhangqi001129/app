<?php
/**
 * Created by PhpStorm.
 * User: 张琦
 * Date: 2019/3/8
 * Time: 上午 08:58
 */

namespace App\Http\Controllers\Weixin;
use App\Http\Controllers\Controller;
use App\Model\WeixinUser;
use Illuminate\Support\Facades\Redis;
use GuzzleHttp;
class WeixinUserController extends Controller
{
    //微信关注用户展示
     public function show(){
         $links = WeixinUser::paginate(2);
         //print_r($links);exit;
         $data=[
             'list'=>$links
         ];
         $user=json_encode($data['list']);
         //写入缓存
         Redis::set('gershuju',$user);
         return view('admin.weixin.show',$data);
     }
    //打标签
        public function tag(){
         $openid=$_POST['openid'];
         $url='https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token='.WeixinUser::getAccessToken();
         $data=[
             'openid_list'=>$openid,
             'tagid'=>100
         ];
            $client= new GuzzleHttp\Client();
         $r = $client->Request('POST', $url, [
             'body' => json_encode($data, JSON_UNESCAPED_UNICODE)
         ]);
         echo '<pre>';print_r(json_decode($r->getBody(), true));;echo '<pre>';
        }
    //黑名单
        public function blank($openid){
         $url='https://api.weixin.qq.com/cgi-bin/tags/members/batchblacklist?access_token='.WeixinUser::getAccessToken();
         $data=[
             "openid_list" => [$openid],
         ];
         $client= new GuzzleHttp\Client();
         $r = $client->Request('POST', $url, [
             'body' => json_encode($data)
         ]);
         echo '<pre>';print_r(json_decode($r->getBody(), true));;echo '<pre>';
        }
}