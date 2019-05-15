@extends('home.oneself.oneself')

@section('title',$title)
 @section('oneself')
          <div class="content-page">
          		<style type="text/css">
          			span{
          				/*margin-left: 10px;*/
          				color: blue;
          				/*padding-left: 70px;*/
          			}
          			li{
          				list-style: none;
          			}
          		</style>
              <h3>基本信息</h3>
              <ul>
                <li>用户名:&nbsp;&nbsp;&nbsp;<span>{{$res->username}}</span></li>
                <li>昵&nbsp;&nbsp;&nbsp;称:&nbsp;&nbsp;&nbsp;<span>{{$res->nickname?$res->nickname:'请尽快修改昵称'}}</span></li>
                <li>邮&nbsp;&nbsp;&nbsp;箱:&nbsp;&nbsp;&nbsp;<span>{{$res->email?$res->email:'请尽快修改邮箱'}}</span></li>
                <li>手机号:&nbsp;&nbsp;&nbsp;<span>{{$res->phone?$res->phone:'请尽快修改手机号'}}</span></li>
                <li>地&nbsp;&nbsp;&nbsp;址:&nbsp;&nbsp;&nbsp;<span>
                  @php
                    $user = DB::table('myadd')->where('uid',$res->id)->first();
                  @endphp
                  {{$res->address?$res->address:'请尽快修改地址'}}
                </span></li>
              </ul>
              <hr>
              <h3>头像</h3>
              <img src="{{$res->profile}}" width="200px">   
              <hr>
              <h3>我的订单</h3>
              <ul>
                <li><a href="/home/oneself/{{$res->id}}">查看订单历史记录</a></li>
                <li><a href="javascript:;">下载</a></li>
                <li><a href="javascript:;">您的奖励积分</a></li>
                <li><a href="javascript:;">查看您的退货申请</a></li>
                <li><a href="javascript:;">你的交易</a></li>
              </ul>
            </div> 
  @stop