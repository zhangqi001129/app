<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/show', WeixinController::class);//用户管理
    $router->get('/weixin/sendmsg', 'WxSendController@sendMsgView');//消息群发界面
    $router->post('/weixin/action', 'WxSendController@sendmsg');//消息群发界面
});
