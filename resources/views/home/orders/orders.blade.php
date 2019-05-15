@extends('layout.homes')

@section('title',$title)

@section('content')
    
    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="/">首页</a></li>
            <li><a href="/home/oneself">个人中心</a></li>
            <li class="active">我的订单</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-5">
            <ul class="list-group margin-bottom-25 sidebar-menu">
              <li class="list-group-item clearfix"><a href="/home/oneself/password"><i class="fa fa-angle-right"></i> 修改密码</a></li>
              <li class="list-group-item clearfix"><a href="/home/profile"><i class="fa fa-angle-right"></i> 修改头像</a></li>
              <li class="list-group-item clearfix"><a href="/home/orders"><i class="fa fa-angle-right"></i>我的订单</a></li>
              <li class="list-group-item clearfix"><a href="/home/myadd"><i class="fa fa-angle-right"></i> 我的收货信息</a></li>
              <li class="list-group-item clearfix"><a href="/home/oneself/edit"><i class="fa fa-angle-right"></i> 修改个人资料</a></li>
            </ul>
          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <h1>我的订单</h1>
            <div class="goods-page">
              <div class="goods-data clearfix">
                <div class="table-wrapper-responsive">
                <table summary="Shopping cart">
                @if(isset($ord))
                @foreach ($ord as $k => $v)
                  <tr>
                    <th class="goods-page-image">商品图片</th>
                    <th class="goods-page-description">订单信息</th>
                    <th class="goods-page-stock">颜色</th>
                    <th class="goods-page-stock">尺码</th>
                    <th class="goods-page-stock">状态</th>
                    <th class="goods-page-price">合计</th>
                    <th class="goods-page-price"></th>
                  </tr>
                  <tr>
                    <td class="goods-page-image">
                  @php                    
                    $img = DB::table('goodsimg')->where('gid',$v['gid'])->first();
                    @endphp
                    <a href="/home/detail/{{$v['gid']}}"><img src="{{$img->gimg}}" title="{{$v['gname']}}"></a>
                      
                    </td>
                    <td class="goods-page-description" width="250">
                     
                      <h3><a href="/home/detail/{{$v['gid']}}">{{$v['gname']}}</a></h3>
  
                      <p>数量: {{$v['num']}}&nbsp;&nbsp;单价: {{1}}</p>

                      <em>订单编号:{{$v['bianhao']}}</em>

                    </td>
                    <td class="goods-page-stock goods-color">
                      {{$v['color']}}
                    </td>
                    <td class="goods-page-stock goods-size">
                      {{$v['size']}}
                    </td>
                    <td class="goods-page-stock">
                      待发货
                    </td>
                    <td class="goods-page-price">
                      <strong><span>$</span>{{$v['total']}}</strong>
                    </td>
                    <td class="goods-page-stock">
                      <input class="btn btn-primary" type="button" value="订单详情">
                    </td>
                  <!--  <td class="goods-page-stock orders-detail">
                      <a href="/home/orders/{{$v['oid']}}">订单详情</a>
                    </td> -->
                  </tr>
                @endforeach
                @else
                <center>
                <font size="5" color="red">你还没有订单哦</font><img src="/upload/home/cart/xiaomai.png" width="200">
                </center>
                @endif
                </table>
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>

  @stop