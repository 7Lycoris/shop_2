<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Admin\Nav;
use App\Model\Admin\Goods;
use App\Model\Admin\Goodsimg;

class NavController extends Controller
{	
	public function index(Request $request,$id)
	{	
		//商品信息
		$rs = nav::find($id)->goods()->paginate(20);

		//图片信息
		$gs = [];
		foreach($rs as $k => $v){

            $v->sub = self::getNavGoodsimg($v->id);

            $gs[] = $v;
        }

        //页面标题
        $nn = Nav::find($id);
        define('t',$ntitle = $nn->nname);
		return view('home.nav.index',[
            't'=>'t',
			'title'=>'导航推荐栏的页面',
			'rs'=>$rs,
			'gs'=>$gs
		]);
	}

	// 获取活动列表关联的商品的图片信息
    public static function getNavGoodsimg($id)
    {

        $gs = Goodsimg::where('gid',$id)->paginate(1);
         // dd($gs);
        return $gs;
    }

    public static function getCateMessage()
    {
        //从父级里面查找子集
        $rs = Nav::all();
        
        return $rs;
    }
}
