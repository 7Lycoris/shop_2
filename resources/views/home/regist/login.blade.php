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
        <h2>注册</h2>
    </div>
    <div class="loginbox">
        <div class="tab">
            <ul>
                <li class="cellphone">手机注册</li>
                <li class="email">邮箱注册</li>
            </ul>
        </div>

        <form action="/home/docellphone" method="post"  id='forms'>
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
                      </p><div class="fl res-text">手机号:</div><div><input type="text" class="loginuser" name="phone" required></div>
                  <p></p>
                  <p>
                     </p><div class="fl res-text" >密码：</div><div><input type="password" class="loginuser" name="password" required></div>
                  <p></p>
                  <p>
                     </p><div class="fl res-text">验证码：</div>
                     <div class="fl"><input type="text" name="code" class="loginuser2" placeholder="请输入验证码" required><span></span></div>
                     <button class="fl same-code" id="but" >获取验证码</button>
                     <!--<div class="fl same-code2">60秒后重新获取</div>-->
                  <p></p>
                  <p>
                    {{csrf_field()}}
                      <input type="submit" class="loginbtn" value="注 册">
                    
                  </p>
              </div>
          </div>
          </form>
          <form action="/home/doregist" method="post"  >
          <div class="conlist" id="emailconlist" style="display: none">
            <div class="conbox"  id="email" style="display: none;">
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
                <p>
                    </p><div class="fl res-text">用户名：</div><div><input type="text" class="loginuser" name="username" required></div>
                <p></p>
                <p>
                   </p><div class="fl res-text">邮箱名:</div><div><input type="email" class="loginuser"  name="email" required></div>
                <p></p>
                <p>
                   </p><div class="fl res-text">密码：</div><div><input type="password" class="loginuser" required name="password"></div>
                <p></p>
                <p>
                  {{csrf_field()}}
                    <input type="submit" class="loginbtn" value="注 册">
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
  var CV = false;
  $('.cellphone').click(function(){
    // alert(1)
    $('#phone').css('display','block');
    // console.log(ph);
    $('#email').css('display','none');
     $('#conlist').css('display','block');
     $('#emailconlist').css('display','none');
     CV = false;
     console.log(CV)

  })

  $('.email').click(function(){
    $('#phone').css('display','none');
    $('#conlist').css('display','none');
    $('#email').css('display','block');
    $('#emailconlist').css('display','block');
    CV = true;
    // console.log(CV)

  })



  
  // alert($);
  $('input[name=phone]').focus(function(){
    $(this).css('border','solid 1px blue');
  })  
  // 获取验证码
$('#but').click(function(){
    //获取手机号
    var tis = $(this)
    $(this).attr('disabled',true)
    // 定时器
    var time;
    var num = 5;
    time = setInterval(function(){
      tis.text(num+'秒后点击');
      num --
      if (num == 0) {
        clearInterval(time);
        num = 5;
        tis.text('获取验证码');
        tis.attr('disabled',false);
      }
    },1000)
    var phv = $('input[name=phone]').val().trim();
    $.get('/home/yzm',{yzmtel:phv},function(data){

      console.log(data);
    })
  })
  
  // 验证验证码
  $('input[name=code]').blur(function(){
    // 获取输入的值
    // alert(11);
    var cv = $(this).val().trim();

    var that = $(this);
    var val = $(this).attr('placeholder');
    // console.log(val);

    $.get('/home/doyzm',{cv:cv},function(data){
      if(data == '1'){
        
        that.css('border','green solid 1px');
        CV = true;
      }else{
        that.attr('placeholder','验证码不正确');
        that.css('border','red solid 1px');
       CV = false;
      }
    })
  })


// 点击提交
  $('#forms').submit(function(){
    console.log(CV);
    if(CV){

      return true;
    } 
    return false;
  })
</script>
@stop
