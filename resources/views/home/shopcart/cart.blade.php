@extends('layout.homes')

@section('title',$title)

@section('content')

    <div class="main">
      <div class="container">
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1>购物车</h1>
            <div class="goods-page">
              <div class="goods-data clearfix emptytable">
                <div class="table-wrapper-responsive">
                <table summary="Shopping cart">
                  <tr>
                  <th><a onclick="quanxuan();" id="quan">全选</a></th>
                    <th class="goods-page-image">商品图片</th>
                    <th class="goods-page-description" width="350">商品名称</th>
                 <!--    <th class="goods-page-ref-no">颜色</th>
                    <th class="goods-page-ref-no">尺码</th> -->
                    <th class="goods-page-quantity">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数量</th>
                    <th class="goods-page-price">价格</th>
                    <th class="goods-page-total" colspan="2">总价</th>
                  </tr>
                  <form action="/home/orders" method="post" id="form1">
                @foreach($res as $k=>$v)
                  <tr>
                    <td><input type="checkbox" name="box[]" value="{{$v->id}}" class="che"></td>
                    <td class="goods-page-image" width="200">
                      @if(isset($gimg))
                      <a href="/home/detail/{{$v->gid}}"><img src="{{$gimg[$v->gid]->gimg}}" title="{{$v->gname}}"></a>
                      @endif
                    </td>
                    <td class="goods-page-description">
                      <h3><a href="/home/detail/{{$v->gid}}">{{$v->gname}}</a></h3>
                      <input type="hidden" name="gname{{$v->id}}[]" value="{{$v->gname}}">
                      <input type="hidden" name="gid{{$v->id}}[]" value="{{$v->gid}}">
                    </td>
              <!--       <td class="goods-page-ref-no">
                      <p>{{$v->color}}</p>
                    </td>
                    <td class="goods-page-ref-no">
                     <p>{{$v->size}}</p>
                    </td> -->
                    <td class="goods-page-quantity">
                      <div>
                          <input  type="button" value="+" class="form-control jia ">
                          <input  type="button" value="1" readonly class="form-control ">
                          <input  type="hidden" value="1" class="form-control " name="num{{$v->id}}[]">
                          <input  type="button" value="-" class="form-control jian ">
                          
                      </div>
                    </td>
                    <td class="goods-page-price">
                      <strong><span>¥</span>{{$v->price}}</strong>
                      <input type="hidden" name="price{{$v->id}}[]" value="{{$v->price}}">
                    </td>
                    <td class="goods-page-total">
                      <strong><span>¥</span>{{$total = $v->price}}</strong>
                    </td>
                  <input type="hidden" name="total{{$v->id}}[]" value="{{$v->price}}">
                    <td class="del-goods-col">
                         <button class='btn btn-danger' type="button" class="btn" onclick="delCart({{$v->id}}, $(this))">删除</button>
                    </td>
                    
                  </tr>
                @endforeach
                </table>
                </div>

                <div class="shopping-total">
                  <ul>
                    <li>
                      <em>运费</em>
                      <strong class="price"><span>¥</span>0.00</strong>
                    </li>
                    <li class="shopping-total-price">
                      <em>合计</em>
                     <strong class="price heji"><span>¥</span>0.00</strong>
                    </li>
                  </ul>
                </div>
              </div>
              <button class="btn btn-default" type="button" id="buybuybuy" onclick="buy();">继续购物 <i class="fa fa-shopping-cart"></i></button>
              {{csrf_field()}}
              <button class="btn btn-default col-md-offset-8" type="button" data-toggle="modal" data-target="#myModal">选择收货地址 <i class="fa fa-home"></i></button>
              <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#pay">立即下单 <i class="fa fa-check"></i></button>
            </div>

           <!-- 模态框（Modal弹出框）选择收货地址 -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                  </button>
                  <h4 class="modal-title" id="myModalLabel">
                    选择收货地址
                  </h4>
                </div>
                <div class="modal-body">
                @if(!empty($address))
                  <select class="form-control addresss">
                  <option readonly>--请选择收货地址--</option>
                  @foreach($address as $key => $val)
                    <option value="{{$i++}}">
                    收货地址:{{$val->address}}&nbsp;|&nbsp;联系人:{{$val->name}}&nbsp;|&nbsp;联系电话:{{$val->phone}}&nbsp;|&nbsp;
                    </option>
                  @endforeach

                  </select>
                  <input type="hidden" name="address" value="">
                  <input type="hidden" name="uid" value="{{$uid}}">
                @else
                  <font color="orange">暂时没有收货地址,请添加收货地址</font>
                @endif
                </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-info newaddress">
                    添加新地址
                  </button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">
                    确定
                  </button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal -->
          </div><!-- 模态框结束 -->

	<!-- 模态框（Modal弹出框）下单弹出框 -->
          <div class="modal fade" id="pay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                  </button>
                  <h4 class="modal-title" id="myModalLabel">
                    确认支付
                  </h4>
                </div>
                <div class="modal-body err">
             	你一共需要支付<font color="red">¥:666</font>
                </div>
                <div class="modal-footer">
                	<button type="button" class="btn btn-warning" data-dismiss="modal">
                    取消
                  	</button>
                    <button type="button" class="btn btn-danger payment">
                    确认支付
                    </button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal -->
          </div><!-- 模态框结束 -->
            </form>
          </div>
          <!-- END CONTENT -->
        </div>

        <script src="/assets/plugins/jquery.min.js"></script>
        <!-- 购物车js -->
        <script>

        var dan = 0;//商品单价
        var val = 0;//没选择地址时option的value
        var total = 0;//合计金额
         //加法,让购买的数量发生改变
          $('.jia').click(function(){
            var jia = $(this).next().val().trim();
            jia++;
            if (jia>10) {
              jian=10;
              alert('该商品每次限购10件');
            }
            $(this).next().val(jia);
            $(this).next().next().val(jia);

          //获取单价
           dan = $(this).parents('tr').find('.goods-page-price').text().trim().substring(1);
           //小数运算
           function accMul(arg1, arg2) {

          var m = 0, s1 = arg1.toString(), s2 = arg2.toString();

          try { m += s1.split(".")[1].length } catch (e) { }

          try { m += s2.split(".")[1].length } catch (e) { }

          return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m)

    }

          //改变商品小计          
         $(this).parents('tr').find('.goods-page-total').html('<strong><span>¥</span>'+accMul(dan, jia).toFixed(2)+'</strong>');
         //改变总价并选中该商品
          $(this).parents('tr').find('.che').removeAttr('checked',true);
             $(this).parents('tr').find('.che').attr('checked',true);
             totalprice();
            //应判断不能大于商品库存
            //
            
            
          });


          //减法 让购买数量和金额发生改变
           $('.jian').click(function(){
             var jian = $(this).prev().val().trim();
            jian--;
            if (jian<1) {
              jian=1;
              alert('最少购买一件,若想移出购物车,请点击右边的按钮');
            }
            $(this).prev().val(jian);
            $(this).prev().prev().val(jian);

            //改变商品总价
            //小数运算
            function accMul(arg1, arg2) {

          var m = 0, s1 = arg1.toString(), s2 = arg2.toString();

          try { m += s1.split(".")[1].length } catch (e) { }

          try { m += s2.split(".")[1].length } catch (e) { }

          return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m)

    }
    		//改变小计
             $(this).parents('tr').find('.goods-page-total').html('<strong><span>¥</span>'+accMul(dan, jian).toFixed(2)+'</strong>');
             //改变总价并选中该商品
              $(this).parents('tr').find('.che').removeAttr('checked',true);
             $(this).parents('tr').find('.che').attr('checked',true);
             totalprice();

             

          });

           //选中商品 勾选多选框
	           	$('.che').click(function(){
	                  totalprice();               
	                })                

                //封装总计的函数
                function totalprice()
                {
                  var num = 0;
                  //遍历
                  $(':checkbox:checked').each(function(){

                    //获取小计  返回得结果是字符串
                    xap = $(this).parents('tr').find('.goods-page-total').text();
                    var result = parseFloat(xap.replace('¥',''));
                    
                    num += result;
                  })

                  $('.heji').html('<span>¥</span>'+(num.toFixed(2)));
                  //改变应付款总额
                  $('.err').html('你一共需要支付<font color="red">¥:'+(num.toFixed(2))+'</font>'); 
                  total = num.toFixed(2);
                }

          //全选  全不选
            function quanxuan(){
              var str = $('#quan').text();
              if(str=="全选"){
                $('.che').attr('checked',true);
                   totalprice();
                $('#quan').text('全不选');
              }else{
                 $('.che').removeAttr('checked',true);
                 $('.heji').html('<span>¥</span>0.00');
                 $('#quan').text('全选');
              }
             
            }

                //返回首页
           function buy(){
            window.location.href="/homes";
           }

           //ajax删除
        function delCart(cart_id, obj)
        {
     	// 判断是否确定删除
     	var boole = confirm('确定将宝贝移出购物车吗?');
     	if(!boole){
     		return false;
     	}
          var url='/home/cart/'+cart_id;
          $.get(url, {}, function(result){
              // console.log(obj);
              var res = eval('(' + result + ')');
              if(res.code){

              	//移除商品
                obj.parents('tr').remove();
                //判断购物车是否为空
                var val = $('.che').val();
			   if(typeof(val) == 'undefined'){

			   	// alert('你的购物车空空如也');
			   	$('.emptytable').html('<center><font size="5" color="red">天哪,你的购物车是空的</font><img src="/upload/home/cart/emptyCart.png" width="200"></center>')
			   }

              }else{

                alert(res.msg);

              }
          })
 
        }

        //添加新地址按钮
        $('.newaddress').click(function(){
          window.location.href="/home/myadd/create";
        })

        // 将选中的地址的值填入相应的隐藏input
        $(function(){
        	$('.addresss').change(function(){
        		var data = $(this).val();
        		var value = parseInt(data)+1;
        		val = value;
        		// console.log(value);      		
        	//得到的地址+联系人+联系电话 
           var res = $(this).children().eq(value).text();
          // console.log(res);
          $(this).next().val(res);
        });
        	$('.addresss').val(0).trigger('change');
      })
        
        //确认支付后提交到订单控制器
	        $('.payment').click(function(){
	        	var str = $('.heji').text();
	        	var heji = parseFloat(str.replace('¥',''));
	        	// console.log(heji);
	        	if(!heji){
	        		$('.err').text('未选择任何商品');
	        		setTimeout(function(){
	        		$('.err').html('你一共需要支付<font color="red">¥:'+total+'</font>');		
	        		},3000);
	        		return false;
	        	}
	        	if(isNaN(val)){
	        		$('.err').text('未选择任何收货地址');
	        		setTimeout(function(){
	        		$('.err').html('你一共需要支付<font color="red">¥:'+total+'</font>');		
	        		},3000);
	        		return false;	        		

	        	}
	        		$('.err').text('支付成功');

	        		// 支付成功则提交表单
	        		 $('#form1').submit();

	        })

	        //如果购物车为空
	        $(function emptyCart() { 

			   var val = $('.che').val();
			   if(typeof(val) == 'undefined'){

			   	// alert('你的购物车空空如也');
			   	$('.emptytable').html('<center><font size="5" color="red">天哪,你的购物车是空的</font><img src="/upload/home/cart/emptyCart.png" width="200"></center>');

			   }

			})


      

        </script>
@stop

 