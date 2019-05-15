<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Model\Admin\Abv;

use App\Model\Admin\Goods;
use App\Model\Admin\Goodsimg;
use App\Model\Admin\orders_detail;

use App\Model\Home\Hotsell;

class CeshiController extends Controller
{
    public function index(Request $request){

    	// var_dump($_POST);
    	dump($request->all());
    	$res = $request->except('_token');
    	dump($res);
    	// $require
    	return view('home.ceshi.ceshi');
    }

    public function bsell(){
	
      // 查询最佳销量
      // select gname,sum(num) from orders_detail group by gid;
      // $bsell = DB::table('orders_detail')
      // ->get();
      // dd($bsell);
      $bsell = DB::table('orders_detail')
      ->groupBy('gid')
      ->orderBy('sold','desc')
      ->selectRaw('gname,gid, sum(num) as sold')
      ->take(3)
      ->get();

      // dd($bsell);

      	// $bid=[];
      foreach ( $bsell as $k => $v) {
      	// echo $v->gid.'<br>';
      	$bid[] = $v->gid;
      }
      // dump($bid);
      //$bid含有三个id,即销量前三
      // echo 9;
      // $binfo = DB::table('goods')->whereIn('id',$bid)->get();
		// ->groupBy('gid')
      // $simg = DB::table('goodsimg')->whereIn('gid',$bid)->get()->groupBy('gid');
      // dd($simg);
      // foreach($simg as $va){
       		// $list[$va[0]->gid] = isset($va[0]) ? $va[0]->gimg : '';
       	// };
       	// dump($list);
      	// dd($binfo);
      	 //遍历$binfo,可在页面直接插入地址
      	 //
      	 // 
      	 //$bid含有三个id,即销量前三 
      	 //循环查三次
      	 // $id=16;
      	 // 
      	 // SELECT
			// 	*
			// FROM
			// 	goods AS g 把goods表取别名g
			// RIGHT JOIN (
			// 	SELECT
			// 		gid,  选择gid和num的求和
			// 		sum(num) sum
			// 	FROM
			// 		`orders_detail`
			// 	GROUP BY 按照gid分组 
			// 		gid
			// 	ORDER BY
			// 		sum DESC 倒序并且只要一个
			// 	LIMIT 0,
			// 	1
			// ) AS h ON g.id = h.gid 把刚才的查询结果看成是表h,当表h的gid和表g的gid
			// JOIN (
			// 	SELECT
			// 		*
			// 	FROM
			// 		goodsimg 按照gid分组 并且把这个结果当成表i
			// 	GROUP BY
			// 		gid
			// ) AS i ON i.gid = g.id; 当表i的gid和表g的gid
      	 // 
      	 "select * from goods as  g RIGHT JOIN (SELECT gid,sum(num) sum FROM `orders_detail` GROUP BY gid ORDER BY sum desc limit 0, 1) as h on g.id = h.gid  JOIN (select * from goodsimg GROUP BY gid) as i on i.gid = g.id;"

      	 dump($bid);

    	 $go = Hotsell::find($id);
    	 foreach($bid as $vk){
    	 	$id=$go;
    	 	$go = Hotsell::find($id);
    	 }

    	// dump($go->gimgs->gimg);
    	// while()
    	
      // exit;

      return view('home.ceshi.ceshi',[
            'title'=>'测试',
            'go'=>$go
        ]);

    }

}
