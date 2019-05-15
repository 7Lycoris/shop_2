<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;

class LoginController extends Controller
{
    public function login()
    {
    	return view('home.login.login',[
            'title'=>'登录'
        ]);
    }

    // 处理登录的方法
    public function dologin(Request $request)
    {
    	// dump($request->except('_token'));
    	// 获取用户名
    	$name = $request->input('username');

        // 邮箱
        $email_res = '/@/';
        $mat = preg_match($email_res,$name);

        // 手机
        $phone_res = '/^1[3456789]\d{9}$/';
        $result = preg_match($phone_res,$name);

        if ($mat) {
            // 通过用户名查询数据库是否有此用户
            $bool = \DB::table('homeuser')->where('email',$name)->first();
            if (!$bool) {
                return back()->with('error','您输入的邮箱号不存在');
            }

            // 判断状态
            if ($bool->status == '0') {
                return back()->with('error','您的账号未激活,请尽快到注册邮箱激活');
            }
            // return '邮箱登录';
        } elseif($result){ 
            // 通过用户名查询数据库是否有此用户
            $bool = \DB::table('homeuser')->where('phone',$name)->first();
        
            if (!$bool) {
                return back()->with('error','您输入的手机号未注册');
            }
          
            // return '手机登录';
         }else {
        // 通过用户名查询数据库是否有此用户
            $bool = \DB::table('homeuser')->where('username',$name)->first();
        
            if (!$bool) {
                return back()->with('error','用户名错误');
            }

            // 判断状态
            if ($bool->status == '0') {
                return back()->with('error','您的账号未激活,请尽快到注册邮箱激活');
            }
            // return '账号密码登录';
         }


    	// 判断密码
    	if (!Hash::check($request->password,$bool->password)) {
    		return back()->with('error','密码错误');
    	} 
        // 存session
        session(['home'=>$bool->username]);
    	//跳转到前台首页
    	return redirect('/');
    	
    }

    // 退出登录
    public function uplogin()
    {
        session(['home'=>'']);
        return redirect('/home/login');
    }




}
