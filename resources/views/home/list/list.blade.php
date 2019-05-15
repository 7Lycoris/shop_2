@extends('layout.homes')

@section('title',$title)

@section('content')

 <!-- Header END -->

<div class="title-wrapper">
      <div class="container"><div class="container-inner">
        <h1><span>MEN</span> CATEGORY</h1>
        <em>Over 4000 Items are available here</em>
      </div></div>
    </div>

    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="\">首页</a></li>
            <li>{{$tt1->catename}}</li>
            <li class="active">{{$tt->catename}}</li>
        </ul>

        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <!-- 左边的分类导航 -->

          <!-- home/list/6 -->
          <?php
            function dg($list, $html= ''){
                foreach ($list as $key => $value) {
                    $html .=  '<li class="list-group-item clearfix dropdown ">
                <a href="javascript:void(0);" class="collapsed">
                  <i class="fa fa-angle-right"></i>
                     '.$value->catename.'
                  </a>';
                        // dd($value);
                  if (!empty($value->typelevel)) {
                      
                      $html .= '<ul class="dropdown-menu" style="display:none;>';
                      $html .= dg($value->typelevel);
                        
                      $html .=  '</ul>';
                  }
                
                $html .= '</li>';
                }
                return $html;
            }

          ?>

        <div class="sidebar col-md-3 col-sm-5">
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
          
           <!-- 商品分类结束 -->

            <!-- <div class="sidebar-filter margin-bottom-25">
              <h2>Filter</h2>
              <h3>Availability</h3>
              <div class="checkbox-list">
                <label><input type="checkbox"> Not Available (3)</label>
                <label><input type="checkbox"> In Stock (26)</label>
              </div>

              <h3>Price</h3>
              <p>
                <label for="amount">Range:</label>
                <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;">
              </p>
              <div id="slider-range"></div>
            </div> -->

            <div class="sidebar-products clearfix">
              <h2>人气商品</h2>

              @foreach($bsl as $vs)
              <div class="item">
                <a href="/home/detail/{{$vs->id}}"><img src="{{$vs->gimg}}" alt="{{$vs->gname}}"></a>
                <h3><a href="/home/detail/{{$vs->id}}">{{$vs->gname}}</a></h3>
                <div class="price">¥{{$vs->price}}</div>
               <div class="price"><a href="/home/crat/{{$vs->id}}/edit" class="btn btn-default add2cart">加入购物车</a></div>
              </div>
              @endforeach

            </div>

          </div>

         
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <div class="row list-view-sorting clearfix">
              <div class="col-md-2 col-sm-2 list-view">
                <a href="javascript:;"><i class="fa fa-th-large"></i></a>
                <a href="javascript:;"><i class="fa fa-th-list"></i></a>
              </div>
              <div class="col-md-10 col-sm-10">
               
              </div>
            </div>
            <!-- 列表开始BEGIN PRODUCT LIST -->
            <div class="row product-list">

              <!-- PRODUCT ITEM START -->
              @foreach ($info->items() as $k)
              <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{$list[$k->id]}}" alt="Berry Lace Dress" class="img-responsive">
                    <div>
                      <a href="{{$list[$k->id]}}" class="btn btn-default fancybox-button">大图</a>
                      <a href="/home/detail/{{$k->id}}" class="btn btn-default fancybox-fast-view">详情</a>
                    </div>
                  </div>
                  <h3><a href="/home/detail/{{$k->id}}" style="text-overflow:ellipsis;height:60px;display:block;overflow:hidden;">{{$k->gname}}</a></h3>
                  <div class="pi-price">¥{{$k->price}}</div>
                  <a href="/home/cart/{{$k->id}}/edit" class="btn btn-default add2cart">加入购物车</a>
                </div>
              </div>                                                    
              @endforeach
            </div>
            
            <!-- END PRODUCT LIST -->

            <!-- BEGIN PAGINATOR -->
            <style>
                .pagination {
                    float: right!important;
                }
                .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
                    background-color: #555;
                }
            </style>
            <div class="row">
              <div class="col-md-4 col-sm-4 items-info">Items 1 to 9 of 10 total</div>
              <div class="col-md-8 col-sm-8">

                {{$info -> links()}}
              </div>
            </div>
            <!-- END PAGINATOR -->
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>
    </div>
<!-- BEGIN BRANDS -->
  <script>
      function getChild(that, pid){
          $.get('/list/'+pid, {}, function(result){
                console.log(result);
          })
      }

  </script>


@stop
