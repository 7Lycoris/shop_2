@extends('layout.homes')

@section('title',$title)

@section('content')

<!-- 主体 -->
    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="\">首页</a></li>
            <li>{{$ftype->catename}}</li>

            <li><a href="/home/list/{{$ctype->id}}">{{$ctype->catename}}</a></li>
            <!-- 商品名 -->
            <li class="active" title="{{$res->gname}}" style="width:120px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;position:relative;top:4px;">{{$res->gname}}</li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
         <!-- 左侧分类栏 -->
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
            <!-- 分类结束 -->
            <!-- 热销开始 -->

            <div class="sidebar-products clearfix">
              <h2>人气商品</h2>
              @foreach($bsl as $vs)
              <div class="item">
                <a href="/home/detail/{{$vs->id}}"><img src="{{$vs->gimg}}" alt="Some Shoes in Animal with Cut Out"></a>
                <h3><a href="/home/detail/{{$vs->id}}">{{$vs->gname}}</a></h3>
                <div class="price">¥{{$vs->price}}</div>
                <div class="price"><a href="/home/cart/{{$vs->id}}/edit" class="btn btn-default add2cart">加入购物车</a></div>
              </div>
              @endforeach
            </div>
          </div>
          <!-- 热销结束 -->
         <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->

          <div class="col-md-9 col-sm-7">
            <div class="product-page">
              <div class="row">
              <!-- 详情开始 -->
                <div class="col-md-6 col-sm-6">
                  <?php $first = array_shift($mimg); ?>
                  <div class="product-main-image">
                    <img src="{{$first->gimg}}" alt="Cool green dress with red bell" class="img-responsive" data-BigImgsrc="assets/pages/img/products/model7.jpg">
                  </div>
                  <div class="product-other-images">
                  
                  @while ($info = array_shift($mimg))
                                               
                       <a href="{{$info->gimg}}" class="fancybox-button" rel="photos-lib"><img alt="Berry Lace Dress" src="{{$info->gimg}}"></a>             
                  @endwhile
                  </div>
                </div>
                <div class="col-md-6 col-sm-6">
                <!-- 提交表单 -->
                <form id="form1" action="/home/cart/{{$res->id}}" method="post">
                  <h1>{{$res['gname']}}</h1>
                  <input type="hidden" name="gid" value="{{$res->id}}">
                  <div class="price-availability-block clearfix">
                    <div class="price">
                      <strong><span></span>¥{{$res['price']}}</strong>
                     <input type="hidden" name="price" readonly value="{{$res['price']}}">
                    </div>
                    <div class="availability">
                     商品状态: <strong>{{$res['status']?'有货':'无货'}}</strong>
                     <!-- <p>商品库存<strong>:20</strong></p> -->
                    </div>
                  </div>
                  <div class="description">
                    <p>{{$res->details}}</p>
                  </div>
                  <div class="product-page-options">
                        <!-- 商品的尺寸 -->
                    <div class="pull-left">
                      <label class="control-label">尺寸:</label>
                      <select name="size" class="form-control input-sm" >
                        <option value="l">L</option>
                        <option value="m">M</option>
                        <option value="xl">XL</option>
                      </select>
                    </div>

                    <div class="pull-left">
                      <label class="control-label">颜色:</label>
                      <select name="color" class="form-control input-sm">
                        <option value="red">Red</option>
                        <option value="blue">Blue</option>
                        <option value="black">Black</option>
                      </select>
                    </div>

                  </div>
                  <div class="product-page-cart">
                  <!-- <button class="btn btn-default" onclick="btnOperate('+')" type="button" name="add">+</button> -->
                    <div class="product-quantity">

                        <input name="num" id="num" type="text" value="1" min="0" max="99" class="form-control input-sm" readonly>

                    </div>
                        <!-- <button class="btn btn-default" onclick="btnOperate('-')" type="button" name="minus" >-</button> -->
                    <button class="btn btn-primary" type="submit" onclick="func()">添加到购物车</button>
                  </div>

                  <ul class="social-icons">
                    <li><a class="facebook" data-original-title="facebook" href="javascript:;"></a></li>
                    <li><a class="twitter" data-original-title="twitter" href="javascript:;"></a></li>
                    <li><a class="googleplus" data-original-title="googleplus" href="javascript:;"></a></li>
                    <li><a class="evernote" data-original-title="evernote" href="javascript:;"></a></li>
                    <li><a class="tumblr" data-original-title="tumblr" href="javascript:;"></a></li>
                  </ul>

                </div>
                {{csrf_field()}}
                {{method_field('PUT')}}
                </form>
                
                <!-- 提交表单结束 -->
                <div class="product-page-content">
                  <ul id="myTab" class="nav nav-tabs">
                    <li class="active" ><a href="#Description" data-toggle="tab">商品描述</a></li>
                    <!-- <li><a href="#Information" data-toggle="tab">详细信息</a></li> -->
                    <!-- <li class="active"><a href="#Reviews" data-toggle="tab">买家评论 (2)</a></li> -->
                  </ul>
                  <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade in active " id="Description">
                      {!!$res->content!!}
                    </div>

                    </div>
                  </div>
                </div>

                <div class="sticker sticker-sale"></div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- 详情结束 -->
        <!-- END SIDEBAR & CONTENT -->

        <!-- BEGIN SIMILAR PRODUCTS -->
        <div class="row margin-bottom-40">
          <div class="col-md-12 col-sm-12">
            <h2>猜你想看</h2>
            <div class="owl-carousel owl-carousel4">
               @foreach($same as $sv)
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{$sv->gimg->gimg}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{$sv->gimg->gimg}}" class="btn btn-default fancybox-button">放大</a>
                      <a href="/home/detail/{{$sv->id}}" class="btn btn-default fancybox-fast-view">详情</a>
                    </div>
                  </div>
                  <h3><a href="{{$sv->id}}">{{$sv->gname}}</a></h3>
                  <div class="pi-price">¥{{$sv->price}}</div>
                  <a href="/home/cart/{{$sv->id}}/edit" class="btn btn-default add2cart">加入购物车</a>
                  <div class="sticker sticker-new"></div>
                </div>
              </div>
               @endforeach
            </div>
          </div>
        </div>

        <!-- END SIMILAR PRODUCTS -->
      </div>
    </div>
<!-- 主体结束     -->

	<!-- 热门产品发大图BEGIN fast view of a product -->

      <div id="product-pop-up" style="display: none; width: 700px;">
              <div class="product-page product-pop-up">
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-3">
                    <div class="product-main-image">
                      <img src="assets/pages/img/products/model7.jpg" alt="Cool green dress with red bell" class="img-responsive">
                    </div>
                    <div class="product-other-images">
                      <a href="javascript:;" class="active"><img alt="Berry Lace Dress" src="assets/pages/img/products/model3.jpg"></a>
                      <a href="javascript:;"><img alt="Berry Lace Dress" src="assets/pages/img/products/model4.jpg"></a>
                      <a href="javascript:;"><img alt="Berry Lace Dress" src="assets/pages/img/products/model5.jpg"></a>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-9">
                    <h2> 名字</h2>
                    <div class="price-availability-block clearfix">
                      <div class="price">
                        <strong><span>¥</span>价格</strong>
                        <em>$<span>62.00</span></em>
                      </div>
                      <div class="availability">
                        Availability: <strong>In Stock</strong>
                      </div>
                    </div>
                    <div class="description">
                      <p>Lorem ipsum dolor ut sit ame dolore  adipiscing elit, sed nonumy nibh sed euismod laoreet dolore magna aliquarm erat volutpat Nostrud duis molestie at dolore.</p>
                    </div>
                    <div class="product-page-options">
                      <div class="pull-left">
                        <label class="control-label">Size:</label>
                        <select class="form-control input-sm">
                          <option>L</option>
                          <option>M</option>
                          <option>XL</option>
                        </select>
                      </div>
                      <div class="pull-left">
                        <label class="control-label">Color:</label>
                        <select class="form-control input-sm">
                          <option>Red</option>
                          <option>Blue</option>
                          <option>Black</option>
                        </select>
                      </div>
                    </div>
                    <div class="product-page-cart">
                      <div class="product-quantity">
                          <input id="product-quantity2" type="text" value="1" readonly class="form-control input-sm">
                      </div>
                      <button class="btn btn-primary" type="submit">+购物车</button>
                      <a href="shop-item.html" class="btn btn-default">More details</a>
                    </div>
                  </div>

                  <div class="sticker sticker-sale"></div>
                </div>
              </div>
      </div>
      <!-- 热门产品结束BEGIN fast view of a product -->
    <!-- END fast view of a product -->
<!-- <script>
   function btnOperate(op){
            console.log($("#num").val())
            var value = Number($("#num").val());
            console.log(value)
            if(op == '+'){
                value += 1;
            }else if(op == '-'){
                if(value <= 1){
                    value = 1;
                }else{
                    value -= 1;
                }
            }
            $("#num").val(value);
        }
        function func(){
          $('#form1').submit();
        }

</script> -->
@stop
