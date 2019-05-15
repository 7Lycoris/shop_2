<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Category as Cate;
use DB;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // $res = Cate::all();
        // $res = Cate::where('catename','like','%'.$request->search.'%')->paginate($request->input('num',10));
        $res = Cate::select(DB::raw('*,concat(path,id) as paths'))->where('catename','like','%'.$request->search.'%')->orderBy('paths')->paginate($request->input('num',10));
        // dd($res);
        foreach ($res as $k => $v) {
            $level = substr_count($v->path,',')-1;
            // str_repeat()重复使用字符串,后面的参数是使用的次数
            $v->catename = str_repeat('☆',$level).$v->catename;
        }
        return view('admin.category.index',[
            'title'=>'分类列表',
            'res'=>$res,
            'request'=>$request,
        ]);
    }

    /**显示添加页面
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 原始方式
        // $res = DB::select('select *,concat(path,id) as paths from category order by paths');
        // 构造器或者模型方式
        $res = Cate::select(DB::raw('*,concat(path,id) as paths'))->orderBy('paths')->get();
        foreach ($res as $k => $v) {
            $level = substr_count($v->path,',')-1;
            // str_repeat()重复使用字符串,后面的参数是使用的次数
            $v->catename = str_repeat('☆',$level).$v->catename;
        }
        return view('admin.category.create',[
            'title'=>'添加分类',
            'res'=>$res,
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
        $this->validate($request,[
            'catename'=>'required',

        ],[
           'catename.required'=>'分类名不能为空', 
        ]);

        $res = $request->except('_token');

        if($res['pid'] == 0){
            $res['path'] = '0,';
        } else {
            $rs = Cate::where('id',$res['pid'])->first();
            $res['path'] = $rs->path.$rs->id.',';
        }

        try {
            $bool = Cate::create($res);
            if($bool){
                return '<script>alert("添加分类成功");location="/admin/category"</script>';
            }
        } catch (Exception $e) {
            return '<script>alert("添加分类失败");location="/admin/category/create"</script>';
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
        //显示修改页面
        $res = Cate::select(DB::raw('*,concat(path,id) as paths'))
        ->orderBy('paths')
        ->get();
        foreach ($res as $k => $v) {
            //$v->path  0,1, 0,
            // $level = count(explode(',', $v->path))-2;
            $level = substr_count($v->path,',')-1;

            $v->catename = str_repeat('☆',$level).$v->catename;
        }
        // 单条
        $find = Cate::find($id);
        // var_dump($find);
        return view('admin.category.edit',[
            'title'=>'修改分类',
            'res'=>$res,
            'fild'=>$find,
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
        $this->validate($request, [
            'catename' => 'required',
        ],[
            'catename.required'=>'分类名不能为空',
        ]);
        // var_dump($request);
        // 获取参数
        $res = $request->except('_token','_method');
        if(!$res){
            return '<script>alert("没有要修改的内容,点击返回");location="/admin/category"</script>';
        }
        // var_dump($res);

        // 修改
        try {
            $bool = Cate::where('id',$id)->update($res);

            if($bool){
                return '<script>alert("修改成功,点击返回分类列表");location="/admin/category"</script>';
                // return redirect('/admin/category')->with('success','添加成功');
            }
        } catch (Exception $e) {
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
        $res = CAte::where('id',$id)->first();
        $path = $res->path.$res->id.',';
        // var_dump($path);
        Cate::where('path','like','%'.$path.'%')->delete();

        $bool = Cate::destroy($id);

        if ($bool) {
            return '<script>alert("删除成功");location="/admin/category"</script>';
        } else {
            return back()->with('error','删除失败');
        }
    }

    // 无限极分类
    public static function getCateMessage($pid)
    {
        // 从父级里面查找子级
        $rs = Cate::where('pid',$pid)->paginate(2);
        // var_dump($rs);
        $arr = [];
        foreach($rs as $k => $v){

            $v->sub = self::getCateMessage($v->id);

            $arr[] = $v;
        }

        return $arr;
    }

     public static function getCates($pid)
    {
        // 从父级里面查找子级
        $rs = Cate::where('pid',$pid)->paginate(9);
        // var_dump($rs);
        $arr = [];
        foreach($rs as $k => $v){

            $v->sub = self::getCates($v->id);

            $arr[] = $v;
        }

        return $arr;
    }
}
