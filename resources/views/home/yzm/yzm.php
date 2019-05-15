<?php
echo 11;exit;
session_start();

//载入ucpass类
require_once('lib/Ucpaas.class.php');


//初始化必填
//填写在开发者控制台首页上的Account Sid
$options['accountsid']='399dd825f051090134937161a9192df1';
//填写在开发者控制台首页上的Auth Token
$options['token']='a0e5ef71e5e8485ac8920099dc5c3aae';

//初始化 $options必填
$ucpass = new Ucpaas($options);

$appid = "030509a1732c4dbaa4cd6e486f0fb999";	//应用的ID，可在开发者控制台内的短信产品下查看
$templateid = "439982";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
$param = rand(111111,999999); //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空

$_SESSION['param'] = $param;

$mobile = $_POST['yzmtel'];

// 876736
// 343560
// 


$uid = "";
//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);
