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
    	<form class="mws-form" action="/admin/category/{{$fild->id}}" method="post" enctype='multipart/form-data'>
    		<div class="mws-form-inline">
    			<div class="mws-form-row">
    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">分类名</font></font></label>
    				<div class="mws-form-item">
    					<input type="text" class="small" name="catename" value="{{$fild->catename}}">
    				</div>
    			</div>
                <div class="mws-form-row">
                    <label class="mws-form-label">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">
                                请选择父级分类
                            </font>
                        </font>
                    </label>
                    <div class="mws-form-item">
                        <select class="small" name='pid' disabled>
                            <option value='0'>顶级分类</option>
                            @foreach($res as $k => $v)
	                            @if($fild->pid == $v->id)
	                            <option value='{{$v->id}}' selected>{{$v->catename}}
	                            </option>
	                            @else 
                                    <option value='{{$v->id}}'>{{$v->catename}}</option>
	                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>

    			<div class="mws-form-row">
    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">状态</font></font></label>
    				<div class="mws-form-item clearfix">
    					<ul class="mws-form-list inline">
    						<li>
                                <input type="radio" name="status" value="1" @if($fild->status ==1 ) checked @endif> 
                                <label>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">
                                            显示
                                        </font>
                                    </font>
                                </label>
                            </li>
    						<li>
                                <input type="radio" name="status" value="0" @if($fild->status ==0) checked @endif>
                                 <label>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">隐藏
                                        </font>
                                    </font>
                                </label>
                            </li>
    					</ul>
    				</div>
    			</div>
    		</div>
    		<div class="mws-button-row">
    			{{csrf_field()}}
                {{method_field('PUT')}}
    			<font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><input type="submit" value="提交" class="btn btn-info"></font></font>
    			
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