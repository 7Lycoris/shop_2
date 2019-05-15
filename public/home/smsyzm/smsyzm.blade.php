<?php
// echo 12324;exit;

session_start();

//载入ucpass类
// require_once('./lib/Ucpaas.class.php');
include './lib/Ucpaas.class.php';
$mobile = $_GET['yzmtel'];

// 876736
// 343560
echo $mobile;exit;

//初始化必填
//填写在开发者控制台首页上的Account Sid
$options['accountsid']='7928dbdb25dc6beda18662da36bfa11b';
//填写在开发者控制台首页上的Auth Token
$options['token']='374f1e795f032e3d6f51bc0e83dbc4c3';

//初始化 $options必填
$ucpass = new Ucpaas($options);

$appid = "31452f7df7074f7c9b55fd6409cae95b";	//应用的ID，可在开发者控制台内的短信产品下查看
$templateid = "441204";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
$param = rand(111111,999999); //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空

$_SESSION['param'] = $param;

$mobile = $_GET['yzmtel'];

// 876736
// 343560
echo $mobile;exit;


$uid = "";
//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);
