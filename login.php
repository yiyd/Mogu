<?php
	session_start();
	// 判断是否存在session，且保留openid信息，无跳转请求
	if (empty($_SESSION['uid'])) {
		header('location:wxLogin/index.php');
		exit();
	} else{
		// 向后端接口发送openid, 判断用户信息是否与微信openid绑定
		?>
		<script src="js/mui.min.js"></script>
		<script type="text/javascript">
			mui.ajax('http://116.62.212.85:8082/user/hasBind', {
				data:{
					openid:"<?php echo $_SESSION['uid']; ?>"
				},
				dataType: 'json',
				type:'post',//HTTP请求类型
				timeout:10000,//超时时间设置为10秒；
				success:function(data){
					//服务器返回响应，判断是否有绑定
					if (data['message'] == 'yes') {
						// 已绑定直接跳转课程页
						// alert(data['openid']);
						window.location.href = 'moguClass/myclass.php';
					} else {
						// 未绑定跳转登录页
						console.log("<?php echo $_SESSION['uid']; ?>");
						window.location.href = 'moguLogin/moguLogin.php';
					}
					
				},
				error:function(xhr,type,errorThrown){
					//异常处理；
					console.log(type);
				}
			});
		</script>
		<?php
	}

?>