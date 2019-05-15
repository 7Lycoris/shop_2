@extends('home.oneself.oneself')

@section('oneself')
<style type="text/css">
  .product-page{
    width: 800px;
  }
</style>
<div class="col-md-9 col-sm-7">
    <div class="product-page">
        <div class="row">
            @if(empty($res))
                暂无数据
            @else
                <div class="product-page">
    <div class="row">
        <div class="product-page">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="product-main-image">
                        <img src="{{$img}}" alt="{{$res->gname}}" class="img-responsive"
                        data-bigimgsrc="assets/pages/img/products/model7.jpg" data-bd-imgshare-binded="1">
                    </div>
                    <div class="product-other-images">
                        <a href="assets/pages/img/products/model3.jpg" class="fancybox-button"
                        rel="photos-lib">
                        @foreach($imgs as $k => $v)
                            <img alt="图片丢失" src="{{$v['gimg']}}" data-bd-imgshare-binded="1">
                        </a>
                        @endforeach
                        
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h1>
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">
                                {{$res->gname}}
                            </font>
                        </font>
                    </h1>
                    <div class="price-availability-block clearfix">
                        <div class="price">
                            <strong>
                                <span>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">
                                            $
                                        </font>
                                    </font>
                                </span>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        89.00
                                    </font>
                                </font>
                            </strong>
                        </div>
                        <div class="availability">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    可用性：
                                </font>
                            </font>
                            <strong>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        库存
                                    </font>
                                </font>
                            </strong>
                        </div>
                    </div>
                    <div class="description">
                        <p>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{$res->gname}}
                                </font>
                            </font>
                        </p>
                    </div>
                    <div class="product-page-options">
                        <div class="pull-left">
                            <label class="control-label">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        尺寸：
                                    </font>
                                </font>
                            </label>
                            <label class="control-label">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        {{$order->size}}
                                    </font>
                                </font>
                            </label>
                        </div>
                        <div class="pull-left">
                            <label class="control-label">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        颜色：
                                    </font>
                                </font>
                            </label>
                            <label class="control-label">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        {{$order->color}}
                                    </font>
                                </font>
                            </label>
                        </div>
                    </div>
                
                    <ul class="social-icons">
                        <div class="bdsharebuttonbox bdshare-button-style0-16" data-bd-bind="1557053456310">
                            <a href="#" class="bds_more" data-cmd="more">
                            </a>
                            <a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间">
                            </a>
                            <a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友">
                            </a>
                            <a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信">
                            </a>
                            <a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博">
                            </a>
                            <a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博">
                            </a>
                            <a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网">
                            </a>
                            <a href="#" class="bds_isohu" data-cmd="isohu" title="分享到我的搜狐">
                            </a>
                            <a href="#" class="bds_bdhome" data-cmd="bdhome" title="分享到百度新首页">
                            </a>
                        </div>
                        <script>
                            window._bd_share_config = {
                                "common": {
                                    "bdSnsKey": {},
                                    "bdText": "",
                                    "bdMini": "2",
                                    "bdMiniList": false,
                                    "bdPic": "",
                                    "bdStyle": "0",
                                    "bdSize": "16"
                                },
                                "share": {},
                                "image": {
                                    "viewList": ["qzone", "sqq", "weixin", "tsina", "tqq", "renren", "isohu", "bdhome"],
                                    "viewText": "分享到：",
                                    "viewSize": "16"
                                },
                                "selectShare": {
                                    "bdContainerClass": null,
                                    "bdSelectMiniList": ["qzone", "sqq", "weixin", "tsina", "tqq", "renren", "isohu", "bdhome"]
                                }
                            };
                            with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~ ( - new Date() / 36e5)];
                        </script>
                    </ul>
                </div>
                <div class="product-page-content">
                    <ul id="myTab" class="nav nav-tabs">
                        <li class="active">
                            <a href="#Description" data-toggle="tab" aria-expanded="true">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        描述
                                    </font>
                                </font>
                            </a>
                        </li>
                        <li class="">
                            <a href="#Reviews" data-toggle="tab" aria-expanded="false">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">
                                        评论
                                    </font>
                                </font>
                            </a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div class="tab-pane fade active in" id="Description">
                          {!!$res->content!!}
                        </div>
                        <div class="tab-pane fade" id="Reviews">
                            <!--<p>There are no reviews for this product.</p>-->
                           
                            <!-- BEGIN FORM-->
                            <form action="/home/oneself" class="reviews-form" role="form" method="post">
                                <h2>
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">
                                            写评论
                                        </font>
                                    </font>
                                </h2>
                                <div class="form-group">
                                    <input type="hidden" name="gid" value="{{$res->id}}">
                                    <textarea class="form-control" rows="8" id="review" name="comment"> 
                                    </textarea>
                                </div>
                                <div class="padding-top-20">
                                    {{csrf_field()}}
                                    <button type="submit" class="btn btn-primary">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">
                                                发送
                                            </font>
                                        </font>
                                    </button>
                                </div>
                            </form>
                            <!-- END FORM-->
                        </div>
                    </div>
                </div>
                <div class="sticker sticker-sale">
                </div>
            </div>
        </div>
    </div>
</div>
            @endif
        </div>
    </div>
</div>
 
@stop