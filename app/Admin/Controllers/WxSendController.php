<?php
/**
 * Created by PhpStorm.
 * User: 张琦
 * Date: 2019/3/6
 * Time: 下午 01:37
 */

namespace App\Admin\Controllers;
use App\Http\Controllers\Controller;
use App\Model\WeixinUser;
use Encore\Admin\Layout\Content;
use GuzzleHttp\Client;
class WxSendController extends Controller
{
    /*
     *
     * **/
    public function sendMsgView(Content $content){
        return $content
            ->header('Index')
            ->description('description')
            ->body(view('admin.weixin.sendmsg'));
    }
    public function sendmsg(){
        //获取用户列表
        $users= WeixinUser::all()->toArray();
        $arr_openid = array_column($users,'openid');
        //print_r($arr_openid);exit;
        //发送
        $url='https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='.WeixinUser::getAccessToken();
        $data=[
            'touser' => $arr_openid,
            'msgtype' => 'text',
            'text' => ['content'=>$_POST['msg']]
        ];
        $client= new Client();
        $r = $client->Request('POST', $url, [
            'body' => json_encode($data, JSON_UNESCAPED_UNICODE)
        ]);
        $response_arr = json_decode($r->getBody(), true);
        if ($response_arr['errcode'] == 0) {
            echo "发送成功";
        } else {
            echo "发送失败";
            echo '</br>';
            echo $response_arr['errmsg'];
        }

    }
}