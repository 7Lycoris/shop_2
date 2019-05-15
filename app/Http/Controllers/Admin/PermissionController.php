<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Permission;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $res = Permission::where('pername','like','%'.$request->search.'%')->paginate($request->input('num',10));

        return view('admin.permission.index',[
            'title'=>'权限的列表页面',
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
        //
        return view('admin.permission.create',[
            'title'=>'添加权限',
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
        $res = $request->except('_token');

        try {
            $data = Permission::create($res);
            if ($data) {
                return '<script>alert("添加成功");location="/admin/permission"</script>';
            }
        } catch (Exception $e) {
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
        $res = Permission::find($id);

        return view('admin.permission.edit',[
            'title'=>'权限修改',
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
        // echo $id;
        $res = $request->except('_token','_method');

        $data = Permission::where('id',$id)->update($res);

         if ($data) {
            return '<script>alert("修改成功");location="/admin/permission"</script>';
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
        $data = Permission::destroy($id);

        if ($data) {
            return '<script>alert("删除成功");location="/admin/permission"</script>';
        } else {
            return back()->with('error','删除失败');
        }
    }
}
