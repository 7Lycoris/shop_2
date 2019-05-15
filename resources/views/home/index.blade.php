@extends('layout.homes')

@section('title',$title)

@section('content')
	   <div class="tlinks">Collect from <a href="http://www.cssmoban.com/">网站建设</a></div>

    <!-- BEGIN SLIDER -->
    <div class="page-slider margin-bottom-35">
        <div id="carousel-example-generic" class="carousel slide carousel-slider">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                <li data-target="#carousel-example-generic" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                @foreach($dp as $k => $v)
                <div class="item carousel-item-four {{
                  $k == 0 ? 'active':''
               }}">
                    <div class="container">
                      @if($v->sub)
                      @foreach($v->sub as $kk => $vv)
                        <a href="/home/detail/{{$v->id}}"><img src="{{$vv->gimg}}" width="1140px" height="580px"></a>
                      @endforeach
                      @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Controls -->
            <a class="left carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="fa fa-angle-left" aria-hidden="true" style="background: rgba(173, 73, 73, 0.32);"></i>
            </a>
            <a class="right carousel-control carousel-control-shop" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-angle-right" aria-hidden="true" style="background: rgba(173, 73, 73, 0.32);"></i>
            </a>
        </div>
    </div>
    <!-- END SLIDER -->

    <div class="main">
      <div class="container">
        <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SALE PRODUCT -->
          <div class="col-md-12 sale-product">
            <h2>最新上线</h2>
            <div class="owl-carousel owl-carousel5">
              @foreach($news as $k => $v)
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    @if($v->sub)
                    @foreach($v->sub as $kk => $vv)
                    <img src="{{$vv->gimg}}" class="img-responsive" alt="Berry Lace Dress">
                    @endforeach
                    @endif
                    <div>
                      <a href="{{$vv->gimg}}" class="btn btn-default fancybox-button">大图</a>
                      <a href="/home/detail/{{$v->id}}" class="btn btn-default fancybox-fast-view">详情</a>
                    </div>
                  </div>
                  <h3><a href="/home/detail/{{$v->id}}" style="text-overflow:ellipsis;height:60px;display:block;overflow:hidden;">{{$v->gname}}</a></h3>
                  <div class="pi-price">¥{{$v->price}}</div>
                  <a href="/home/cart/{{$v->id}}/edit" class="btn btn-default add2cart">加入购物车</a>
                  <div class="sticker sticker-sale"></div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <!-- END SALE PRODUCT --> 
        </div>
        <!-- END SALE PRODUCT & NEW ARRIVALS -->

        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40 ">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-4">
            <ul class="list-group margin-bottom-25 sidebar-menu">
              @php
                  use App\Http\Controllers\Admin\CategoryController;

                  $cates = CategoryController::getCates(0);

              @endphp
              @foreach($cates as $k => $v)
              <li class="list-group-item clearfix dropdown"><a href="javascript:void(0);" class="collapsed"><i class="fa fa-angle-right"></i> {{$v->catename}} &nbsp;&nbsp;</a>
                @if($v->sub)
                <ul class="dropdown-menu">
                  @foreach($v->sub as $kk => $vv)
                  <li class="list-group-item dropdown clearfix">
                    <a href="/home/list/{{$vv->id}}"><i class="fa fa-angle-right"></i> {{$vv->catename}} </a>
                  </li>
                  @endforeach
                </ul>
                @endif
              </li>
              @endforeach
            </ul>
          </div>
          <!-- END SIDEBAR -->
          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-8">
            <h2>时尚女装</h2>
            <div class="owl-carousel owl-carousel3">
              @foreach($nzs as $k => $v)
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    @if($v->sub)
                    @foreach($v->sub as $kk => $vv)
                    <img src="{{$vv->gimg}}" class="img-responsive" alt="Berry Lace Dress">
                    @endforeach
                    @endif
                    <div>
                      <a href="{{$vv->gimg}}" class="btn btn-default fancybox-button">大图</a>
                      <a href="/home/detail/{{$v->id}}" class="btn btn-default fancybox-fast-view">详情</a>
                    </div>
                  </div>
                  <h3><a href="/home/detail/{{$v->id}}" style="text-overflow:ellipsis;height:60px;display:block;overflow:hidden;">{{$v->gname}}</a></h3>
                  <div class="pi-price">¥{{$v->price}}</div>
                  <a href="/home/cart/{{$v->id}}/edit" class="btn btn-default add2cart">添加购物车</a>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN TWO PRODUCTS & PROMO -->
        <div class="row margin-bottom-35">
          <!-- BEGIN TWO PRODUCTS -->
          <div class="col-md-9 col-sm-8">
            <h2>潮流男装</h2>
            <div class="owl-carousel owl-carousel3">
              @foreach($nrs as $k => $v)
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    @if($v->sub)
                    @foreach($v->sub as $kk => $vv)
                    <img src="{{$vv->gimg}}" class="img-responsive" alt="Berry Lace Dress">
                    @endforeach
                    @endif
                    <div>
                      <a href="{{$vv->gimg}}" class="btn btn-default fancybox-button">大图</a>
                      <a href="/home/detail/{{$v->id}}" class="btn btn-default fancybox-fast-view">详情</a>
                    </div>
                  </div>
                  <h3><a href="/home/detail/{{$v->id}}" style="text-overflow:ellipsis;height:60px;display:block;overflow:hidden;">{{$v->gname}}</a></h3>
                  <div class="pi-price">¥{{$v->price}}</div>
                  <a href="/home/cart/{{$v->id}}/edit" class="btn btn-default add2cart">添加购物车</a>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <!-- END TWO PRODUCTS -->
          <!-- BEGIN PROMO -->
          <div class="col-md-3 shop-index-carousel">
            <div class="content-slider">
              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  @foreach($xp as $k => $v)
                  <div class="item {{
                  $k == 0 ? 'active':''
               }}">
                    @if($v->sub)
                    @foreach($v->sub as $kk => $vv)
                    <a href="/home/detail/{{$v->id}}"><img src="{{$vv->gimg}}" class="img-responsive" alt="Berry Lace Dress" width="270px"></a>
                    @endforeach
                    @endif
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <!-- END PROMO -->
        </div>        
        <!-- END TWO PRODUCTS & PROMO -->
      </div>
    </div>
@stop
