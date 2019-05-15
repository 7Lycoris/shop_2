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
        @if(session('error'))
            <div class="mws-form-message warning">
                {{session('error')}}
            </div>
        @endif
    	<form class="mws-form" action="/admin/dopass/{{$id}}" method="post" enctype='multipart/form-data'>
    		<div class="mws-form-row">
    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">原密码</font></font></label>
    				<div class="mws-form-item">
    					<input type="password" class="small" name="password">
                        <img src="/img/close.png" class='imgs' alt="">
    				</div>
    			</div>
                <div class="mws-form-row">
                    <label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">新密码</font></font></label>
                    <div class="mws-form-item">
                        <input type="password" class="small" name="newpassword">
                    </div>
                </div>
    			<div class="mws-form-row">
    				<label class="mws-form-label"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">确认密码</font></font></label>
    				<div class="mws-form-item">
    					<input type="password" class="small" name="repassword">
    				</div>
    			</div>
    		<div class="mws-button-row">
    			{{csrf_field()}}
    			<font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><input type="submit" value="提交" class="btn btn-info"></font></font>
    			
    		</div>
    	</form>
    </div>    	
</div>

@stop

@section('js')
   <!-- <script src="/js/jquery-3.2.1.min.js"></script> -->
	<script>
		// 4秒后关闭错误信息
		$('.mws-form-message').delay(3000).fadeOut(1200);

        $('.imgs').click(function(){
            // alert(11)
            // 获取input框的ytpe类型
            var type = $(this).prev().attr('type');
            // console.log(type);
            if(type == 'password'){
                $(this).prev().attr('type','text');
                $(this).attr('src','/img/open.png');
            } else {
                $(this).prev().attr('type','password');
                $(this).attr('src','/img/close.png');
            }
        })
	</script>
@stop