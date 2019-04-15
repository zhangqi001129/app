<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Index\IndexController@index')->middleware('check.login');
//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//用户
Route::get('/useradd', 'UserController@add');
//测试
Route::get('/weixin/token', 'Weixin\WxController@getAccessToken');
//
Route::get('/weixin/u/{openid}', 'Weixin\WxController@getUserInfo');
Route::get('/weixin/tag', 'Weixin\WxController@tag');
Route::get('/weixin/show', 'Weixin\WeixinUserController@show');
//黑名单
Route::get('/weixin/hei/{openid}','Weixin\WeixinUserController@blank');
Route::post('/weixin/tag','Weixin\WeixinUserController@tag');

//测试注册 登录
Route::post('/reg','Test\UserController@reg');
Route::post('/login','Test\UserController@login');
Route::post('/select','Test\UserController@select');
Route::post('/add','Test\UserController@add');



//二维码登录
Route::get('/code', 'Test\UserController@code');
Route::post('/tokenlogin','Test\UserController@tokenlogin');
Route::post('/coderedis', 'Test\UserController@coderedis');