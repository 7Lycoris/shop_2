<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Libs\Ucpaas\Ucpaas;
use DB;
use Mail;
use Hash;
class RegisterController extends Controller
{
    //
	public function regist()
	{
		return view('home.regist.login',[
			'title'=>'用户注册',
		]);
	}

	// 接收注册信息
	public function doregist(Request $request)
	{

		// 表单验证
		$this->validate($request,[
            'username' => 'required|unique:homeuser',
            'password' => 'required|regex:/^\S{6,12}$/',
            'email' => 'email|unique:homeuser',
         
        ],[
           'username.required'=>'用户名不能为空',
           'username.unique'=>'用户名已存在',
            'password.required'=>'密码不能为空',
            'password.regex'=>'密码格式不正确',
            'email.email'=>'邮箱格式不正确',
            'email.unique'=>'邮箱号已被注册',
        ]);

		$res = $request->except('_token','repassword');
		$res['password'] = Hash::make($request->password);
		$res['token'] = str_random(32);
		$res['username'] = strip_tags($request->username);
		// dd($res);

		// 玩表里添加数据
		$uid = DB::table('homeuser')->insertGetId($res);
		//对用户的id进行存储
        session(['uid'=>$uid]);
		// dd($uid);
		if ($uid) {
			$res['username'] = '';
			
			Mail::send('home.emails.reminder', [
				'rs'=>$res,'uid'=>base64_encode($uid),'title'=>'内容页面','token'=>$res['token']], function ($m) use ($res){

		            $m->from(env('MAIL_USERNAME'), '注册测试邮件');

		            $m->to($res['email'], $res['username'])->subject('主题内容');
       			});
			 //发送成功给用户一个提示
        	return view('home.emails.tixing');
		}
	}

	// 修改账号的状态
	public function remind(Request $request)
	{
		// 接收id信息
		// dd($request->id);
		// 对id解密
		$uid = base64_decode($request->id);

		// 获取id获取token
		$tk = DB::table('homeuser')->where('id',$uid)->first();
		// dd($tk);
		//获取token
        $token = $request->token;
        // dd($token);
        //对比token
        if($tk->token != $token){

            return 'token验证失败';
        }

        //根据id的信息 修改状态

    	$rs['status'] = '1';
		$data = DB::table('homeuser')->where('id',$uid)->update($rs);
		// var_dump($data);
		if($data) {
			echo '<script>alert("用户激活成功,点击返回登录");location="/home/login"</script>';
		}
	}


	// 手机注册
	public function docellphone(Request $request)
	{
		$this->validate($request,[
            'password' => 'required|regex:/^\S{6,12}$/',
            'phone' => 'regex:/^1[3456789]\d{9}$/|unique:homeuser'
        ],[

            'password.required'=>'密码不能为空',
            'password.regex'=>'密码格式不正确',
            'phone.regex'=>'手机号码格式不正确',
            'phone.unique'=>'您输入的手机号已注册',
        ]);
		// echo '12312';
		$res = $request->except('_token','code');
		$res['password'] = Hash::make($request->password);
		$res['username'] = str_random(6);

		$bool = DB::table('homeuser')->insertGetId($res);
		// dd($bool);
		if($bool) {
			session(['home'=>$res['username']]);
			// dd(session('home'));
			return '<script>alert("注册成功");location="/"</script>';
		} else {
			return back()->with('error','注册失败');
		}

	}

	public function yzm()
	{
		//初始化必填
		//填写在开发者控制台首页上的Account Sid
		$options['accountsid']='399dd825f051090134937161a9192df1';
		//填写在开发者控制台首页上的Auth Token
		$options['token']='a0e5ef71e5e8485ac8920099dc5c3aae';

		//初始化 $options必填
		$ucpass = new Ucpaas($options);

		$appid = "030509a1732c4dbaa4cd6e486f0fb999";	//应用的ID，可在开发者控制台内的短信产品下查看
		$templateid = "439982";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
		$param = rand(111111,999999); //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空

		// $_SESSION['param'] = $param;
		session(['param'=>$param]);

		$mobile = $_GET['yzmtel'];

		// 876736
		// 343560
		// 


		$uid = "";
		//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

		echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);

	}

	public function doyzm()
	{
		$cv = $_GET['cv'];

		// echo $cv;
		//获取手机上的验证码
		$pcv = session('param');

		//判断
		if($cv == $pcv){

			echo 1;
		} else {

			echo 0;
		}
	}
}
