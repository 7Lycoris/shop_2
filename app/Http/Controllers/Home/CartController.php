<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\Cart;
use DB;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //如果没有登录,则先跳转到登录页面
        if (empty(session('home'))) {
            echo '<script>alert("请登录后再查看购物车");location.href="/home/login"</script>';
        };
        //获取uid
        $user = DB::table('homeuser')->where('username',session('home'))->first();
        $uid = $user->id;
        //获取购物车的数据
         $res = Cart::where('uid',$user->id)->get();

         //根据商品id获取商品的图片
         $imgId = Cart::where('uid',$user->id)->select('gid')->get()->toArray();
         foreach($imgId as $k=>$v) {
            // $gimg .= $v['gid'].',';
            $gimg[$v['gid']] = DB::table('goodsimg')->where('gid',$v['gid'])->select('gimg')->first();
         }
           if(!isset($gimg)) {
                $gimg = '';
           }
         //获取收货地址信息
         $address = DB::table('myadd')->where('uid',$uid)->get();

         //设置一个option标签的value自增
         $i=0;
         // dd('zc');

        return view('home.shopcart.cart',[
            'title'=>'我的购物车',
            'res'=>$res,
            'gimg'=>$gimg,
            'uid'=>$uid,
            'address'=>$address,
            'i'=>$i
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

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
          $res = Cart::find($id)->delete();
         // $res = true;
        if ($res) {
            exit(json_encode(['code' => 1, 'msg' => '删除成功']));
        }
            exit(json_encode(['code' => 0, 'msg' => '删除失败']));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        //如果没有登录,则先跳转到登录页面
        if (empty(session('home'))) {
            echo '<script>alert("请登录后再查看购物车");location.href="/home/login"</script>';
        };

        //获取uid
        $user = DB::table('homeuser')->where('username',session('home'))->first();
        $uid = $user->id;

        //插入购物车表
        $res = DB::table('goods')->where('id',$id)->first();

        $data['uid']=$user->id;
        $data['gid']=$id;
        $data['gname']=$res->gname;
        $data['price']=$res->price;
        $boole = Cart::create($data);
        if($boole){
            echo '<script>alert("添加购物车成功");location="/home/cart"</script>';
        }else{
            echo '<script>alert("添加购物车失败")</script>';
        }
        
        // dd($data);

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
        
        //如果没有登录,则先跳转到登录页面
        if (empty(session('home'))) {
            echo '<script>alert("请登录后再查看购物车");location.href="/home/login"</script>';
        };

        //获取uid
        $user = DB::table('homeuser')->where('username',session('home'))->first();
        $uid = $user->id;

        //插入购物车表
        $res = DB::table('goods')->where('id',$id)->first();

        $data['uid']=$user->id;
        $data['gid']=$id;
        $data['gname']=$res->gname;
        $data['price']=$res->price;
        $data['size']=$request->size;
        $data['color']=$request->color;
        // dd($data);
        $boole = Cart::create($data);
        if($boole){
            echo '<script>alert("添加购物车成功");location="/home/cart"</script>';
        }else{
            echo '<script>alert("添加购物车失败")</script>';
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cart_id)
    {

    }
}
