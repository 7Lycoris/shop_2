<?php

//前台购物车页面
Route::resource('/home/cart','Home\CartController');

//前台的订单页面
Route::get('/home/orders','Home\OrdersController@index');
Route::post('/home/orders','Home\OrdersController@create');
