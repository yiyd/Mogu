<?php
	session_start();
	require_once '../wxLogin/config.php';
	require_once '../wxJS/jssdk.php';
	
	$jssdk = new JSSDK(appID, appSecret); 
    $signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>蘑菇编程</title>
		<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">

		<!--标准mui.css-->
		<link rel="stylesheet" href="../css/mui.min.css">
		<link rel="stylesheet" href="../css/app.css">
		<script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
		<style>
			.title {
				margin: 20px 15px 10px;
				color: #6d6d72;
				font-size: 15px;
			}
			.margingT {        
				margin-bottom: 60px;    
			}    
			.bottomAD {        
				-webkit-box-sizing: border-box;        
				height: 80px;        
				position: fixed;        
				bottom: 0;        
				left: 0;        
				z-index: 1000;        
				padding: 0 10px;        
				overflow: hidden;        
				width: 100%;        
				background: rgba(0, 0, 0, .8);    
			}    
			.bottom-pic {        
				position: absolute;        
				top: 10px;        
				width: 60px;        
				height: 60px;        
				overflow: hidden;        
				-webkit-border-radius: 10px;        
				border-radius: 10px;    
			}        
			.bottom-pic img {            
				width: 100%;            
				height: 100%;        
			}    
			.bottom-text {        
				margin-left: 70px;        
				line-height: 40px;        
				font-size: 14px;        
				color: #fff;    
			}    
			.bottom-btn {        
				position: absolute;        
				top: 20px;        
				right: 10px;        
				height: 40px;        
				line-height: 40px;        
				color: #fff;        
				background-color: #60b900;        
				border-radius: 6px;        
				text-align: center;        
				font-size: 16px;        
				padding: 0 5px;        
				font-weight: bold;    
			}    
			.bottomAD a {        
				position: absolute;        
				top: 0;        
				right: 0;        
				bottom: 0;        
				left: 0;
			}
		</style>

	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
			<h1 class="mui-title">完成打卡</h1>
		</header>
		<div class="mui-content">
			<div class="title">
				蘑菇编程，为未知而学，为未来而教！
			</div>
			<div class="mui-card">
				<div class="mui-card-header mui-card-media">
					<img class="mui-card-img" src="../img/logo.png" id="wx-img"/ >
					<div class="mui-media-body" id="user-info">
						<!-- 小M同学
						<p>在蘑菇编程完成的第X个作品</p> -->
					</div>
					
				</div>
				<div class="mui-card-content">
					<video src="https://video.pearvideo.com/mp4/adshort/20181002/cont-1448122-12988611_adpkg-ad_hd.mp4" controls="controls" width="100%" id="video-content"></video>
					<!-- <img src="../" alt="" width="100%"/> -->
				</div>
			</div>
			<div class="title">
				导师评语
			</div>
			<div class="mui-card" style="margin-bottom: 35px;">
				<ul class="mui-table-view" id="comments-ul">
					
				</ul>
			</div>
		</div>
		<div class="bottomAD" id="bottomAD">    
			<div class="bottom-con">        
				<div class="bottom-pic">            
					<img src="../img/WechatIMG367.jpeg" width="60" height="60" alt="">
				</div>        
				<div class="bottom-text" id="bottomText">业内唯一：<span style="color: chocolate;">985学霸团队亲授</span><br />298元的编程课免费体验</div>
				<!-- <div class="bottom-btn"></div>    -->
			</div>    
			<a id="bottomLink" href="https://jinshuju.net/f/8NL6tU"></a>
		</div>

		<script src="../js/mui.min.js"></script>
		<script type="text/javascript" charset="utf-8">
			//mui初始化
			mui.init({
				statusBarBackground: '#f7f7f7'
			});
			
			// wx-js
			function setWxJs(openid, classid) {
				//console.log('<?php echo $signPackage["rawString"]?>');
				wx.config({
					debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
					appId: '<?php echo $signPackage["appId"];?>',
					timestamp: <?php echo $signPackage["timestamp"];?>,
					nonceStr: '<?php echo $signPackage["nonceStr"];?>',
					signature: '<?php echo $signPackage["signature"];?>',
					jsApiList: [
						// 所有要调用的 API 都要加到这个列表中
						'onMenuShareTimeline',
						'onMenuShareAppMessage',
						'updateAppMessageShareData',
						'updateTimelineShareData'
					]
				});
					
				// 检查微信API	
// 				wx.checkJsApi({
// 					jsApiList: ['updateAppMessageShareData', 'updateTimelineShareData'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
// 					success: function(res) {
// 					// 以键值对的形式返回，可用的api值true，不可用为false
// 					// 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
// 						mui.alert(res['checkResult']);
// 						console.log(res);
// 					}
// 				});		
				
				// 调用
				wx.ready(function() {
					wx.onMenuShareAppMessage({
						title: "<?php echo $_SESSION['uname']; ?>" + "的蘑菇编程作品", // 分享标题
						desc: '快来看', // 分享描述
						link: '<?php echo $signPackage["url"];?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
						imgUrl: "<?php echo $_SESSION['uface']; ?>", // 分享图标
						type: '', // 分享类型,music、video或link，不填默认为link
						dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
						success: function () {
						// 用户点击了分享后执行的回调函数
							mui.alert('分享成功!');
						}
					});
					
					wx.onMenuShareTimeline({
						title: "<?php echo $_SESSION['uname']; ?>" + "的蘑菇编程作品", // 分享标题
						link: '<?php echo $signPackage["url"];?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
						imgUrl: "<?php echo $_SESSION['uface']; ?>", // 分享图标
						success: function () {
							// 用户点击了分享后执行的回调函数
							mui.alert('打卡成功!');
							// 执行打卡
							checkClass(openid, classid);
						},
						cancel: function() {
							mui.alert('打卡未完成：您取消了分享！');
						}
					});
				});
			}

			// 立即执行
			$(function() {
				// 获取当前URL地址解析参数
				var curUrl = window.location.search
				var str = curUrl.split("&");
				var openid = str[0].split("=")[1];
				var classid = str[1].split("=")[1];
				// console.log(openid + " " + classid);
				
				// 设置微信JS
				setWxJs(openid, classid);
				
				// 请求课程结果
				mui.ajax('http://116.62.212.85:8082/lesson/comment', {
					data:{
						openid:openid,
						classid:classid
					},
					dataType: 'json',
					type:'post',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						//服务器返回响应，判断是否有绑定
						if (data['success'] == true) {
							// 绘制页面
							drawPage(data['message'])
						} else {
							// 未绑定跳转登录页
							mui.alert('参数错误');	
						}
					},
					error:function(xhr,type,errorThrown){
						//异常处理；
						console.log(type);
					}
				});
			});
			
			function drawPage(data) {
				// 展示用户信息
				var userPic = document.getElementById('wx-img');
				userPic.setAttribute('src', data['wximgurl']);
				
				var userInfo = document.getElementById('user-info');
				userInfo.innerHTML = data['wxnickname'] + "同学"; 
				var pText = document.createElement('p');
				pText.innerHTML = "在蘑菇编程完成的第" + data['classindex'] + "个作品";
				userInfo.appendChild(pText);
				var video = document.getElementById('video-content');
				video.setAttribute('src', data['classvidelurl']);
				
				// 展示评语
				var commentsUl = document.getElementById('comments-ul');
				var commentsData = data['teachercomments'];
				
				for (var key in commentsData[0]) {
					var commentLi = document.createElement('li');
					commentLi.setAttribute('class', 'mui-table-view-cell mui-media mui-collapse');
					var a1 = document.createElement('a');
					a1.setAttribute('class', 'mui-navigate-right');
					a1.setAttribute('href', '#');
					var img1 = document.createElement('img');
					img1.setAttribute('class', 'mui-media-object mui-pull-right');
					img1.setAttribute('src', '../img/teacher.jpg');
					var div1 = document.createElement('div');
					div1.setAttribute('class', 'mui-media-body');
					div1.innerHTML = key + "老师";
					
					var p1 = document.createElement('p');
					p1.setAttribute('class', 'mui-ellipsis');
					p1.innerHTML = "[点击查看详情]" + commentsData[0][key];
					
					var div2 = document.createElement('div');
					div2.setAttribute('class', 'mui-collapse-content');
					var p2 = document.createElement('p');
					p2.setAttribute('style', 'word-break:break-all;');
					p2.innerHTML = commentsData[0][key];
					
					// 拼接
					div2.appendChild(p2);
					
					div1.appendChild(p1);
					a1.appendChild(img1);
					a1.appendChild(div1);
					commentLi.appendChild(a1);
					commentLi.appendChild(div2);
					
					commentsUl.appendChild(commentLi);
				}
			}
			
			function checkClass(openid, classid) {
				mui.ajax('http://116.62.212.85:8082/lesson/check', {
					data:{
						openid:openid,
						classid:classid
					},
					dataType: 'json',
					type:'post',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						//服务器返回响应
						if (data['message'] == 'yes') {
							mui.toast('打卡成功！');
						} else {
							mui.alert("打卡失败！");
						}
					},
					error:function(xhr,type,errorThrown){
						//异常处理；
						console.log(type);
					}
				});
			}
			
		</script>
	</body>

</html>