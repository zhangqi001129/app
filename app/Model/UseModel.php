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
class UseModel extends Model
{
    public $table='user';
    public $timestamps = false;

}