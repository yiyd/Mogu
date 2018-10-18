<?php
	include 'config.php';
	// judge the state
	if (empty($_GET['state'])) {
		exit('Wrong Value, Please Relogin');
	}
	if ($_GET['state'] != $_SESSION['state']) {
		exit('<script>alert("Wrong Value");location.href="../login.php"</script>');
	}
	
	// User has granted, the get the access_token
	$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.appID.
			'&secret='.appSecret.
			'&code='.$_GET['code'].
			'&grant_type=authorization_code';
	$res = myCurl($url);
	$user = json_decode($res, true);
	
	// Get USerinfo
	$url1 = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$user['access_token'].
			'&openid='.$user['openid'].'&lang=zh_CN';
	$res1 = myCurl($url1);
	$userinfo = json_decode($res1, true);
	
	// Check the return info
	if (!empty($user['errcode'])) {
		exit('Wrong Value, Please Relogin');
	}
	// register the userinfo
	$_SESSION['uid'] = $userinfo['openid'];
	$_SESSION['uface']   = $userinfo['headimgurl'];
	$_SESSION['uname']   = $userinfo['nickname'];
	header('location:../login.php');
	
	// Define function myCurl
	function myCurl($url) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL            , $url);
		curl_setopt($curl, CURLOPT_HEADER         ,0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER , true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER , false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST , false);
		curl_setopt($curl, CURLOPT_ENCODING       , 'gzip,deflate');
		$res  = curl_exec($curl);
		curl_close($curl);
		
		return $res;
	}
	
?>

