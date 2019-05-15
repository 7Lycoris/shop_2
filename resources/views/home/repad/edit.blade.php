@extends('layout.homes')
@section('title',$title)
@section('content')
<link href="/home/css/base.css" rel="stylesheet" type="text/css">
<link href="/home/css/css.css" rel="stylesheet" type="text/css">
<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
<script src="/home/js/jquery-2.1.1.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
.tab {
    overflow: hidden;
    margin-top: 20px; margin-bottom:-1px;
}
.tab li {
    display: block;
    float: left;
    width: 100px;padding:10px 20px; cursor:pointer; border:1px solid #ccc; 
}
.tab li.on {
    background: #90B831; color:#FFF;padding:10px 20px;
}
.conlist {padding:10px; border:1px solid #ccc; width:350px;}
.conbox {
  width: 320px;
    display: none;
  padding: 0px;
  padding-top: 10px;
}
.l_main2{
  height: 450px;
}

</style>
</head>

<div class="l_main2">
    <div class="l_bttitle"> 
        <h2>修改密码</h2>
    </div>
    <div class="loginbox">

        <form action="/home/update" method="post"  >
          <div class="conlist" id="conlist">
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
              <div class="conbox"  id="phone" style="display: block;">
                  <p>
                      </p><div class="fl res-text">新密码:</div><div><input type="password" class="loginuser" name="password" required></div>
                  <p></p>
                  <p>
                      </p><div class="fl res-text">确认密码:</div><div><input type="password" class="loginuser" name="repassword" required></div>
                  <p></p>
                  <p>
                    {{csrf_field()}}
                      <input type="hidden" name="phone" value="{{$phone}}">
                      <input type="submit" class="loginbtn" value="提交">
                    
                  </p>
              </div>
          </div>
          </form>
        </div>
    </div>
<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
<script>
   $('.mws-form-message').delay(3000).fadeOut(1200);
  // 判断邮箱还是手机注册

  // 判断两次输入的密码是否一致
  $('.loginbtn').click(function(){
    var pas = $('input[name=password]').val();
    var repas = $('input[name=repassword]').val();
    console.log(pas);
    console.log(repas);
    if (pas != repas) {
      alert('两次输入的密码不一致,请重新输入');
      window.location.reload();
      return false;
    }
  })

</script>
@stop
