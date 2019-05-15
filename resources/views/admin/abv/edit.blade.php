@extends('layout.admins')
@section('title',$title)
@section('content')

<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$title}}</font></font></span>
    </div>
    <div class="mws-panel-body no-padding">
    	@if (count($errors) > 0)
    		<div class="mws-form-message error"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
    	<form class="mws-form" action="/admin/abv/{{$res->id}}" method="post" enctype='multipart/form-data'>
    		<div class="mws-form-inline">
    			<div class="mws-form-row">
    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">广告名</font></font></label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name="aname" required value="{{$res->aname}}">
    				</div>
    			</div>
    			
    			
    			<div class="mws-form-row">
    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">广告链接</font></font></label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name="link" required value="{{$res->link}}">
    				</div>
    			</div>
    			<div class="mws-form-row">
    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">广告状态</font></font></label>
    				<div class="mws-form-item clearfix">
    					<ul class="mws-form-list inline">
    						<li><input type="radio" name="status" value="1" @if($res->status ==1) checked @endif> <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">显示</font></font></label></li>
    						<li><input type="radio" name="status" value="0"  @if($res->status ==0) checked @endif> <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">隐藏</font></font></label></li>
    					</ul>
    				</div>
	    			<div class="mws-form-row">
	                	<label class="mws-form-label">广告图片</label>
	                	<img src="{{$res->aimg}}">
	                	<div class="mws-form-item">
	                    	<div class="fileinput-holder" style="position: relative;">
		                    	<input type="file" name='aimg' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;"></span>
		                    </div>
	                    </div>
	                </div>

    			</div>
    		</div>
    		<div class="mws-button-row">
    			{{csrf_field()}}
    			{{method_field('PUT')}}
    			<font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><input type="submit" value="修改" class="btn btn-info"></font></font>
    			
    		</div>
    	</form>
    </div>    	
</div>

@stop

@section('js')
	<script>
		// 4秒后关闭错误信息
		$('.mws-form-message').delay(3000).fadeOut(1200);
	</script>
@stop