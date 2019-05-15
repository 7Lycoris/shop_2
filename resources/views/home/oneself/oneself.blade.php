@extends('layout.homes')

@section('title',$title)

@section('content')

 <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.html">首页</a></li>
            <li class="active">个人信息</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-3">
            <ul class="list-group margin-bottom-25 sidebar-menu">
              <li class="list-group-item clearfix"><a href="/home/oneself/password"><i class="fa fa-angle-right"></i>修改密码</a></li>              
              <li class="list-group-item clearfix"><a href="/home/profile"><i class="fa fa-angle-right"></i>修改头像</a></li>
              <li class="list-group-item clearfix"><a href="/home/orders"><i class="fa fa-angle-right"></i>我的订单</a></li>               
              <li class="list-group-item clearfix"><a href="/home/myadd"><i class="fa fa-angle-right"></i>我的收货信息</a></li>              
              <li class="list-group-item clearfix"><a href="/home/oneself/edit"><i class="fa fa-angle-right"></i>修改个人资料</a></li>              
            </ul>
          </div>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <h1>{{$title}}</h1>
            @section('oneself')
           


            @show
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>

@stop