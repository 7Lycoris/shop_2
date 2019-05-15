@extends('home.oneself.oneself')

@section('title',$title)
 @section('oneself')

<form action="/home/oneself/dopassword" method="post" enctype='multipart/form-data'>
	@if (count($errors) > 0)
    		<div class="mws-form-message error"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li style="color: red">{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
        @if(session('error'))
            <div class="mws-form-message warning">
                {{session('error')}}
            </div>
        @endif
	<div class="form-group">
        <label for="exampleInputEmail1">
            原密码
        </label>
        <input type="password" class="form-control" id="exampleInputEmail1" placeholder="6-18位数字字母特殊字符组合" name="password" >
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">
            新密码
        </label>
        <input type="password" class="form-control" id="exampleInputEmail1" placeholder="6-18位数字字母特殊字符组合" name="newpassword" >
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">
            确认密码
        </label>
        <input type="password" class="form-control" id="exampleInputEmail1" placeholder="6-18位数字字母特殊字符组合" name="repassword" >
    </div>
    {{csrf_field()}}
    <button type="submit" class="btn btn-info">
        确认修改
    </button>
</form>
 <script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script>
	$('.mws-form-message').delay(3000).fadeOut(1200);
</script>
@stop