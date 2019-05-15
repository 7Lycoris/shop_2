@extends('home.oneself.oneself')

@section('title',$title)
 @section('oneself')
 <h3><a href="/home/oneself" class="btn btn-info" style="border-radius: 13px">返回个人中心</a></h3>
<div class="table-responsive">
  <table class="table">
    <tr>
      <th>编号</th>
      <th>联系人</th>
      <th>联系人地址</th>
      <th>联系电话</th>
      <th>邮编</th>
      <th>下单时间</th>
      <th>订单状态</th>
      <th>其他</th>
    </tr>
    @foreach($res as $k => $v)
    <tr>
      <td>{{$v->id}}</td>
      <td>{{$v->linkman}}</td>
      <td>{{$v->address}}</td>
      <td>{{$v->phone}}</td>
      <td>{{$v->code}}</td>
      <td>{{date('Y-m-d H:i:s',$v->addtime)}}</td>
      <td>
         @switch($v->status)
            @case(0)
                <a class="btn btn-danger" href="#" >等待发货</a>
                @break

            @case(1)
                <a class="btn btn-warning" href="#" >运输中</a>
                @break
            @case(2)
                <a class="btn btn-info" href="/admin/status/{{$v->id}}-{{3}}" >确认收货</a>
                @break
            @case(3)
                <a class="btn btn-warning" href="#" >等待评论</a>
                @break
            @default
                <a class="btn btn-success" href="#" >订单完成</a>
        @endswitch
      </td>
      <td>
        <a href="/home/orders/{{$v->id}}" class="btn btn-primary">查看信息订单</a>
        
      </td>
    </tr>
    @endforeach
  </table>

    <div class="">
     {{$res->links()}}
    </div>
</div>
  @stop