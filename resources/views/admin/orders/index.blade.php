@extends('layout.admins')
@section('title',$title)

@section('content')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            <font style="vertical-align: inherit;">
                <font style="vertical-align: inherit;">
                    {{$title}}
                </font>
            </font>
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
        	<form action="/admin/orders" method='get'>
            <div id="DataTables_Table_1_length" class="dataTables_length">           	
                <label>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            每页显示
                        </font>
                    </font>
                    <select size="1"  aria-controls="DataTables_Table_1" name="num">
                        <option value="10" @if($request->num == 10) selected @endif>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    10
                                </font>
                            </font>
                        </option>
                        <option value="25" @if($request->num == 25) selected  @endif>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    25
                                </font>
                            </font>
                        </option>
                    </select>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            项
                        </font>
                    </font>
                </label>
            	
            </div>
            <div class="dataTables_filter" id="DataTables_Table_1_filter">
                <label>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            收货人:
                        </font>
                    </font>
                    <input type="text" aria-controls="DataTables_Table_1"  name='search'>
                </label>
                <button class="btn btn-info">搜索</button>
            </div>
            </form>
            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 56px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    编号
                                </font>
                            </font>
                        </th>
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 96px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    用户名
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 96px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    收货人
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 197px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    收货地址
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 107px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    联系电话
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 107px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    订单时间
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 117px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    订单状态
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 133px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    邮编
                                </font>
                            </font>
                        </th>
                         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 227px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    查看
                                </font>
                            </font>
                        </th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                	@foreach($res as $k =>$v)
                	@if($k % 2 ==0)
                    <tr class="odd">
                    @else 
                    <tr class="even">
                    @endif
                    <td class="  ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                   {{$v->id}}
                                </font>
                            </font>
                        </td>
                        <td class="  ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                   @php
                                   $user = DB::table('homeuser')->where('id',$v->uid)->first();
                                   @endphp  
                                   {{$user->username}}                                 
                                </font>
                            </font>
                        </td>
                        <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{$v->linkman}}
                                </font>
                            </font>
                        </td>
                        <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{$v->address}}
                                </font>
                            </font>
                        </td>
                          <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{$v->phone}}
                                </font>
                            </font>
                        </td>
                        <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{date('Y-m-d H:i:s',$v->addtime)}}
                                </font>
                            </font>
                        </td>
                        <td class=" ">
                            <font style="vertical-align: inherit;">    

                               @switch($v->status)
                                    @case(0)
                                        <a class="btn btn-danger" href="/admin/status/{{$v->id}}-{{1}}" >等待发货</a>
                                        @break

                                    @case(1)
                                        <a class="btn btn-warning" href="/admin/status/{{$v->id}}-{{2}}" >确认发货</a>
                                        @break
                                    @case(2)
                                        <a class="btn btn-success" href="#" >确认收货</a>
                                        @break
                                    @case(3)
                                        <a class="btn btn-warning" href="#" >等待评论</a>
                                        @break
                                    @default
                                        <a class="btn btn-info" href="#" >订单完成</a>
                                @endswitch
                               
                            </font>
                        </td>
                        <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{$v->code}}
                                </font>
                            </font>
                        </td>
                        <td>
                            <a class='btn btn-info' href="/admin/orders/{{$v->id}}">订单详情</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="dataTables_info" id="DataTables_Table_1_info">
                当前页从 {{$res->firstItem()}} 到 {{$res->lastItem()}} 当前页共  {{$res->count()}} 条数据 &nbsp;&nbsp;&nbsp;整表共 {{$res->total()}}条数据


				<!-- 每页显示几条数据 -->
                <!-- {{$res->count()}} -->
                <!-- 显示每页的页码 -->
                <!-- {{$res->currentPage()}} -->

                <!-- 每页的数据从哪开始 -->
                <!-- {{$res->firstItem()}} -->

				<!-- 返回的是boolean true false -->
                <!-- {{$res->hasMorePages()}} -->

                <!-- 每页显示最后的数据 -->
                <!-- {{$res->lastItem()}} -->

                <!-- 最后的页码数 -->
                <!-- {{$res->lastPage()}} -->

                <!-- http://myapp.cn/admin/user?page=5
					返回的是下一页的链接地址
                 -->
                <!-- {{$res->nextPageUrl()}} -->

                <!--  -->
                <!-- {{$res->perPage()}}  ???? -->

				 <!-- http://myapp.cn/admin/user?page=5
					返回的是上一页的链接地址
                 -->
                <!-- {{$res->previousPageUrl()}} -->


                <!-- 获取总数据 -->
                <!-- {{$res->total()}} -->

                <!-- 
					$results->url($page)

					获取指定页码的url地址
                 -->
                 <!-- {{$res->url(4)}} -->
            </div>
            	<style>
				.pagination{
					
					margin:0px;
				}

				.pagination li{
					float: left;
				    height: 20px;
				    padding: 0 10px;
				    display: block;
				    font-size: 12px;
				    line-height: 20px;
				    text-align: center;
				    cursor: pointer;
				    outline: none;
				    background-color: #444444;
				    text-decoration: none;
				    border-right: 1px solid rgba(0, 0, 0, 0.5);
				    border-left: 1px solid rgba(255, 255, 255, 0.15);
				    box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.15);
				
				}

				.pagination a{
					color:#fff;
				}

				.pagination .active{
					background-color: #97c730;
					color: #323232;
				    border: none;
				    background-image: none;
				    box-shadow: inset 0px 0px 4px rgba(0, 0, 0, 0.25);
				}

				.pagination .disabled{
					color: #666666;
    				cursor: default;
				}
			</style>

            <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
				{{$res->links()}}
            </div>
        </div>
    </div>
</div>

@stop