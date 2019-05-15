<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\Oneself;
use Hash;
use DB;
use App\Model\Admin\Orders;
use App\Model\Admin\Goodsimg;

class OneselfController extends Controller
{
    //

    // 个人中心主页
    public function index()
    {	
 

    	$res = Oneself::where('username',session('home'))->first();
    	// echo '个人中心首页';
    	return view('home.oneself.index',[
    		'title'=>'个人中心主页',
    		'res'=>$res,
    	]);
    }

    public function edit()
    {	
    	$res = Oneself::where('username',session('home'))->first();
    	// dump($res);
    	// dump($res->nickname);
    	return view('home.oneself.edit',[
    		'title'=>'修改详细信息',
    		'res'=>$res,
    	]);
    }

    // 处理修改个人详细信息的方法
    public function update(Request $request)
    {   
        $this->validate($request, [
            
            'phone' => 'regex:/^1[3456789]\d{9}$/',
        ],[
            
            'phone.regex'=>'手机号码格式不正确',
            
        ]);
    	$res = $request->except('_token');
    	// dump($res);
    	
    	// 文件上传
        if($request->hasFile('profile')){
            // dd(111);
            // 获取文件信息
            $file = $request->file('profile');

            // 修改名字
            $name = rand(1111,9999).time();

            //获取文件的后缀
            $suffix = $file->getClientOriginalExtension();

            $names = $name.'.'.$suffix;

            $file->move('./upload/home/user',$names);

           

            // 把图片保存到数据库中
            $res['profile'] = "/upload/home/user/{$names}";

            // echo '图片上传成功';
        } else {
        	$res['profile'] = '';
        }
        $one = Oneself::where('username',session('home'))->first();
        // dump($one);
        // dump($one->profile);
        // 通过session查询表里面的数据修改
        $bool = Oneself::where('username',session('home'))->update($res);
        // dump($bool);
        

        if ($bool) {
        	// 删除旧数据里面的图片
        	if ($one->profile) {
        		unlink('.'.$one->profile);
        	}
        	
        	echo  '<script>alert("修改成功");location="/home/oneself"</script>';
        	
        } else {
        	return back()->with('error',' 修改失败');
        }

    }


    // 修改头像
    public function profile(){
    	// 从session获取信息
    	// 或者通过id获取信息
    	$res = Oneself::where('username',session('home'))->first();
    	// dump($res->profile);
    	return view('home.oneself.profile',[
    		'title'=>'设置头像信息',
    		'profile'=>$res->profile,
    		'name'=>$res->username,
    	]);
    }

    // 处理头像信息
    public function doprofile(Request $request ,$name)
    {
    	// 获取删除的文件对象
    	// echo $name;
    	
    	$file = $request->file('profile');
    	// echo $file;exit;
    	// 判断文件是否有效
    	if($file->isValid()){
    		// 文件上传的后缀名
    		$entension = $file->getClientOriginalExtension();
    		//设置名字
            $name = date('YmdHis').mt_rand(1000,9999);
            //组成新的名字  jfkdsjfdsfjd.jpg
     
            $newName = $name.'.'.$entension;

            $path = $file->move('./upload/home/user',$newName);

            $filepath = '/upload/home/user/'.$newName;
            //返回文件的路径
            echo  $filepath;
    	}
    	$one = Oneself::where('username',session('home'))->first();
    	$res['profile'] = $filepath;
    	// 改变头像地址
    	$bool = Oneself::where('username',session('home'))->update($res);

    	if ($bool) {
    		// 删除旧数据里面的图片
        	if ($one->profile) {
        		unlink('.'.$one->profile);
        	}
    	}
    }


    // 修改密码
    public function password()
    {

    	// echo '修改密码';
    	return view('home.oneself.password',[
    		'title'=>'修改密码',
    	]);
    }

    // 处理修改密码
    public function dopassword(Request $request)
    {
    	// echo session('home');
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
    	 $res =  Oneself::where('username',session('home'))->first();
    	 // dd($res);

    	 // 把用户的密码查出来
    	 $pass = $res->password;
    	 // dd($request->password);

    	 // 就密码对比
    	 if(!Hash::check($request->password,$pass)){
    	 	return back()->with('error','原密码不正确');
    	 }

    	 // 获取新密码
    	 $new = $request->newpassword;
    	 // 加密
    	 $rs['password'] = Hash::make($new);

    	 $bool = Oneself::where('username',session('home'))->update($rs);

    	 if ($bool) {
    	 	return '<script>alert("密码修改成功,请重新登录");location="/home/login"</script>';
    	 }
    }

    // 个人订单
    public function orders($id)
    {
        // $res = Orders::where('uid',$id)->get();
        $res = Orders::where('uid',$id)->paginate(5);
        // dump($res);
        return view('home.oneself.orders',[
            'title'=>'订单历史',
            'res'=>$res,
        ]);
    }

    // 查看个人信息订单
     public function show($id)
    {
       $res = DB::table('orders_detail')->where('oid',$id)->get();
       // dump($res);
        return view('home.oneself.detail',[
            'title'=>'订单详细列表',
            'res'=>$res,
        ]);
    }

    // 订单评论
    public function comment($id)
    {
        $res = DB::table('goods')->where('id',$id)->first();
        $order = DB::table('orders_detail')->where('gid',$id)->first();
        // 查询商品图片
        // dump($order);
         $imgs = Goodsimg::query()->where('gid',$res->id)->get()->toArray();
        $img = $imgs[0]['gimg'];
        return view('home.oneself.comment',[
            'title'=>'商品评论',
            'res'=>$res,
            'img'=>$img,
            'imgs'=>$imgs,
            'order'=>$order,
        ]);
    }

    // 处理评论
    public function docomment(Request $request)
    {
        $res = $request->except('_token');
        $gid = $request->gid;
        // dump($gid);
        $detail = DB::table('orders_detail')->where('gid',$gid)->first();
        // dump($detail);
        $oid = $detail->oid;
        $res['uname'] = session('home');
        // dd($res);
        // 添加到评论表中
        $bool = DB::table('comment')->insert($res);
        // dump($bool);
        if ($bool) {
            // 修改订单状态
            DB::table('orders')->where('id',$oid)->update(['status'=>4]);
            return redirect('/home/oneself');
        } else {
            return back();
        }
    }
}
