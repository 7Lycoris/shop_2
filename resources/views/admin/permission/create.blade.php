@extends('layout.admins')

@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>{{$title}}</span>
    </div>
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="/admin/permission" method='post'>
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">权限名</label>
                    <div class="mws-form-item">
                        <input type="text" name='pername' class="small">
                    </div>
                    <label class="mws-form-label">例如:</label>
                    <label class="mws-form-label" style="color: red">查看用户评论</label>
                </div>
            </div>

            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">权限路径</label>
                    <div class="mws-form-item">
                        <input type="text" name='perurl' class="small">
                    </div>
                    <label class="mws-form-label">例如:</label>
                    <label class="mws-form-label" style="color: red">App\Http\Controllers\Admin\PermissionController@create</label>
                </div>
            </div>


            <div class="mws-button-row">
                {{csrf_field()}}
                <input type="submit" value="添加" class="btn btn-primary">
            </div>
        </form>
    </div>      
</div>
@stop

