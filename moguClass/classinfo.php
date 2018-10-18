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
			<!-- <div class="mui-content-padded" style="margin: 5px;text-align: center;">
				<button id='alertBtn' type="button" class="mui-btn mui-btn-blue mui-btn-outlined">警告消息框</button>
				<button id='confirmBtn' type="button" class="mui-btn mui-btn-blue mui-btn-outlined">确认消息框</button>
				<button id='promptBtn' type="button" class="mui-btn mui-btn-blue mui-btn-outlined">输入对话框</button>
				<button id='toastBtn' type="button" class="mui-btn mui-btn-blue mui-btn-outlined">自动消失提示框</button>
				<div id="info"></div>
			</div> -->
			<!-- <ul class="mui-table-view">
				<li class="mui-table-view-cell mui-media">
					<a href="javascript:;">
						<img class="mui-media-object mui-pull-left" src="../img/cd-icon-picture.svg">
						<div class="mui-media-body">
							xxx
							<p class='mui-ellipsis'>能和心爱的人一起睡觉，是件幸福的事情；可是，打呼噜怎么办？</p>
						</div>
					</a>
				</li>
			</ul> -->
			<div class="title">
				蘑菇编程，为未知而学，为未来而教！
			</div>
			<div class="mui-card">
				<div class="mui-card-header mui-card-media">
					<img src="../img/logo.png" />
					<div class="mui-media-body">
						小M同学
						<p>在蘑菇编程完成的第X个作品</p>
					</div>
					
				</div>
				<div class="mui-card-content" >
					<video src="https://video.pearvideo.com/mp4/adshort/20181002/cont-1448122-12988611_adpkg-ad_hd.mp4" controls="controls" width="100%"></video>
					<!-- <img src="../" alt="" width="100%"/> -->
				</div>
				<div class="mui-card-footer">
					<a class="mui-card-link">Like</a>
					<a class="mui-card-link">Comment</a>
					<a class="mui-card-link">Read more</a>
				</div>
			</div>
			<div class="title">
				导师评语
			</div>
			<div class="mui-card" style="margin-bottom: 35px;">
				<ul class="mui-table-view">
					<li class="mui-table-view-cell mui-media">
						<a href="javascript:;">
							<img class="mui-media-object mui-pull-right" src="../img/logo.png">
							<div class="mui-media-body">
								何老师
								<p class='mui-ellipsis'>想要这样一间小木屋，夏天挫冰吃瓜，冬天围炉取暖.</p>
							</div>
						</a>
					</li>
					<li class="mui-table-view-cell mui-media">
						<a href="javascript:;">
							<img class="mui-media-object mui-pull-right" src="../img/cd-icon-picture.svg">
							<div class="mui-media-body">
								陆老师
								<p class='mui-ellipsis'>烤炉模式的城，到黄昏，如同打翻的调色盘一般.</p>
							</div>
						</a>
					</li>
					<li class="mui-table-view-cell mui-media">
						<a href="javascript:;">
							<img class="mui-media-object mui-pull-right" src="../img/cd-icon-picture.svg">
							<div class="mui-media-body">
								赵老师
								<p class='mui-ellipsis'>静静的看这个世界，最后终于疯了</p>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="bottomAD" id="bottomAD">    
			<div class="bottom-con">        
				<div class="bottom-pic">            
					<img src="http://pic.kuaizhan.com/g1/M01/71/9C/wKjmqVbSY2GAWNvZAABPOdnuH1Q1142811" width="60" height="60" alt="">
				</div>        
				<div class="bottom-text" id="bottomText">业内唯一：<span style="color: chocolate;">985学霸团队亲授</span><br />298元的编程课免费体验</div>
				<!-- <div class="bottom-btn"></div>    -->
			</div>    
			<a id="bottomLink" href=" http://zygxsq.kuaizhan.com"></a>
		</div>


		<script src="../js/mui.min.js"></script>
		<script type="text/javascript" charset="utf-8">
			//mui初始化
			mui.init({
				statusBarBackground: '#f7f7f7'
			});
			
		</script>
	</body>

</html>