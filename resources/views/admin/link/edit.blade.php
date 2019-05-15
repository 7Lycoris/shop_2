@extends('layout.admins')

@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>{{$title}}</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="/admin/link/{{$res->id}}" method='post'>
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">链接名</label>
                    <div class="mws-form-item">
                        <input type="text" name='linkname' class="small" required value="{{$res->linkname}}">
                        <p style="color: red">例如:百度</p>
                    </div>
                </div>
            </div>

            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">链接路径</label>
                    <div class="mws-form-item">
                        <input type="text" name='link' class="small" placeholder="" required value="{{$res->link}}">
                        <p style="color: red">例如:www.baidu.com</p>
                    </div>
                </div>
            </div>
            <div class="mws-form-row">
                <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">状态</font></font></label>
                <div class="mws-form-item clearfix">
                    <ul class="mws-form-list inline">
                        <li><input type="radio" name="status" value="0" @if($res->status == 0) checked @endif> <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">隐藏</font></font></label></li>
                        <li><input type="radio" name="status" value="1"@if($res->status == 1) checked @endif> <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">显示</font></font></label></li>
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

