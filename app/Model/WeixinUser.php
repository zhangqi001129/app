<?php
/**
 * Created by PhpStorm.
 * User: 张琦
 * Date: 2019/3/6
 * Time: 上午 09:07
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
class WeixinUser extends Model
{
    public $table='weixin';
    public $timestamps = false;


    public static $redis_weixin_access_token_key='str:weiixn:access_token';//微信 access_token
    /*
     * 获取accesstoken
     * */
    public static function getAccessToken(){
        //获取缓存
        $access_token=Redis::get(self::$redis_weixin_access_token_key);
        if(!$access_token){
            $url='https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WEIXIN_APPID').'&secret='.env('WEIXIN_APP_SECRET');
            $data=json_decode(file_get_contents($url),true);
            $access_token = $data['access_token'];;
            //写入缓存
            Redis::set(self::$redis_weixin_access_token_key,$access_token);
            //设置过期时间
            Redis::setTimeout(self::$redis_weixin_access_token_key,3600);
        }
        return $access_token;
    }
}