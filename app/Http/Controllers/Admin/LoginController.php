<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Session;
use Hash;
use App\Model\Admin\User;

class LoginController extends Controller
{
    public function login()
    {
    	// 显示登录页面
    	return view('admin.login.login',[
    		'title'=>'登录页面'
    	]);
    }

    // 处理登录页面信息
    public function dologin(Request $request)
    {	
    	// var_dump($request);
    	// 获取数据
    	$username = $request->username;

    	// 从数据库中查询是否有这个用户名
    	$res = User::where('username',$username)->first();

    	if(!$res){
    		return redirect('/admin/login')->with('error','用户名错误');
    	}

    	if(!Hash::check($request->password,$res->password)){
    		return redirect('/admin/login')->with('error','密码错误');
    	}
        // 登录状态
        // dump($res->status);
        // dd($res);
        if ($res->status !=1) {
            return redirect('/admin/login')->with('error','用户未启用,请联系管理员');
        }

    	// 验证码
    	if($request->code != Session::get('captcha')){
    		return redirect('/admin/login')->with('error','验证码错误');
    	}

    	// 成功往session里面存储信息

        session(['uname'=>$res->username]);
    	session(['adminId'=>$res->id]);
    	// 跳转
    	return redirect('/admins');//后台主页
    }

    // 显示验证码
    public function captcha()
    {
    	// 生成验证码图片的builder对象 配置相应的属性
    	$builder = new CaptchaBuilder;
    	// 可以设置图片宽高字体
    	$builder->build($width = 140, $height = 56 ,$font = null);
    	// 获取验证码内容
    	$phrase = $builder->getPhrase();
    	// 把内容存入session
    	Session::put('captcha',$phrase);

    	// 生成图片
    	 header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    // 退出登录
    public function logout()
    {
    	// 清空session即可
        // dd('退出登录页面');
    	session(['uname'=>'']);
    	// 跳转到登录页面
    	return redirect('/admin/login');
    }


    // 修改头像
    public function profile($id){
    	// 从session获取信息
    	// 或者通过id获取信息
    	$res = User::find($id);
    	return view('admin.login.profile',[
    		'title'=>'设置头像信息',
    		'profile'=>$res->profile,
    		'id'=>$id
    	]);
    }

    // 处理头像信息
    public function doprofile(Request $request ,$id)
    {
    	// 获取删除的文件对象
    	$file = $request->file('profile');
    	// 判断文件是否有效
    	if($file->isValid()){
    		// 文件上传的后缀名
    		$entension = $file->getClientOriginalExtension();
    		//设置名字
            $name = date('YmdHis').mt_rand(1000,9999);
            //组成新的名字  jfkdsjfdsfjd.jpg
     
            $newName = $name.'.'.$entension;

            $path = $file->move('./upload/admin/user/',$newName);

            $filepath = '/upload/admin/user/'.$newName;
            //返回文件的路径
            echo  $filepath;
    	}
         $one = User::find($id);
    	$res['profile'] = $filepath;
    	// 改变头像地址
    	$bool = User::where('id',$id)->update($res);
        if($bool){
            // 删除原先数据里面的图片
            unlink('.'.$one->profile);
        }
    }

    // 修改密码的页面
    public function changepass($id){
    	// echo $id;
    	return view('admin.login.changepass',[
    		'title'=>'修改密码的页面',
    		'id'=>$id,
    	]);
    }

    // 处理修改密码的页面
    public function dopass(Request $request, $id)
    {
    	// var_dump($request);
    	// 表单验证
    	 $this->validate($request, [
            'password' => 'required|regex:/^\S{6,12}$/',
            'newpassword' => 'required|regex:/^\S{6,12}$/',
            'repassword' => 'required|same:newpassword',
        ],[
            'password.required'=>'原密码不能为空',
            'password.regex'=>'原新密码格式不正确',
            'newpassword.required'=>'新密码不能为空',
            'newpassword.regex'=>'新密码格式不正确',
            'repassword.required'=>'确认密码不能为空',
            'repassword.same'=>'两次密码不一致',
        ]);
    	 // 获取用户的信息
    	 $res = User::find($id);
    	 // dd($res);

    	 // 把用户的密码查出来
    	 $pass = $res->password;

    	 // 就密码对比
    	 if(!Hash::check($request->password,$pass)){
    	 	return redirect('/admin/changepass/'.$id)->with('error','原密码不正确');
    	 }

    	 // 获取新密码
    	 $new = $request->newpassword;
    	 // 加密
    	 $rs['password'] = Hash::make($new);

    	 $bool = User::where('id',$id)->update($rs);

    	 if ($bool) {
    	 	return '<script>alert("密码修改成功,请重新登录");location="/admin/login"</script>';
    	 }



    }

    public function roleper()
    {
        //显示没有权限页面
        return view('admin.roleper');
    }

}
