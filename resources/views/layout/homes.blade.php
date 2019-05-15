 <!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<!-- Head BEGIN -->
<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta content="Metronic Shop UI description" name="description">
  <meta content="Metronic Shop UI keywords" name="keywords">
  <meta content="keenthemes" name="author">

  <meta property="og:site_name" content="-CUSTOMER VALUE-">
  <meta property="og:title" content="-CUSTOMER VALUE-">
  <meta property="og:description" content="-CUSTOMER VALUE-">
  <meta property="og:type" content="website">
  <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
  <meta property="og:url" content="-CUSTOMER VALUE-">

  <link rel="shortcut icon" href="favicon.ico">

  <!-- Fonts START -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css"><!--- fonts for slider on the index page -->  
  <!-- Fonts END -->

  <!-- Global styles START -->          
  <link href="/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Global styles END --> 
   
  <!-- Page level plugin styles START -->
  <link href="/assets/pages/css/animate.css" rel="stylesheet">
  <link href="/assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
  <link href="/assets/plugins/owl.carousel/assets/owl.carousel.css" rel="stylesheet">
  <!-- Page level plugin styles END -->

  <!-- Theme styles START -->
  <link href="/assets/pages/css/components.css" rel="stylesheet">
  <link href="/assets/pages/css/slider.css" rel="stylesheet">
  <link href="/assets/pages/css/style-shop.css" rel="stylesheet" type="text/css">
  <link href="/assets/corporate/css/style.css" rel="stylesheet">
  <link href="/assets/corporate/css/style-responsive.css" rel="stylesheet">
  <link href="/assets/corporate/css/themes/red.css" rel="stylesheet" id="style-color">
  <link href="/assets/corporate/css/custom.css" rel="stylesheet">
  <!-- Theme styles END -->
</head>
<!-- Head END -->
<style type="text/css">
  .list-unstyled li a{
      color:#adafaf;
  }
  .list-unstyled li a:hover{
      color:red;
  }
</style>

<!-- Body BEGIN -->
<body class="ecommerce">

    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-6 col-sm-6 additional-shop-info">
                    <ul class="list-unstyled list-inline">
                        <li><i class="glyphicon glyphicon-plus"></i><span>&nbsp;设为首页</span></li>
                        <li><i class="glyphicon glyphicon-star-empty"></i><span>&nbsp;收藏本站</span></li>
                        <!-- END LANGS -->
                    </ul>
                </div>
                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <div class="col-md-6 col-sm-6 additional-nav">
                    @php
                      $user = DB::table('homeuser')->where('username',session('home'))->first();
                    @endphp
                    <ul class="list-unstyled list-inline pull-right" >
                        <li><a href="/home/oneself">个人中心</a></li>
                        <li><a href="/home/cart">我的购物车</a></li>
                        @if(session('home') == '')
                        
                        <li><a href="/home/login">登录</a></li>
                        <li><a href="/home/regist">注册</a></li>
                         @else
                         <img src="{{$user->profile}}" width="30px" class="img-responsive" style="display: inline;" >
                        <li>  
                          欢迎您！                       
                          <font style="color: red">{{$user->nickname?$user->nickname:$user->username}}</font>
            
                          <br>
                          <a href="/home/uplogin">退出</a>
                        </li>
                       
                        @endif
                    </ul>
                </div>
                <!-- END TOP BAR MENU -->
            </div>
        </div>        
    </div>
    <!-- END TOP BAR -->

    <!-- BEGIN HEADER -->
    <div class="header">
      <div class="container">
        <a class="site-logo" href="http://www.xdl.com/homes" style="margin-top:-25px;padding-top:32px;"><img src="/assets/corporate/img/logos/cart-img.png"  alt="Metronic Shop UI" class="img-responsive"></a>

        <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

        <!-- BEGIN CART -->
        <div class="top-cart-block">
          
          <a href="/home/cart"><i class="fa fa-shopping-cart"></i></a>
        </div>
        <!--END CART -->

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation">
          <ul>

            @php
                use App\Http\Controllers\Admin\CategoryController;

                $gs = CategoryController::getCateMessage(0);

            @endphp
            @foreach($gs as $k => $v)
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                {{$v->catename}} 
                
              </a>
                @if($v->sub)
              <!-- BEGIN DROPDOWN MENU -->
              <ul class="dropdown-menu">
                @foreach($v->sub as $kk => $vv)
                <li>
                  <a href="/home/list/{{$vv->id}}">{{$vv->catename}}<i class="fa fa-angle-right"></i></a>
                </li>
                @endforeach
              </ul>
              @endif
              <!-- END DROPDOWN MENU -->
            </li>
            @endforeach

            @php
                use App\Http\Controllers\Admin\NavController;

                $res = NavController::getNav();
                
            @endphp

            @foreach($res as $k => $v)
            <li class="dropdown dropdown100 nav-catalogue">
              <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;" >
                {{$v->nname}}                
              </a>
              
              @if($v->sub)
              <ul class="dropdown-menu">
                <li>
                  <div class="header-navigation-content">
                    <div class="row">
                      @foreach($v->sub as $kk => $vv)
                      <div class="col-md-3 col-sm-4 col-xs-6">
                        <div class="product-item">
                          <div class="pi-img-wrapper">
                            @if($vv->sub)
                            @foreach($vv->sub as $kkk => $vvv)
                            <a href="/home/detail/{{$vv->id}}"><img src="{{$vvv->gimg}}" class="img-responsive" alt="Berry Lace Dress" class="img-responsive"></a>
                            @endforeach
                            @endif
                          </div>
                          <h3><a href="/home/detail/{{$vv->id}}">{{$vv->gname}} </a></h3>
                          <div class="pi-price">¥{{$vv->price}}</div>
                          <a href="/home/cart/{{$v->id}}/edit" class="btn btn-default add2cart">添加购物车</a>
                        </div>
                      </div>
                      @endforeach

                    </div>
                  </div>
                </li>
                <span style="position:relative;left:95%;height:30px;"><a href="/home/nav/{{$v->id}}" style="font-size: 19px;font-family:'微软雅黑';">更多</a></span>
              </ul>
              @endif
            </li>    
            @endforeach

            <li><a href="/home/gywm">关于我们</a></li>

            <!-- BEGIN TOP SEARCH -->
            <li class="menu-search">
              <span class="sep"></span>
              <i class="fa fa-search search-btn"></i>
              <div class="search-box">
                <form action="#">
                  <div class="input-group">
                    <input type="text" placeholder="Search" class="form-control">
                    <span class="input-group-btn">
                      <button class="btn btn-primary" type="submit">Search</button>
                    </span>
                  </div>
                </form>
              </div> 
            </li>
            <!-- END TOP SEARCH -->
          </ul>
        </div>
        <!-- END NAVIGATION -->
      </div>
    </div>
    <!-- Header END -->
    @section('content')

    @show

    <!-- BEGIN BRANDS -->
    <div class="brands">
      <div class="container">
            @php
            $res = DB::table('abv')->where('status',1)->get();
          @endphp
        <div class="container">
            <div class="owl-carousel owl-carousel6-brands">

              @foreach($res as $k => $v)
              <a href="http://{{$v->link}}" target="_blank"><img src="{{$v->aimg}}" width="163px" height="98px" class="img-responsive" alt="{{$v->aname}}" ></a>
              @endforeach
              
            </div>
        </div>
    </div>
    <!-- END BRANDS -->

    <!-- BEGIN STEPS -->
     <div class="steps-block steps-block-red">
      <div class="container">
        <div class="row">
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-truck"></i>
            <div>
              <h2>免费送货</h2>
              <em>快递3天</em>
            </div>
            <span>&nbsp;</span>
          </div>
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-gift"></i>
            <div>
              <h2>每日礼物</h2>
              <em>每日为3个幸运客户提供礼品</em>
            </div>
            <span>&nbsp;</span>
          </div>
          <div class="col-md-4 steps-block-col">
            <i class="fa fa-phone"></i>
            <div>
              <h2>477 505 8877</h2>
              <em>24/7 提供全天候客户服务</em>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END STEPS -->

    <!-- BEGIN PRE-FOOTER -->
    <div class="pre-footer">
      <div class="container">
        <div class="row">
          <!-- BEGIN BOTTOM ABOUT BLOCK -->
         <div class="col-md-3 col-sm-6 pre-footer-col">
            @php
            $link = DB::table('link')->where('status',1)->get();
            @endphp
            <h2>友情链接</h2>
            <ul class="list-unstyled">
              @foreach($link as $k => $v)
              <li style="list-style: none"><i class="fa fa-angle-right"></i><a href="http://{{$v->link}}" >{{$v->linkname}}</a></li>
              @endforeach
            </ul>
          </div>
          <!-- END BOTTOM ABOUT BLOCK -->
          <!-- BEGIN BOTTOM INFO BLOCK -->
          <div class="col-md-3 col-sm-6 pre-footer-col">
            <h2>信息</h2>
            <ul class="list-unstyled">
              <li><i class="fa fa-angle-right"></i> <a href="javascript:;" >配送信息</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="javascript:;" >客户服务</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="javascript:;" >订单跟踪</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="javascript:;" >送货和退货</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="contacts.html" >联系我们</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="javascript:;" >招聘</a></li>
              <li><i class="fa fa-angle-right"></i> <a href="javascript:;" >支付方式</a></li>
            </ul>
          </div>
          <!-- END INFO BLOCK -->

          <!-- BEGIN TWITTER BLOCK --> 
          <div class="col-md-3 col-sm-6 pre-footer-col">
            <h2>最新推文</h2>
            <ul class="list-unstyled">
              <li><i class="fa fa-angle-right"></i><a href="javascript:;" >夏天到了，广大小姐姐肯定又在为穿衣郁闷着，因为去年的衣服不想穿，但是又不知道今年的流行风是什么样的，下面就...</a></li>
              <li><i class="fa fa-angle-right"></i><a href="javascript:;" >夏季穿衣搭配平时注意到这些问题一样能让你穿着舒服，穿着帅气，想要自己的该注意哪些问题就要跟随我们的脚步一起...</a></li>
            </ul>       
          </div>
          <!-- END TWITTER BLOCK -->

          <!-- BEGIN BOTTOM CONTACTS -->
          <div class="col-md-3 col-sm-6 pre-footer-col">
            <h2>联系我们</h2>
            <address class="margin-bottom-40">
              35, Lorem Lis Street, Park Ave<br>
              California, US<br>
              电话：300 323 3456<br>
              传真：300 323 1456<br>
              电子邮件: <a href="mailto:info@metronic.com">info@metronic.com</a><br>
              Skype: <a href="skype:metronic">metronic</a>
            </address>
          </div>
          <!-- END BOTTOM CONTACTS -->
        </div>
        <hr>
        <div class="row">
          <!-- BEGIN SOCIAL ICONS -->
          <!-- 百度分享 -->
          <div class="col-md-6 col-sm-6">
            
            <div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_isohu" data-cmd="isohu" title="分享到我的搜狐"></a><a href="#" class="bds_bdhome" data-cmd="bdhome" title="分享到百度新首页"></a></div>
            <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{},"image":{"viewList":["qzone","sqq","weixin","tsina","tqq","renren","isohu","bdhome"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","sqq","weixin","tsina","tqq","renren","isohu","bdhome"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>

          </div>
          <!-- END NEWLETTER -->
        </div>
      </div>
    </div>
    <!-- END PRE-FOOTER -->

   
    <script src="/assets/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="/assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>      
    <script src="/assets/corporate/scripts/back-to-top.js" type="text/javascript"></script>
    <script src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->

    <!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
    <script src="/assets/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
    <script src="/assets/plugins/owl.carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->
    <script src='/assets/plugins/zoom/jquery.zoom.min.js' type="text/javascript"></script><!-- product zoom -->
    <script src="/assets/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script><!-- Quantity -->

    <script src="/assets/corporate/scripts/layout.js" type="text/javascript"></script>
    <script src="/assets/pages/scripts/bs-carousel.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initOWL();
            Layout.initImageZoom();
            Layout.initTouchspin();
            // Layout.initTwitter();
        });
    </script>
    <!-- END PAGE LEVEL JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>