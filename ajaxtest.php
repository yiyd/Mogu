<?php
	
	if(isset($_REQUEST['openid']) && !isset($_REQUEST['account'])) {
		$openid = $_REQUEST['openid'];
		$result = array("status"=>"no", "openid"=>$openid);
		
		echo json_encode($result);
	}
	
	if (isset($_REQUEST['account']) && isset($_REQUEST['password'])) {
		$acc = $_REQUEST['account'];
		$pass = $_REQUEST['password'];
		$result = array("status"=>"yes", "account"=>$acc, "password"=>$pass);
		echo json_encode($result);
	}

?>