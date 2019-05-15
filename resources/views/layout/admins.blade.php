<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Viewport Metatag -->
<meta name="viewport" content="width=device-width,initial-scale=1.0">

<!-- Plugin Stylesheets first to ease overrides -->
<link rel="stylesheet" type="text/css" href="/admin/plugins/colorpicker/colorpicker.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/custom-plugins/wizard/wizard.css" media="screen">

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/admin/bootstrap/css/bootstrap.min.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/fonts/ptsans/stylesheet.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/fonts/icomoon/style.css" media="screen">

<link rel="stylesheet" type="text/css" href="/admin/css/mws-style.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/icons/icol16.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/icons/icol32.css" media="screen">

<!-- Demo Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admin/css/demo.css" media="screen">

<!-- jQuery-UI Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admin/jui/css/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/jui/jquery-ui.custom.css" media="screen">

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/admin/css/mws-theme.css" media="screen">
<link rel="stylesheet" type="text/css" href="/admin/css/themer.css" media="screen">

<title>@yield('title')</title>

</head>

<body>

    <!-- Header -->
    <div id="mws-header" class="clearfix">   
        <!-- Logo Container -->
        <div id="mws-logo-container">      
            <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
            <div id="mws-logo-wrap">
               <a href="/admins" > <img src="/admin/images/mws-logo.png" alt="mws admin"></a>
            </div>            
        </div>
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix"> 

            <div id="mws-user-message" class="mws-dropdown-menu">
                <a href="/"  class="mws-dropdown-trigger">去前台首页</a>
            </div>


            @php
            $res = DB::table('user')->where('username',session('uname'))->first();
            @endphp
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
                
                <!-- User Photo -->
                <div id="mws-user-photo">
                    <img src="{{$res->profile}}" alt="User Photo" width="30px">
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                       Hello, {{$res->username}}
                    </div>
                    <ul>
                        <li><a href="/admin/profile/{{$res->id}}">修改头像</a></li>
                        <li><a href="/admin/changepass/{{$res->id}}">修改密码</a></li>
                        <li><a href="/admin/logout">退出登录</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
        <!-- Necessary markup, do not remove -->
        <div id="mws-sidebar-stitch"></div>
        <div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <!-- Searchbox -->
            
            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul >
                    <li>
                        <a href="#"><i class="icon-users"></i> 用户管理</a>
                        <ul class="closed">
                            <li><a href="/admin/user">用户列表</a></li>
                            <li><a href="/admin/user/create">添加用户</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-official"></i>角色管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/role">浏览角色</a></li>
                            <li><a href="/admin/role/create">添加角色</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="icon-lock"></i>权限管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/permission">浏览权限</a></li>
                            <li><a href="/admin/permission/create">添加权限</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-list"></i>分类管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/category">浏览分类</a></li>
                            <li><a href="/admin/category/create">添加分类</a></li>
                        </ul>
                    </li>
                     <li>
                        <a href="#"><i class="icon-shopping-cart"></i>商品管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/goods">浏览商品</a></li>
                            <li><a href="/admin/goods/create">添加商品</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-truck"></i>订单管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/orders">浏览订单</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-fire"></i>推荐管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/nav">浏览推荐</a></li>
                            <li><a href="/admin/nav/create">添加推荐</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-shopping-cart"></i>广告管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/abv">浏览广告</a></li>
                            <li><a href="/admin/abv/create">添加广告</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="icon-link"></i>友情链接管理</a>
                        <ul class='closed'>
                            <li><a href="/admin/link">浏览友情链接</a></li>
                            <li><a href="/admin/link/create">添加友情链接</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/admin/comment"><i class="icon-bullhorn"></i>查看用户评论</a>
                    </li>
                    
                </ul>

            </div>         
        </div>
        
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
            <!-- Inner Container Start -->
            <div class="container">
            	@section('content')
            	@show
            </div>
            <!-- Inner Container End -->
                       
            <!-- Footer -->
            <div id="mws-footer">
                Copyright Your Website 2012. All Rights Reserved.
            </div>
            
        </div>
        <!-- Main Container End -->
        
    </div>

    <!-- JavaScript Plugins -->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <!-- <script src="/admin/js/libs/jquery-1.8.3.min.js"></script> -->
    <script src="/admin/js/libs/jquery.mousewheel.min.js"></script>
    <script src="/admin/js/libs/jquery.placeholder.min.js"></script>
    <script src="/admin/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
mws-panel-header    <script src="/admin/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="/admin/jui/jquery-ui.custom.min.js"></script>
    <script src="/admin/jui/js/jquery.ui.touch-punch.js"></script>

    <!-- Plugin Scripts -->
    <script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <!--[if lt IE 9]>
    <script src="/admin/js/libs/excanvas.min.js"></script>
    <![endif]-->
    <script src="/admin/plugins/flot/jquery.flot.min.js"></script>
    <script src="/admin/plugins/flot/plugins/jquery.flot.tooltip.min.js"></script>
    <script src="/admin/plugins/flot/plugins/jquery.flot.pie.min.js"></script>
    <script src="/admin/plugins/flot/plugins/jquery.flot.stack.min.js"></script>
    <script src="/admin/plugins/flot/plugins/jquery.flot.resize.min.js"></script>
    <script src="/admin/plugins/colorpicker/colorpicker-min.js"></script>
    <script src="/admin/plugins/validate/jquery.validate-min.js"></script>
    <script src="/admin/custom-plugins/wizard/wizard.min.js"></script>

    <!-- Core Script -->
    <script src="/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="/admin/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="/admin/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="/admin/js/demo/demo.dashboard.js"></script>
    @section('js')
    @show
</body>
</html>