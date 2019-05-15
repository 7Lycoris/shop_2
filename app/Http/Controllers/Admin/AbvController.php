<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Abv;

class AbvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = Abv::where('aname','like','%'.$request->search.'%')->paginate($request->input('num',10));

        return view('admin.abv.index',[
            'title'=>'广告的列表页面',
            'res'=>$res,
            'request'=>$request
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.abv.create',[
            'title'=>'广告添加',
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
        //
        $res = $request->except('_token','aimg');
        // 文件上传
        if($request->hasFile('aimg')){
            // dd(111);
            // 获取文件信息
            $file = $request->file('aimg');

            // 修改名字
            $name = rand(1111,9999).time();

            //获取文件的后缀
            $suffix = $file->getClientOriginalExtension();

            $names = $name.'.'.$suffix;

            $file->move('./upload/admin/abv',$names);

           

            // 把图片保存到数据库中
            $res['aimg'] = "/upload/admin/abv/{$names}";
        }

        $data = Abv::create($res);

        if($data){
            // return redirect('/admin/user');
            return '<script>alert("添加广告成功,点击返回广告列表");location="/admin/abv"</script>';
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
        $res = Abv::find($id);
        // dump($res);
        return view('admin.abv.edit',[
            'title'=>'广告修改页面',
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
        //
        $res = $request->except('_token','aimg','_method');
        // dump($res);

         if($request->hasFile('aimg')){
            // dd(111);
            // 获取文件信息
            $file = $request->file('aimg');

            // 修改名字
            $name = rand(1111,9999).time();

            //获取文件的后缀
            $suffix = $file->getClientOriginalExtension();

            $names = $name.'.'.$suffix;

            $file->move('./upload/admin/abv',$names);

           

            // 把图片保存到数据库中
            $res['aimg'] = "/upload/admin/abv/{$names}";
        }

        $rs = Abv::find($id);
        // dd($rs->aimg);
        $data = Abv::where('id',$id)->update($res);

        if($data){
            unlink('.'.$rs->aimg);
            return '<script>alert("修改成功");location="/admin/abv"</script>';
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
        //

        // echo $id;
        $rs = Abv::find($id);
        // dd($rs->aimg);
        $data = Abv::destroy($id);

        if($data){
            unlink('.'.$rs->aimg);
            return '<script>alert("删除成功");location="/admin/abv"</script>';
        } else {
            return back()->with('error','删除失败');
        }

    }
}
