<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Admin\Nav;
use App\Model\Admin\Goods;
use App\Model\Admin\Goodsimg;

class NavController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $res = Nav::where('nname','like','%'.$request->search.'%')->paginate($request->input('num',10));

        return view('admin.nav.index',[
            'title'=>'首页推荐的列表页面',
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
        return view('admin.nav.create',[
            'title'=>'首页推荐的添加页面',
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
        $bool = Nav::create($res);
        // dump($bool);
        if ($bool) {
            return '<script>alert("添加成功");location="/admin/nav"</script>';
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
        $res = Nav::find($id);

        return view('admin.nav.edit',[
            'title'=>'首页推荐的修改页面',
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
        $bool = Nav::where('id',$id)->update($res);
        if ($bool) {
            return '<script>alert("修改成功");location="/admin/nav"</script>';
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

        $bool = Nav::destroy($id);
        if ($bool) {
            return '<script>alert("删除成功");location="/admin/nav"</script>';
        } else {
            return back()->with('error','删除失败');
        }
    }

    // 获取活动列表
    public static function getNav()
    {
        $res = Nav::where('status','1')->get();

        $arr = [];
        foreach($res as $k => $v){

            $v->sub = self::getNavGoods($v->id);

            $arr[] = $v;
        }

        return $arr;
    }
    // 获取活动列表关联的商品信息
    public static function getNavGoods($id)
    {

        $rs = Nav::find($id)->goods()->paginate(4);
        $arr = [];
        foreach($rs as $k => $v){

            $v->sub = self::getNavGoodsimg($v->id);

            $arr[] = $v;
        }


        return $arr;
    }

    // 获取活动列表关联的商品的图片信息
    public static function getNavGoodsimg($id)
    {

        $gs = Goodsimg::where('gid',$id)->paginate(1);
         // dd($gs);
        return $gs;
    }

}
