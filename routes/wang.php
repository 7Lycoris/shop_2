<?php
	// Route::get('/home/list/{pid}','Home\ListController@getChild');

//去商品的展示页面
	Route::get('home/detail/{id}','Home\DetailController@index');
//去商品的列表
	Route::get('/home/list/{cateid}','Home\ListController@index'); 
	//测试数据是否连通 
	Route::get('/home/ceshi','Home\CeshiController@bsell');





	