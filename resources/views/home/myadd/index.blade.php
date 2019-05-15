@extends('home.oneself.oneself')

@section('title',$title)
 @section('oneself')
 <h3><a href="/home/myadd/create" class="btn btn-info" style="border-radius: 13px">添加新地址</a></h3>
<div class="table-responsive">
  <table class="table">
    <tr>
      <th>编号</th>
      <th>地址</th>
      <th>联系人</th>
      <th>联系电话</th>
      <th>操作</th>
    </tr>
    @foreach($res as $k => $v)
    <tr>
      <td>
        @php
        echo $i++;
        @endphp
      </td>
      <td>{{$v->address}}</td>
      <td>{{$v->name}}</td>
      <td>{{$v->phone}}</td>
      <td>
        <a href="/home/myadd/{{$v->id}}/edit" class="btn btn-warning">编辑</a>
        <form action="/home/myadd/{{$v->id}}" method="post" style="display: inline">
          {{csrf_field()}}
          {{method_field('DELETE')}}
          <button class="btn btn-danger" onclick="return confirm('是否确定删除')">删除</button>
          
        </form>
        
      </td>
    </tr>
    @endforeach
  </table>
</div>
  @stop