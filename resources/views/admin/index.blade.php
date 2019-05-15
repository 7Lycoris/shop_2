@extends('layout.admins')
@section('title',$title)
<style type="text/css">
	#whale {height: 99.5%; width: 100%;}
</style>
@section('content')
    <!-- <h2>北京时间:</h2> -->
    <div id="whale"></div>

@stop
@section('js')
<link href="/admin/sy/css/normalize.css" type="text/css" rel="stylesheet" />
<script src="/admin/sy/js/lanrenzhijia.js"></script>

@stop