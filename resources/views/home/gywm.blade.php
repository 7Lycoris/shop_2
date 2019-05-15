@extends('layout.homes')

@section('title',$title)

@section('content')

 <!-- Header END -->

    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="http://www.xdl.com/homes">首页</a></li>
            <li class="active">关于我们</li>
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

              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div><img src="/img/sanfu0.jpg" width="1140px;"></div>
                  <div style="color: #757575;font-size: 14px;line-height: 1.7;margin: 10px 0 0 0;padding: 67px 310px;text-indent:2em;"><p>1992年11月19日，三福百货的前身 “融新百货”成立，1994年3月三福百货有限公司正式成立。公司成立伊始即以“顾客、员工、社会”为经营宗旨，为顾客创造价值，为员工创造成长机会，为社会创造财富，始终奉行“顾客第一”的理念，使公司在十余年的时间里稳健、持续发展。 经过十八多年的发展，至2011年12月已拥有了7个终端大区，下属共计五百余家连锁商店，一个培训中心，三个商品配送中心。</p></div>
                  <div><img src="/img/sanfu1.jpg" width="1140px;"></div>
                  <div style="color: #757575;font-size: 14px;line-height: 1.7;margin: 10px 0 0 0;padding: 67px 310px;text-indent:2em;"><p>公司使命：让年轻人轻松享受时尚生活——easy life easy fashion　年轻人：在城市生活的15-35岁的青年。
轻 松：休闲、放松、便捷、快速。
享 受：乐趣、被注意、被认可、受尊重、无负担。
时 尚：新颖有个性、符合流行潮流、快速变化。
公司核心价值观
顾客——顾客导向、快速反应顾客需求。 顾客为导向：顾客为导向是一种意识，根植于每个三福员工的心中，形成处处为顾客着想的服务氛围。
快速反应顾客需求：三福要做得比顾客所期望的更好，依据顾客需求做出更为灵活、更为快速的反应，更好地满足顾客的需求。
亲切、适时的标准化服务：为顾客提供亲切、适时的标准化服务，是三福的服务承诺。
员工——以人为本、诚信求实、共同发展
三福以人为本，尊重每位员工。</p></div>
                  <div><img src="/img/sanfu2.jpg" width="1140px;"></div>
                  <div style="color: #757575;font-size: 14px;line-height: 1.7;margin: 10px 0 0 0;padding: 67px 310px;text-indent:2em;"><p>在河北、河南、安徽、江西、江苏、上海、山东、浙江、福建、广东、广西、湖北、湖南、重庆、四川、贵州、陕西、山西等200个大中城市拥有三个商品配送中心、一个员工培训中心、超万名员工，成为各地休闲服饰零售市场的领导者。三福百货下辖五个大区（华南、华东、华北、华中、西南），规模仍在不断扩张中。为了给顾客提供持续的优质服务，保证产品质量始终如一，也为了避免加盟商良莠不齐给三福百货的品牌形象带来负面影响，三福百货的店铺全部为公司直营店。公司暂时不接受加盟。</p></div>
              </div>                                                    
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
