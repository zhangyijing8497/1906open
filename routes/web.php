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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info', function () {
    phpinfo();
});


Route::prefix('/login/')->group(function(){
    // 注册视图
    Route::get('reg','Index\LoginController@reg');
    // 执行注册
    Route::post('doReg','Index\LoginController@doReg');
    // 登陆视图
    Route::get('login','Index\LoginController@login');
    // 执行登陆
    Route::post('doLogin','Index\LoginController@doLogin');
    // 个人中心
    Route::get('personal','Index\LoginController@personal');
});

Route::get('/getAccessToken','Index\LoginController@getAccessToken');

Route::prefix('/api/')->middleware('access.token')->group(function(){
    Route::get('test','Api\IndexController@test');
    Route::get('userInfo','Api\IndexController@userInfo');
});

Route::get('/github','GithubController@index');//github登陆


