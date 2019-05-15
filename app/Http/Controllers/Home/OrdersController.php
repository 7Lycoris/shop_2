<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\Orders;
use App\Model\Home\Cart;
use App\Model\Home\Linkman;
use DB;

class OrdersController extends Controller
{
      public function index(Request $request)
    {
        //获取uid
        $user = DB::table('homeuser')->where('username',session('home'))->first();
        $uid = $user->id;

        //获取数据遍历到订单页面
          $oid = Linkman::where('uid',$user->id)->select('id')->get()->toArray();
          // dd($oid);
          if(empty($oid)){
             return view('home.orders.orders',[
            'title'=>'我的订单',
            'uid'=>$uid
          ]
          // compact(('res'))
          );
          }

          
          foreach($oid as $v) {
            $ord[] = Orders::where('oid',$v['id'])->first()->toArray();
          }
            if(!isset($ord)) {
              $ord = '';
            }
            // $user = DB::table('orders_detail')->where('oid',)->first();
 
             // dd($ord);
        return view('home.orders.orders',[
          'title'=>'我的订单',
          'ord'=>$ord,//订单商品数据
          'uid'=>$uid
          ]
          // compact(('res'))
          );
    }

    //向orders_detail(订单详情表中插入数据)
    //
    public function create (Request $request)
    {

      //接收购物车传过来的参数
      $res = $request->except('_token','_method');
         // dd($res['box'][0]);

      //判断是否选中商品,是否选择收货地址
      if (!isset($res['box'])) {
        echo '<script>alert("未选中任何商品");location.href="/home/cart"</script>';
      }
      if($res['address'] == '') {
        echo '<script>alert("未选择收货地址");location.href="/home/cart"</script>';
      }

      //将收货地址 联系人 联系电话分割到数组中
      $str = explode('|',$res['address']);
      //删除数组最后一个空元素
      array_pop($str);
      //下面是存入订单表(orders)的内容
       $info['uid'] = $res['uid'];
       $info['linkman'] = substr(trim($str[1]),12,-2);
       $info['address'] = substr(trim($str[0]),13,-2);
       $info['phone'] = substr(trim($str[2]),15,-2);
       $info['addtime'] = time();
       $info['status'] = 0;
        $addInfo = Linkman::insertGetId($info);
       if(!isset($addInfo)){
        exit('<script>alert("请返回重新选择收货地址");location.href="/home/cart"</script>');
       }

       // 下面是存入订单详情表(orders_detail)的内容
       // 获取相关联的订单表(orders)的id
        $data['oid'] = $addInfo;
        //循环将数据插入数据表
       for($i=0;$i<count($res['box']);$i++){

        $data['gid'] = $res['gid'.$res['box'][$i]];
         $data['gid'] = $data['gid'][0];
        $data['gname'] = $res['gname'.$res['box'][$i]];
         $data['gname'] = $data['gname'][0];
        $data['price'] = $res['price'.$res['box'][$i]];
         $data['price'] = $data['price'][0];
        $data['num'] = $res['num'.$res['box'][$i]];
         $data['num'] = $data['num'][0];
        $data['total'] = $data['price']*$data['num'];
        $data['bianhao'] = time().mt_rand(1111,9999);
        // dd($data);
        $boole = Orders::create($data);
        if(!isset($boole)){
          exit('<script>alert("下单失败");location.href="/home/cart"</script>');
        }
       }
        // 下单成功,销毁购物车数据
       foreach($res['box'] as $k=>$v) {
         Cart::find($v)->delete(); 
         }      
       echo '<script>alert("下单成功");location.href="/home/orders"</script>';

      
       
        }

    
}
