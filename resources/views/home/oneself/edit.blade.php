@extends('home.oneself.oneself')

@section('oneself')

<form action="/home/oneself/update" method="post" enctype='multipart/form-data'>
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
            昵称
        </label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="nickname" name="nickname" value="{{$res->nickname}}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">
            邮箱
        </label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email" name="email" value="{{$res->email}}">
    </div>
     <div class="form-group">
        <label for="exampleInputEmail1">
            手机
        </label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="phone" name="phone" value="{{$res->phone}}">
    </div>
     <div class="form-group">
        <label for="exampleInputEmail1">
            地址
        </label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="address" name="address" value="{{$res->address}}">
    </div>

    <div class="form-group">
        <label for="exampleInputFile">
            头像
        </label>
        <img src="{{$res->profile}}">
        <input type="file" id="exampleInputFile" name="profile">

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