@extends('layout.admins')

@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span>{{$title}}</span>
    </div>
    <div class="mws-panel-body no-padding">
    	<form class="mws-form" action="/admin/role" method='post'>
    		<div class="mws-form-inline">
    			<div class="mws-form-row">
    				<label class="mws-form-label">角色名</label>
    				<div class="mws-form-item">
    					<input type="text" name='rname' class="small">
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
