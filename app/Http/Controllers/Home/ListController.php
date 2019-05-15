<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Model\Admin\Category as Cate;
use App\Model\Admin\Goods;
use App\Model\Admin\Goodsimg;
class ListController extends Controller
{
    public function index(Request $request , $cateid){

        // if(!Cate::find($cateid)){
            // echo 404;
            // exit;
        // }

        //主页->男装->西服(tt)
     
       
        $tt = DB::table('category')->where('id',$cateid)->first();      
        // dump($tt);

        $tt1 = Cate::where('id',$tt->pid)->first();    


    	
        // 找商品的信息
       	// $cateid = 6;
       	$info = DB::table('goods')->where('cateid',$cateid)->paginate(6);
        // dd($info);
        // $info->items()
       	// $info = $info->toArray();

       	// 把一个商品的多个图片进行分组
       	$simg = DB::table('goodsimg')->get()->groupBy('gid');
       	// 若要运行下面这个语句,在database.php中把mysql的strict'=> false,改成true
       	// $kimg = DB::select('SELECT * FROM `goodsimg` GROUP BY gid');	
       	// 遍历出再次分出id和对应的图片地址
        // list:图片信息
       	foreach($simg as $va){
       		$list[$va[0]->gid] = isset($va[0]) ? $va[0]->gimg : '';
       	};
        // dd($simg);
        // dd($list);
       	//获得左侧商品列表的新数据
       	//顶级分类
       	$categ = DB::table('category')->where('pid','0')->get();
       	//分类里的商品品牌
       	// $categ1 = DB::table('category')->where('path','like','%0,%,')->get();
        // dd($categ1);

        $categ = DB::table('category')->get();
        $lista  = self::dg($categ, 0);
        // dd($lista);
        // dd($lista);
        // 
        //热销产品
        // 
        $bsl = DB::select('select g.id,gname,price,gimg,sum from goods as  g RIGHT JOIN (SELECT gid,sum(num) sum FROM `orders_detail` GROUP BY gid ORDER BY sum desc limit 0, 3) as h on g.id = h.gid  JOIN (select * from goodsimg GROUP BY gid) as i on i.gid = g.id;');
        // dd($bsl);
        // 按类型只查询图片和名字价格SELECT g.id, g.gname, g.price, i.gimg FROM goodsimg as i RIGHT JOIN (SELECT id, gname, price FROM goods where cateid=5 LIMIT 4) as g on i.gid = g.id GROUP BY gid

    	return view('home.list.list',['title'=>'商品列表',
    		'info'=>$info,
    		'list'=>$list,
    		'categ'=>$categ, 
        'tt'=>$tt,//主页->男装->西服(tt)
        'tt1'=>$tt1,//主页->男装(tt1)->西服(tt)
        'bsl'=>$bsl,//热销产品信息
    		// 'categ1'=>$categ1,
        'lista'=>$lista
    		]);
    }

    public function ww(Request $request , $cateid){

    }

    protected static function dg($data,$pid){
      $lista = [];
      foreach($data as $key => $value){
          if ($value->pid == $pid){
            
              unset($data[$key]);
              $value->typelevel = self::dg($data,$value->id);
              $lista[] = $value;
          }
      }
      return $lista;
    }

  // public function getChild(Request $request, $pid) {
  //     echo $pid;
  // }
    
}
