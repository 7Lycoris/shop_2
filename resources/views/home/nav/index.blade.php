@extends('layout.homes')

@section('title',$title)

@section('content')

 <!-- Header END -->

    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="http://www.xdl.com/homes">首页</a></li>
            <li class="active">{{t}}</li>
        </ul>

        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40" style="width:1200px;">
        
          <div class="col-md-12 col-sm-7">
            <div class="row list-view-sorting clearfix">
              <div class="col-md-2 col-sm-2 list-view">
                <a href="javascript:;"><i class="fa fa-th-large"></i></a>
                <a href="javascript:;"><i class="fa fa-th-list"></i></a>
              </div>
              <div class="col-md-10 col-sm-10">
                
              </div>
            </div>
            <!-- BEGIN PRODUCT LIST -->
            <div class="row product-list">

              @foreach ($rs as $k => $v)
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    @if($v->sub)
                    @foreach($v->sub as $kk => $vv)
                    <img src="{{$vv->gimg}}" alt="Berry Lace Dress" class="img-responsive">
                    <div>
                      <a href="{{$vv->gimg}}" class="btn btn-default fancybox-button">大图</a>
                      <a href="/home/detail/{{$v->id}}" class="btn btn-default fancybox-button">详情</a>
                    </div>
                    @endforeach
                    @endif
                  </div>
                  <h3><a href="/home/detail/{{$v->id}}" style="text-overflow:ellipsis;height:60px;display:block;overflow:hidden;">{{$v->gname}}</a></h3>
                  <div class="pi-price">{{$v->price}}</div>
                  <a href="/home/cart/{{$v->id}}/edit" class="btn btn-default add2cart">加入购物车</a>
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
@stop
