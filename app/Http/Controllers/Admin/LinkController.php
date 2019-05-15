<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Link;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = Link::where('linkname','like','%'.$request->search.'%')->paginate($request->input('num',10));

        return view('admin.link.index',[
            'title'=>'友情链接的列表页面',
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
        return view('admin.link.create',[
            'title'=>'添加友情链接',
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
        $res = $request->except('_token');
        // dump($res);
        // 添加到数据库
        $bool = Link::create($res);
        // dump($bool);
        if ($bool) {
            return '<script>alert("添加成功");location="/admin/link"</script>';
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
        //
        // echo $id;
        $res = Link::find($id);

        return view('admin.link.edit',[
            'title'=>'友情链接的修改的页面',
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
        $res = $request->except('_token','_method');
        // dump($res);
        $bool = Link::where('id',$id)->update($res);
        if ($bool) {
            return '<script>alert("修改成功");location="/admin/link"</script>';
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

        $bool = Link::destroy($id);
        if ($bool) {
            return '<script>alert("删除成功");location="/admin/link"</script>';
        } else {
            return back()->with('error','删除失败');
        }
    }
}
