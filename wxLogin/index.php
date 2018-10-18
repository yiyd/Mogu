<?php
	include 'config.php';
	
	$_SESSION['state'] = md5(rand(11111,12345678));
	$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.appID.'&redirect_uri='.BACKURL.'&response_type=code&scope=snsapi_userinfo&state='.$_SESSION['state'].'#wechat_redirect';
	
	header('location:'.$url);
	exit();
?>