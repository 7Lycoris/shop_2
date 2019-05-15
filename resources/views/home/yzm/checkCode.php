<?php 

	session_start();

	$cv = $_GET['cv'];

	// echo $cv;
	//获取手机上的验证码
	$pcv = $_SESSION['param'];

	//判断
	if($cv == $pcv){

		echo 1;
	} else {

		echo 0;
	}
