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
        	<div id="DataTables_Table_1_length" class="dataTables_length">             
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">
                            <a href="/admin/orders" class="btn btn-info">返回商品列表</a>
                        </font>
                    </font>
                </label>
            </div>
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
                        style="width: 136px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    订单号
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 282px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    商品名称
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending"
                        style="width: 212px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    商品图片
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 107px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    单价
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 67px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    数量
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 67px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    总计
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending"
                        style="width: 67px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    颜色
                                </font>
                            </font>
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending"
                        style="width: 67px;">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    大小
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
                                   {{$v->bianhao}}
                                </font>
                            </font>
                        </td>
                        <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{$v->gname}}
                                </font>
                            </font>
                        </td>
                        <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    @php
                                        $img = DB::table('goodsimg')->where('gid',$v->id)->first();
                                    @endphp
                                    <img src="{{$img->gimg}}" width="80px">
                                </font>
                            </font>
                        </td>
                        <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{$v->price}}
                                </font>
                            </font>
                        </td>
                          <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{$v->num}}
                                </font>
                            </font>
                        </td>
                        <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{$v->total}}
                                </font>
                            </font>
                        </td>
                        <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{$v->color}}
                                </font>
                            </font>
                        </td>
                        <td class=" ">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">
                                    {{$v->size}}
                                </font>
                            </font>
                        </td>
                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
          
			

        </div>
    </div>
</div>

@stop