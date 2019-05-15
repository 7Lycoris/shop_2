<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// use App\Model\Home\detail;
use App\Model\Admin\Goods;
use App\Model\Admin\Goodsimg;
use App\Model\Admin\Category;
class DetailController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
            // dd($id);
        if(!Goods::find($id)){
            echo 404;
            exit;
        }
        // 找商品的详情
        $gid = $id;      
        $res = Goods::find($id);
        $name = Goods::find($id)->gname;
        $ctype = Category::find($res->cateid);
        $ftype =Category::find($ctype->pid);
        // dd($name);
        // 找商品的图片
        $gimg = Goodsimg::find($gid);
       $mimg = DB::table('goodsimg')->where('gid','=',$gid)->get();
       $mimg = $mimg->toArray();

       //热销商品
       $bsl = DB::select('select g.id,gname,price,gimg,sum from goods as  g RIGHT JOIN (SELECT gid,sum(num) sum FROM `orders_detail` GROUP BY gid ORDER BY sum desc limit 0, 3) as h on g.id = h.gid  JOIN (select * from goodsimg GROUP BY gid) as i on i.gid = g.id;');
       //同类产品
        // dump($res->cateid);
        // $simi  = Goods::where('cateid',$res->cateid)->limit(4)->get();
        //     dump($simi);
        $same = Goods::where('cateid',$res->cateid)->where('id','!=',$id)->limit(4)->get();

            
        // foreach ($same as $key => $value) {
        //     dump($value->gimg->gimg);
        // }
        // dd(1);
        // $sim = DB::select('SELECT g.id, g.gname, g.price, i.gimg FROM goodsimg as i RIGHT JOIN (SELECT id, gname, price FROM goods where cateid='5' LIMIT 4) as g on i.gid = g.id GROUP BY gid');
        // dd($sim);

        return view('home.detail.detail',[
            'title'=>$name,//页面名称
            'res'=>$res,
            'gimg'=>$gimg,
            'mimg'=>$mimg,
            'ctype'=>$ctype,//一级标题
            'ftype'=>$ftype,//父级标题
            'bsl'=>$bsl,//热销
            'same'=>$same//同类
        ]);
    }
}

// $data = $coupon->with(['prcture'=>function($query){
//               $query->select('picture_url');
//             }])
//                ->where('id','>=',1)->limit(2)->select('id','note')->get();

