<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\Oneself;
use Hash;

class RepadController extends Controller
{
    public function create()
    {
    	return view('home.repad.create',[
    		'title'=>'找回密码',
    	]);
    }

    public function docreate(Request $request)
    {	
    	// dump($request->all());
    	$phone = $request->phone;
    	return view('home.repad.edit',[
    		'title'=>'设置新密码',
    		'phone'=>$phone,
    	]);

    }

    // 处理密码修改
    public function update(Request $request )
    {
    	
    	// 表单验证
        //  $this->validate($request, [
        //     'password' => 'required',
        //     'repassword' => 'required|same:password',
        // ],[
        //     'password.required'=>'密码不能为空',
        //     'repassword.required'=>'确认密码不能为空',
        //     'repassword.same'=>'两次密码不一致',
        // ]);
        // if ($request->password != $request->repassword) {
        // 	echo '123123';
        // 	return back()->with('error','两次输入密码不一致');
        // }
         // dd($request->all());
    	$phone = $request->phone;
    	$res['password'] = Hash::make($request->password);
    	// 根据手机号查询数据库修改密码
    	$bool = Oneself::where('phone',$phone)->update($res);

    	// dump($bool);
    	if ($bool) {
    		return '<script>alert("密码修改成功,请返回重新登录");location="/home/login"</script>';
    	} else {
    		return '<script>alert("密码修改失败,请返回重新修改");location="/home/login"</script>';;
    	}
    }
}
