<?php
 
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Admin\Category;
use App\Model\Admin\Goods;
use App\Model\Admin\Goodsimg;
use App\Model\Admin\Nav; 

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function goodsnav($id)
    {
        //根据id获取相应的商品名
        $res = Goods::find($id);

        //获取活动名相关信息
        $navs = Nav::get();

        //获取商品相应信息
        $rs = $res->navs;

        $ar = [];
        foreach ($rs as $key => $value) {
            $ar[] = $value->id;
        }
        return view('admin.goods.goodsnav',[
            'title'=>'商品的活动添加页面',
            'res'=>$res,
            'navs'=>$navs,
            'ar'=>$ar
        ]);

    }
    public function dogoodsnav(Request $request)
    {
        //获取商品id
        $gid = $request->input('id');

        //获取活动名id
        $nid = $request->input('nav_id');

        //根据商品的id删除信息
        DB::table('goods_nav')->where('goods_id',$gid)->delete();

        $res = [];
        if(!$nid){
            return redirect('/admin/goods');
        }
        foreach($nid as $k => $v){
            $info = [];
            $info['goods_id'] = $gid;
            $info['nav_id'] = $v;
            $res[] = $info;
        }

        $data = DB::table('goods_nav')->insert($res);

        if($data){
            return redirect('/admin/goods');
        }else{
            return back();
        }

    }
    public function index(Request $request)
    {   
        $res = Goods::where('gname','like','%'.$request->search.'%')->paginate($request->input('num',10)); 
        return view('admin.goods.index',[
            'title'=>'商品的列表页面',
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
        $res = Category::select(DB::raw('*,concat(path,id) as paths'))->orderBy('paths')->get();
        foreach ($res as $key => $value) {
            $level = substr_count($value->path,',')-1;

            $value->catename = str_repeat('--|',$level).$value->catename;
        }
        return view('admin.goods.create',[
            'title'=>'商品添加页面',
            'res'=>$res
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
        // 验证表验证
         $this->validate($request,[
            'gname'=>'required',
            'content'=>'required',
            'price'=>'required'

        ],[
           'gname.required'=>'分类名不能为空', 
           'content.required'=>'内容不能为空', 
           'price.required'=>'价格不能为空'
        ]);




        $res = $request->except(['_token','gimg']);

        // dump($res);
        // dd($res['content']);
        // 返回添加的id
        
        
        $gid = Goods::insertGetId($res);
        
        if($request->hasFile('gimg')){

            $files = $request->file('gimg');

            $gs = [];

            foreach($files as $k => $v){

                // dump($v);
                //新的名字
                $gr = [];
                $gr['gid'] = $gid;
                $name = rand(1111,9999).time();

                //后缀
                $suffix = $v->getClientOriginalExtension();

                //移动
                $v->move('./upload/admin/goodsimg/',$name.'.'.$suffix);
                $gr['gimg'] = '/upload/admin/goodsimg/'.$name.'.'.$suffix;
                $gs[] = $gr;
            }
        }
        try {
            $data = Goods::find($gid)->gimgs()->createMany($gs);
            if($data){

                return redirect('/admin/goods')->with('success','添加成功');
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
        // dd(111);
        $res = Goodsimg::find($id);

        // 删除图片存放的信息
        unlink('.'.$res->gimg);

        // 删除表里面的信息
        $data = Goodsimg::where('id',$id)->delete();

        if ($data) {
            echo 1;
        } else {
            echo 0;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res = Category::select(DB::raw('*,concat(path,id) as paths'))->orderBy('paths')->get();

        foreach ($res as $key => $value) {
            $level = substr_count($value->path,',')-1;
            $value->catename = str_repeat('--|',$level).$value->catename;
        }
        // 获取数据回填到修改页面
        $rs = Goods::where('id',$id)->first();

        $gimgs = Goodsimg::where('gid',$id)->get();

        return view('admin.goods.edit',[
            'title'=>'商品的修改页面',
            'rs'=>$rs,
            'res'=>$res,
            'gimgs'=>$gimgs
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
        // 表单验证
        $this->validate($request,[
            'gname'=>'required',
            'content'=>'required',
            'price'=>'required',

        ],[
           'gname.required'=>'分类名不能为空',  
           'content.required'=>'内容不能为空', 
           'price.required'=>'价格不能为空',  
        ]);

        // 商品的基本信息修改
        $res = $request->except('_token','_method','gimg');
        // var_dump($res);
        // exit;
        $bool = Goods::where('id',$id)->update($res);
        // dump($bool);
        // exit;
        //商品的文件上传  跟新添加的商品一致
        
        if($request->hasFile('gimg')){

            $files = $request->file('gimg');
            $gs = [];
            
            foreach($files as $k => $v){

                $gr = [];

                $gr['gid'] = $id;

                // dump($v);
                //新的名字
                $name = rand(1111,9999).time();

                //后缀
                $suffix = $v->getClientOriginalExtension();

                //移动
                $v->move('./upload/admin/goodsimg/',$name.'.'.$suffix);

                $gr['gimg'] = '/upload/admin/goodsimg/'.$name.'.'.$suffix;

                $gs[] = $gr;

            }

            try{
                $data = Goods::find($id)->gimgs()->createMany($gs);
                // dd($data);
                if($data){

                    return redirect('/admin/goods')->with('success','修改成功');
                }
            }catch(Exception $e){

                return back()->with('error','修改失败');
            }
        }

        try{
                if($bool){

                    return redirect('/admin/goods')->with('success','修改成功');
                }
            }catch(Exception $e){

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
        // 一对多删除
        $rs = Goodsimg::where('gid',$id)->get();

        foreach ($rs as $key => $value) {
            unlink('.'.$value->gimg);
        }

        // 删除表goods里面的信息
        $gs = Goods::find($id);

        $gs->delete();

        // 删除和goods表相关联的信息
        $data = $gs->gimgs()->delete();

        if ($data) {
            return '<script>alert("删除成功");location="/admin/goods"</script>';
        } else {
            return back()->with('error','删除失败');
        }
    }

    
}
