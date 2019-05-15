@extends('home.oneself.oneself')

@section('oneself')

<form action="/home/myadd" method="post" enctype='multipart/form-data'>
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
            
        </label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="请输入新地址" name="address" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">
            
        </label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="请输入联系人" name="name" required>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">
            
        </label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="请输入联系人电话" name="phone" required>
    </div>
    {{csrf_field()}}
    <button type="submit" class="btn btn-info">
        添加
    </button>
</form>
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script>
    $('.mws-form-message').delay(3000).fadeOut(1200);
</script>
@stop