<?php

Route::get('/', 'Home\IndexController@index');
Route::get('/home/gywm', 'Home\IndexController@gywm');

Route::get('/home/nav/{id}','Home\NavController@index');