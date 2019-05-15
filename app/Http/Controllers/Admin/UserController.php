<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRequest;
use Intervention\Image\ImageManagerStatic as Image;
use App\Model\Admin\User;
use App\Model\Admin\Role;
use Hash;
use DB;
class UserController extends Controller
{

    public function userrole($id)
    {   
        // 根据id获取相应的用户名
        $res = User::find($id);

        // 获取用户的相关信息
        $roles = Role::get();

        // 获取用户的相应信息
        $rs = $res->roles;
        // dd($rs);

        $ar = [];
        foreach ($rs as $key => $value) {
            $ar[] = $value->id;
        }

        return view('admin.user.userrole',[
            'title'=>'用户角色添加页面',
            'res'=>$res,
            'roles'=>$roles,
            'ar'=>$ar
        ]);

    }

    public function douserrole(Request $request)
    {
        // 获取用户的id
        $uid = $request->input('id'); 
        // var_dump($uid);

        // 获取角色的id
        $rs = $request->input('role_id');
        // var_dump($rs);

        // 根据用户的id删除信息
        DB::table('user_role')->where('user_id',$uid)->delete();
        $res = [];

        foreach ($rs as $key => $value) {
            $info = [];
            $info['user_id'] = $uid;
            $info['role_id'] = $value;
            $res[] = $info;
        }
        // var_dump($res);

        // 把拼接的信息添加到数据表中
        $data = DB::table('user_role')->insert($res);

        if ($data) {
            return redirect('/admin/user');
        } else {
            return back();
        }
    }
    /**用户列表
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // 获取用户输入的信息
        $search = $request->search;

        // dump($request->input());
        // $res = User::all();
        // 单输入框搜索
        // $res = User::where('username','like','%'.$search.'%')->paginate($request->input('num',10));

        // 两个输入框搜索
        $res = User::orderBy('id','asc')->where(function($query) use($request){
            // 检测关键字
            $username = $request->search;
            $email = $request->email;
            if(!empty($username)){
                $query->where('username','like','%'.$username.'%');
            }
            if(!empty($email)){
                $query->where('email','like','%'.$email.'%');
            }
        })->paginate($request->input('num',10));
        return view('admin.user.index',[
            'title'=>'用户列表',
            'res'=>$res,
            'request'=>$request,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create',[
            'title'=>'用户的添加页面'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        // dd($request);

        // 获取表单传过来的数据
        $res = $request->except('_token','profile','repassword');

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

            $file->move('./upload/admin/user',$names);

           

            // 把图片保存到数据库中
            $res['profile'] = "/upload/admin/user/{$names}";
        }

        // 密码 hash加密
        $res['password'] = Hash::make($request->password);

        // 添加数据到数据库中
        // $data = User::create($res);
        $data = User::create($res);

        if($data){
            // return redirect('/admin/user');
            return '<script>alert("添加用户成功,点击返回用户列表");location="/admin/user"</script>';
        } else {
            return back()->with('error','添加失败');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // echo  $id;
        // 通过id查询数据
        $res = User::find($id);
        // var_dump($res);

        // 显示修改页面
        return view('admin.user.edit',[
            'title'=>'修改用户',
            'res'=>$res,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        //表单验证
        // dd($request->all());
       $this->validate($request, [
            'email' => 'email',
            'phone' => 'required|regex:/^1[3456789]\d{9}$/',
        ],[
            'phone.required'=>'手机号码不能为空',
            'phone.regex'=>'手机号码格式不正确',
            'email.email'=>'邮箱格式不正确'
        ]);

       // 获取表单信息
       // dd($request->all());
       $res = $request->except('_token','_method','profile');

       // 文件上传
       if($request->hasfile('profile')){
        // 获取文件信息
        $file = $request->file('profile');
        // var_dump($file);
        // 修改名字
        $name = rand(1111,9999).time();

        // 获取文件后缀
         $suffix = $file->getClientOriginalExtension();

         $names = $name.'.'.$suffix;

         $file->move('./upload/admin/user',$names);

         
        // 把图片保存到数据库中
        $res['profile'] = "/upload/admin/user/{$names}";
       }

       // 密码
       $res['password'] = Hash::make($request->password);
       $one = User::find($id);
       // dd($one->profile);
       // 修改数据
       $bool = User::where('id',$id)->update($res);

       if($bool){
            // 删除原先数据里面的图片
            unlink('.'.$one->profile);
           echo '<script>alert("修改成功");location="/admin/user"</script>';
       } else {
            return back();
       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // echo $id;
        // 删除数据库中的数据
        $one = User::find($id);
        $bool = User::destroy($id);
        if($bool){
            unlink('.'.$one->profile);
            return '<script>alert("删除成功");location="/admin/user"</script>';
        } else {
            return back();
        }
    }
}
