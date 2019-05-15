@extends('home.oneself.oneself')

@section('title',$title)
 @section('oneself')
 <h3><a href="/home/oneself" class="btn btn-info" style="border-radius: 13px">返回个人中心</a></h3>
<div class="table-responsive">
  <table class="table">
    <tr>
      <th>商品编号</th>
      <th>商品图片</th>
      <th>商品名称</th>
      <th>商品价格</th>
      <th>商品数量</th>
      <th>总价</th>
      <th>商品颜色</th>
      <th>尺码</th>
      <th></th>
    </tr>
    @foreach($res as $k => $v)
    <tr>
      <td>{{$v->bianhao}}</td>
      <td>
        @php
        $img = DB::table('goodsimg')->where('gid',$v->gid)->first();
        @endphp
        <img src="{{$img->gimg}}" width="50px">
      </td>
      <td width="220px">{{$v->gname}}</td>
      <td>{{$v->price}}</td>
      <td>{{$v->num}}</td>
      <td>{{$v->total}}</td>
      <td>{{$v->color}}</td>
      <td>{{$v->size}}</td>
      <td>
        <a href="/home/comment/{{$v->gid}}" class="btn btn-primary">点击评论</a>
        
      </td>
    </tr>
    @endforeach
  </table>
</div>
  @stop