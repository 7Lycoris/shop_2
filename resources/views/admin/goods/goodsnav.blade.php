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
    	<form class="mws-form" action="/admin/dogoodsnav?id={{$res->id}}" method="post" enctype='multipart/form-data'>
    		<div class="mws-form-inline">
    			<div class="mws-form-row">
    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">商品名</font></font></label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name="nname" value="{{$res->gname}}">
    				</div>
    			</div>



    			<div class="mws-form-row">
    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">活动名</font></font></label>
    				<div class="mws-form-item clearfix">
    					<ul class="mws-form-list inline">
                            @foreach($navs as $k => $v)
                                @if(in_array($v->id,$ar))
    						      <li><input type="checkbox" name="nav_id[]" value="{{$v->id}}" checked> <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$v->nname}}</font></font></label></li>
                                @else
                                    <li><input type="checkbox" name="nav_id[]" value="{{$v->id}}" > <label><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{$v->nname}}</font></font></label></li>
                                @endif
                            @endforeach
    						  
    					</ul>
    				</div>

    			</div>
    		</div>
    		<div class="mws-button-row">
    			{{csrf_field()}}
    			<font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><input type="submit" value="确定" class="btn btn-info"></font></font>
    			
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