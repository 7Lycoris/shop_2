<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Abv;
use App\Model\Admin\Link;

use App\Model\Admin\Nav;
use App\Model\Admin\Category;
use App\Model\Admin\Goods;
use App\Model\Admin\Goodsimg;

class IndexController extends Controller
{
    //
   	public function index()
   	{	
 

   		// dump(session('home'));
   		// return view('home.index',[
   		// 	'title'=>'前台首页',
   		// ]);
      //最新上线推送
   		$navs = Nav::where('nname','新品')->first();
   		$ids = $navs->id;
   		$news = Nav::find($ids)->goods()->paginate(5);
   		
   		$arr = [];
        foreach($news as $k => $v){

            $v->sub = self::getImgs($v->id);

            $arr[] = $v;
        }

      //时尚女装推送
      $nz = Nav::where('nname','时尚女装')->first();
      $nid = $nz->id;
      // dd($nid);
      $nzs = Nav::find($nid)->goods()->paginate(3); 
      $ar = [];
        foreach($nzs as $k => $v){

            $v->sub = self::getImgs($v->id);

            $ar[] = $v;
        }

      //潮流男装推送
      $nr = Nav::where('nname','潮流男装')->first();
      $nrid = $nr->id;
      // dd($nid);
      $nrs = Nav::find($nrid)->goods()->paginate(3); 
      $ars = [];
        foreach($nrs as $k => $v){

            $v->sub = self::getImgs($v->id);

            $ars[] = $v;
        }

      //大屏轮播图推送
      $dpr = Nav::where('nname','大屏轮播图')->first();
      $dpid = $dpr->id;
      // dd($nid);
      $dp = Nav::find($dpid)->goods()->paginate(4); 
      $dps = [];
        foreach($dp as $k => $v){

            $v->sub = self::getDimgs($v->id);

            $dps[] = $v;
        }

      //小屏轮播图推送
      $xpr = Nav::where('nname','小屏轮播图')->first();
      $xpid = $xpr->id;
      // dd($nid);
      $xp = Nav::find($xpid)->goods()->paginate(3); 
      $xps = [];
        foreach($xp as $k => $v){

            $v->sub = self::getImgs($v->id);

            $xps[] = $v;
        }

   		return view('home.index',[
        'title'=>'Anohana',
        'news'=>$news,
        'arr'=>$arr,
        'nzs'=>$nzs,
        'ar'=>$ar,
        'nrs'=>$nrs,
        'ars'=>$ars,
        'dp'=>$dp,
        'dps'=>$dps,
        'xp'=>$xp,
        'xps'=>$xps

      ]);
   	}
   	public static function getImgs($id)
    {
        $gimg = Goodsimg::where('gid',$id)->paginate(1);

        return $gimg;
    }

    public static function getDimgs($id)
    {
        $gimg = Goodsimg::where('gid',$id)->orderBy('id','desc')->paginate(1);

        return $gimg;
    }
    public function gywm()
    {
      return view('home.gywm',['title'=>'关于我们']);
    }
}
