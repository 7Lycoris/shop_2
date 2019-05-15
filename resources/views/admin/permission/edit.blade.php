@extends('layout.admins')

@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>{{$title}}</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="/admin/permission/{{$res->id}}" method='post'>
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">权限名</label>
                    <div class="mws-form-item">
                        <input type="text" name='pername' class="small" value="{{$res->pername}}">
                    </div>
                </div>
            </div>

            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">权限路径</label>
                    <div class="mws-form-item">
                        <input type="text" name='perurl' class="small" value="{{$res->perurl}}">
                    </div>
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

