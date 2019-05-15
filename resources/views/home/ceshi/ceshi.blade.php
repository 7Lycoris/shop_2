@extends('layout.homes')

@section('title',$title)

@section('content')

<!-- 主体 -->
   
<!-- 主体结束     -->

	<!-- 热门产品BEGIN fast view of a product -->
     <div class="row margin-bottom-40">
          <div class="col-md-12 col-sm-12">
            <h2>热门产品</h2>
            <div class="owl-carousel owl-carousel4">
@for()
              <div>
                <div class="product-item">
                  <div class="pi-img-wrapper">
                    <img src="{{$go->gimgs->gimg}}" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                      <a href="{{$go->gimgs->gimg}}" class="btn btn-default fancybox-button">放大</a>
                      <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                  </div>
                  <h3><a href="shop-item.html">{{$go->gname}}</a></h3>
                  <div class="pi-price">$29.00</div>
                  <a href="javascript:;" class="btn btn-default add2cart">+购物车</a>
                  <div class="sticker sticker-new"></div>
                </div>
              </div>
@endfor
             
              
            </div>
          </div>
        </div>
    <!-- END fast view of a product -->
<script>
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
</script>
@stop
