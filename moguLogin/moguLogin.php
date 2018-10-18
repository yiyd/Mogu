<!DOCTYPE html>
<html class="ui-page-login">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>蘑菇编程</title>
		<link href="../css/mui.min.css" rel="stylesheet" />
		<style>
			.ui-page-login,
			body {
				width: 100%;
				height: 100%;
				margin: 0px;
				padding: 0px;
			}
			.mui-content{height: 100%;}
			.area {
				margin: 20px auto 0px auto;
			}
			
			.mui-input-group {
				margin-top: 10px;
			}
			
			.mui-input-group:first-child {
				margin-top: 20px;
			}
			
			.mui-input-group label {
				width: 22%;
			}
			
			.mui-input-row label~input,
			.mui-input-row label~select,
			.mui-input-row label~textarea {
				width: 78%;
			}
			
			.mui-checkbox input[type=checkbox],
			.mui-radio input[type=radio] {
				top: 6px;
			}
			
			.mui-content-padded {
				margin-top: 25px;
			}
			
			.mui-btn {
				padding: 10px;
			}
			
			.link-area {
				display: block;
				margin-top: 25px;
				text-align: center;
			}
			
			.spliter {
				color: #bbb;
				padding: 0px 8px;
			}
			
			.oauth-area {
				position: absolute;
				bottom: 20px;
				left: 0px;
				text-align: center;
				width: 100%;
				padding: 0px;
				margin: 0px;
			}
			
			.oauth-area .oauth-btn {
				display: inline-block;
				width: 50px;
				height: 50px;
				background-size: 30px 30px;
				background-position: center center;
				background-repeat: no-repeat;
				margin: 0px 20px;
				/*-webkit-filter: grayscale(100%); */
				border: solid 1px #ddd;
				border-radius: 25px;
			}
			
			.oauth-area .oauth-btn:active {
				border: solid 1px #aaa;
			}
			
			.oauth-area .oauth-btn.disabled {
				background-color: #ddd;
			}
			p img {
				max-width: 100%;
				height: auto;
			}
		</style>
	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
			<h1 class="mui-title">您未绑定微信，请登录</h1>
		</header>
		<div class="mui-content">
			<br />
			<p>
				<img src="../img/welcom.png" />
			</p>
			<form id='login-form' class="mui-input-group">
				<div class="mui-input-row">
					<label>账号</label>
					<input id='account' type="text" class="mui-input-clear mui-input" placeholder="请输入手机号">
				</div>
				<div class="mui-input-row">
					<label>密码</label>
					<input id='password' type="password" class="mui-input-clear mui-input" placeholder="请输入密码">
				</div>
			</form>
			<!--<form class="mui-input-group">
				<ul class="mui-table-view mui-table-view-chevron">
					<li class="mui-table-view-cell">
						自动登录
						<div id="autoLogin" class="mui-switch">
							<div class="mui-switch-handle"></div>
						</div>
					</li>
				</ul>
			</form>-->
			<div class="mui-content-padded">
				<button id='login' class="mui-btn mui-btn-block mui-btn-primary">登录</button>
			</div>
			<div class="mui-content-padded oauth-area">

			</div>
		</div>
		<script src="../js/mui.min.js"></script>
		<script>
			mui.init({
				statusBarBackground: '#f7f7f7'
			});
			
			// 从输入框获取账号密码，加上openid, 传入后台进行绑定并跳转课程页
			var accountBox = document.getElementById('account');
			var passwordBox = document.getElementById('password');
			var loginButton = document.getElementById('login');
			
			// 用户点击登录按钮触发ajax请求
			loginButton.addEventListener('tap', function(event) {
				mui.ajax('http://116.62.212.85:8082/user/bind', {
					data:{
						account:accountBox.value,
						password:passwordBox.value, 
						openid:"<?php echo $_SESSION['uid']; ?>"
					},
					dataType: 'json',
					type:'post',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						//服务器返回响应，判断是否有绑定
						if (data['message'] == 'yes') {
							// 已绑定直接跳转课程页
							mui.toast('绑定成功！下次可以自动登录');
							window.location.href = '../moguClass/myclass.php';
						} else {
							// 未绑定跳转登录页
							mui.alert('绑定失败，请检查账号密码并重新登录！', '提示', function(){
								window.location.href = 'moguLogin.php';
							});	
						}
						
					},
					error:function(xhr,type,errorThrown){
						//异常处理；
						console.log(type);
					}
				});
			});
			
		</script>
	</body>

</html>