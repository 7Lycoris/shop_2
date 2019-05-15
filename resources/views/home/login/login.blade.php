@extends('layout.homes')
@section('title',$title)
@section('content')
<link href="css/base.css" rel="stylesheet" type="text/css">
<link href="css/css.css" rel="stylesheet" type="text/css">
<script src="js/jquery-2.1.1.min.js"></script>
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
.conlist {padding:5px; border:1px solid #ccc; width:300px;}
.conbox {
	display: none;
}
.loginbtn{
    width: 250px;
}
</style>
<script>
$(function(){
	$(".tab li").each(function(i){
		$(this).click(function(){
		$(this).addClass("on").siblings().removeClass("on");
		$(".conlist .conbox").eq(i).show().siblings().hide();
		})
	})
})
</script>



<div class="l_main">
    <div class="l_bttitle2"> 
        <!-- <h2>登录</h2>-->
        <h2><a href="/">< 返回首页</a></h2>
    </div>
    <div class="loginbox fl">
        <div class="tab">
        </div>
        <form action="/home/dologin" method="post">
            <div class="conlist">
                <div class="conbox" style="display:block;">
                    @if(session('error'))
                        <div class="mws-form-message warning">
                            {{session('error')}}
                        </div>
                     @endif
                    <p>
                        <input type="text" class="loginusername" placeholder="请输入:用户名|邮箱|手机号" name="username" required>
                    </p>
                    <p>
                        <input type="password" class="loginuserpassword" placeholder="请输入密码" name="password" required>
                    </p>
                    <p><span class="fl fntz14 margin-t10"><a href="/home/regist" style="color:#ff6000">立即注册</a></span><span class="fr fntz12 margin-t10"><a href="/home/repad">忘记密码？</a></span></p>
                    <p>
                        {{csrf_field()}}
                        <input type="submit" class="loginbtn" value="登  录">
                    </p>
                </div>
            </div>
        </form> 
    </div>
    
    <div class="fr margin-r100 margin-t45"><img src="images/login-pic.jpg" width="507" height="325"></div>
</div>
@stop