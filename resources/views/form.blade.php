<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<!-- 这里面的地址就是路由的规则 -->
	<a href="/home/user/register">跳转到路由的别名</a>

	<br>
	<!-- 这是路由的别名 -->
	<!-- {{}}  blade模板引擎的语法 解析变量和函数-->
	<a href="{{route('ur')}}">跳转到路由的别名</a>
	
</body>
</html>