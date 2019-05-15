<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Orders;
use App\Model\Admin\Comment;
use DB;

class OrdersController extends Controller
{
    //
     public function index(Request $request)
    {
         $search = $request->search;
        $res = Orders::where('linkman','like','%'.$search.'%')->paginate($request->input('num',10));
        return view('admin.orders.index',[
            'title'=>'订单列表',
            'res'=>$res,
            'request'=>$request,
        ]);
    }
     public function show($id)
    {
       $res = DB::table('orders_detail')->where('oid',$id)->get();
        return view('admin.orders.detail',[
            'title'=>'订单详细列表',
            'res'=>$res,
        ]);
    }

     // 修改状态的方法
    public function status($id,$status)
    {
        // 通过id修改订单状态
        $res['status'] = $status;
        $bool =  Orders::where('id',$id)->update(['status'=>$status]);
        if ($bool) {
        	return back();
        } else {
        	return back();
        }
    }

    public function comment(Request $request)
    {
        $search = $request->search;
        $res = Comment::where('uname','like','%'.$search.'%')->paginate($request->input('num',10));
        // dd($res);
        return view('admin.orders.comment',[
            'title'=>'商品评论',
            'res'=>$res,
            'request'=>$request,
        ]);
    }
}
