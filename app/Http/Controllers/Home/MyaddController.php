<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Home\Myadd;

class MyaddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $i = 1;
        $user = DB::table('homeuser')->where('username',session('home'))->first();
        $res = DB::table('myadd')->where('uid',$user->id)->get();
        // dump($res);
        return view('home.myadd.index',[
            'title'=>'我的地址列表',
            'res'=>$res,
            'i'=>$i,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        
        return view('home.myadd.create',[
            'title'=>'添加新地址',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            
            'phone' => 'regex:/^1[3456789]\d{9}$/',
        ],[
            
            'phone.regex'=>'手机号码格式不正确',
            
        ]);
        $res =  $request->except('_token');
        // dump($res['address']);
        // strip_tags()把html,php标签剥去
        $res['address'] = strip_tags($res['address']);
        // dump($rs);
      
        $user = DB::table('homeuser')->where('username',session('home'))->first();
        // dump($user->id);
        $res['uid'] = $user->id;

        $bool = Myadd::create($res);
        if ($bool) {
            return '<script>alert("地址添加成功");location="/home/myadd"</script>';
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
        // echo '修改';
        $res = Myadd::find($id);
        // dump($res);

        return view('home.myadd.edit',[
            'title'=>'修改联系人信息',
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
        $this->validate($request, [
            
            'phone' => 'regex:/^1[3456789]\d{9}$/',
        ],[
            
            'phone.regex'=>'手机号码格式不正确',
            
        ]);
        $res = $request->except('_token','_method');
        // dump($res);
        $res['address'] = strip_tags($request->address);
        $res['name'] = strip_tags($request->name);
        // dump($res);
        $bool = Myadd::where('id',$id)->update($res);
        if ($bool) {
            return '<script>alert("地址修改成功");location="/home/myadd"</script>';
        } else {
            return back()->with('error','修改失败');
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
        $bool = Myadd::destroy($id);
        if ($bool) {
            return '<script>alert("地址删除成功");location="/home/myadd"</script>';
        } else {
            return back()->with('error','删除失败');
        }

    }
}
