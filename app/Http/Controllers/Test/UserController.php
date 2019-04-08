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
    public function reg(){
       echo '注册成功';
    }
}