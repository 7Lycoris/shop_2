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
require __DIR__ . "\jing.php";
require __DIR__ . "\wang.php";
require __DIR__ . "\ye.php";
require __DIR__ . "\yang.php";
// 后台的登录页面
Route::get('/admin/login','Admin\LoginController@login');
Route::post('/admin/login','Admin\LoginController@dologin');
// 验证码
Route::get('/admin/captcha', 'Admin\LoginController@captcha');
//提示没有权限的路由
Route::get('/admin/roleper','Admin\LoginController@roleper');

// 后台的路由组
// Route::group(['middleware'=>'login'],function(){
Route::group(['middleware'=>['login','checkrole']],function(){
	// require __DIR__ . "yang.php";
	// 后台首页
	Route::get('/admins','Admin\IndexController@index');

	// 管理员管理
	Route::resource('/admin/user','Admin\UserController');
	//添加角色的页面
	Route::get('/admin/userrole/{id}','Admin\UserController@userrole');
	Route::post('/admin/douserrole','Admin\UserController@douserrole');

	// 角色管理
	Route::resource('/admin/role','Admin\RoleController');
	Route::get('/admin/roleper/{id}','Admin\RoleController@roleper');
	Route::post('/admin/doroleper','Admin\RoleController@doroleper');



	//权限管理
	Route::resource('/admin/permission','Admin\PermissionController');

	// 退出登录
	//退出
	Route::get('/admin/logout', 'Admin\LoginController@logout');
	// 修改头像
	Route::get('/admin/profile/{id}','Admin\LoginController@profile');
	Route::post('/admin/doprofile/{id}','Admin\LoginController@doprofile');

	// 修改密码
	Route::get('/admin/changepass/{id}','Admin\LoginController@changepass');
	Route::post('/admin/dopass/{id}','Admin\LoginController@dopass');

	// 分类管理
	Route::resource('/admin/category','Admin\CategoryController');

	// 商品管理
	Route::resource('/admin/goods','Admin\GoodsController');
	Route::get('/admin/goodsnav/{id}','Admin\GoodsController@goodsnav');
	Route::post('/admin/dogoodsnav','Admin\GoodsController@dogoodsnav');


	// 活动管理
	Route::resource('/admin/nav','Admin\NavController');
	
	//广告管理
	Route::resource('/admin/abv','Admin\AbvController');
	//友情链接管理
	Route::resource('/admin/link','Admin\LinkController');

	// 订单管理
	Route::get('/admin/orders','Admin\OrdersController@index');
	// 详细订单
	Route::get('/admin/orders/{id}','Admin\OrdersController@show');
	// 修改订单状态
	Route::get('/admin/status/{id}-{status}','Admin\OrdersController@status');
	// 商品评论
	Route::get('/admin/comment','Admin\OrdersController@comment');

});


//前台的注册页面
Route::get('/home/regist','Home\RegisterController@regist');
Route::post('/home/doregist','Home\RegisterController@doregist');

// 手机注册
// Route::get('/home/cellphone','Home\RegisterController@cellphone');
Route::post('/home/docellphone','Home\RegisterController@docellphone');
// 处理手机验证
Route::get('/home/yzm','Home\RegisterController@yzm');
Route::get('/home/doyzm','Home\RegisterController@doyzm');


// 邮箱验证
Route::get('/home/remind','Home\RegisterController@remind');



// 前台主页
Route::get('/homes','Home\IndexController@index');

// 前台登录页面
Route::get('/home/login','Home\LoginController@login');
Route::post('/home/dologin','Home\LoginController@dologin');

// 找回密码
Route::get('/home/repad','Home\RepadController@create');
Route::post('/home/dorepad','Home\RepadController@docreate');
// 处理修改密码
Route::any('/home/update','Home\RepadController@update');

// 前台路由组
Route::group(['middleware'=>'homelogin'],function(){

	// 个人中心主页
	Route::get('/home/oneself','Home\OneselfController@index');
	// 修改个人中心信息
	Route::get('/home/oneself/edit','Home\OneselfController@edit');
	// 处理修改个人详细信息
	Route::post('/home/oneself/update','Home\OneselfController@update');
	// 修改头像
	Route::get('/home/profile','Home\OneselfController@profile');
	Route::post('/home/doprofile/{name}','Home\OneselfController@doprofile');
	// 修改秘密
	Route::get('/home/oneself/password','Home\OneselfController@password');
	Route::post('/home/oneself/dopassword','Home\OneselfController@dopassword');
	// 查看个人订单
	Route::get('/home/oneself/{id}','Home\OneselfController@orders');
	// 查看个人信息订单
	Route::get('/home/orders/{id}','Home\OneselfController@show');
	// 商品评论
	Route::get('/home/comment/{id}','Home\OneselfController@comment');
	// 处理商品评论
	Route::post('/home/oneself','Home\OneselfController@docomment');
	// 修改订单状态

	// 退出登录
	Route::get('/home/uplogin','Home\LoginController@uplogin');
	// 我的地址
	Route::resource('/home/myadd','Home\MyaddController');
});