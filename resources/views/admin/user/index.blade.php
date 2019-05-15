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
        	<form action="/admin/user" method='get'>
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
                <label>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            <a href="/admin/user/create" class="btn btn-info">添加用户</a>
                        </font>
                    </font>
                </label>
            	
            </div>
            <div class="dataTables_filter" id="DataTables_Table_1_filter">
                <label>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            用户名:
                        </font>
                    </font>
                    <input type="text" aria-controls="DataTables_Table_1"  name='search'>
                </label>
                 <label>
                        邮箱:
                        <input type="text" name='email' value="{{$request->email}}" aria-controls="DataTables_Table_1">
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
                        style="width: 36px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    编号
                                </font>
                            </font>
                        </th>
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending"
                        style="width: 156px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    用户名
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 212px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    邮箱
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 107px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    手机
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 133px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    头像
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 97px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    是否显示
                                </font>
                            </font>
                        </th>
                         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending"
                        style="width: 227px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    操作
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
                                   {{$v->username}}
                                </font>
                            </font>
                        </td>
                        <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{$v->email}}
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
                                <img src="{{$v->profile}}" width="50px">
                            </font>
                        </td>
                        <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{$v->status? '启用':'禁用'}}
                                </font>
                            </font>
                        </td>
                        <td>
                            <a class='btn btn-info' href="/admin/userrole/{{$v->id}}">角色</a>
                        	<a href="/admin/user/{{$v->id}}/edit" class="btn btn-warning">修改</a>
                            <form style="display: inline" action="/admin/user/{{$v->id}}" method="post">
                                {{csrf_field()}}
                                
                                <button class="btn btn-danger" onclick="return confirm('是否确定删除')">删除</button>
                            </form>
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