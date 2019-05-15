@extends('layout.admins')

@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>{{$title}}</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="/admin/nav/{{$res->id}}" method='post'>
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">推荐栏名</label>
                    <div class="mws-form-item">
                        <input type="text" name='nname' class="small" required value="{{$res->nname}}">
                        <p style="color: red"></p>
                    </div>
                </div>
            </div>
            <div class="mws-form-row">
                    <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">单选按钮</font></font></label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li><input type="radio" name="status" value="1" @if($res->status == 1) checked @endif> <label><font style="vertical-align: inherit;">显示</font></label></li>
                            <li><input type="radio" name="status" value="0" @if($res->status == 0) checked @endif> <label><font style="vertical-align: inherit;">隐藏</font></label></li>
                        </ul>
                    </div>
                </div>
            <div class="mws-button-row">
                {{csrf_field()}}
                {{method_field('PUT')}}
                <input type="submit" value="修改" class="btn btn-primary">
            </div>
        </form>
    </div>      
</div>
@stop

