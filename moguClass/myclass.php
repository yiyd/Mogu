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
		<link rel="stylesheet" href="../css/timeline.css" type="text/css" />
		<script type="text/javascript" src="../js/modernizr.js"></script>
		<script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="../js/leftTime.min.js"></script>
		<style>
			.data-show-box{line-height:30px;}
			.date-tiem-span,.date-s-span{display: inline-block;font-size:18px; width:36px; height:30px;line-height:30px; text-align: center; color:#fff; border-radius:5px;}
			.date-tiem-span{ background:#333;}
			.date-s-span{ background:#f00;}
			.date-select-a{margin-right:5px;}
			.mui-bar-popover {
				width: 30%;
			}
			.mui-card .mui-control-content {
				padding: 10px;
			}
			
			.mui-control-content {
				height: 150px;
			}
		</style>

	</head>

	<body>
		<header class="mui-bar mui-bar-nav">
			<a class="mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>
			<h1 class="mui-title">我的课程</h1>
		</header>
		<nav class="mui-bar mui-bar-tab ">
			<a class="mui-tab-item" href="#Popover_0">课程选择</a>
			<a class="mui-tab-item">班主任：XXX</a>
		</nav>
		<div id="Popover_0" class="mui-popover mui-bar-popover">
			<div class="mui-popover-arrow"></div>
			<ul class="mui-table-view">
				<li class="mui-table-view-cell"><a href="#">当前课程</a>
				</li>
				<li class="mui-table-view-cell"><a href="#">历史课程</a>
				</li>
				<li class="mui-table-view-cell"><a href="#">其他课程</a>
				</li>
			</ul>
		</div>
		<div class="mui-content">
			<!-- <div class="mui-content-padded" style="margin: 5px;text-align: center;">
				<button id='alertBtn' type="button" class="mui-btn mui-btn-blue mui-btn-outlined">警告消息框</button>
				<button id='confirmBtn' type="button" class="mui-btn mui-btn-blue mui-btn-outlined">确认消息框</button>
				<button id='promptBtn' type="button" class="mui-btn mui-btn-blue mui-btn-outlined">输入对话框</button>
				<button id='toastBtn' type="button" class="mui-btn mui-btn-blue mui-btn-outlined">自动消失提示框</button>
				<div id="info"></div>
			</div> -->
			<div class="mui-content-padded">
				<div class="mui-card">
					<div class="mui-card-header" align="center">
						<h5>温馨提醒：离最近开班还有</h5>
					</div>
					<div class="mui-card-content">
						<div class="mui-card-content-inner">
							<div class="data-show-box" id="dateShow1" align="center">
								<span class="date-tiem-span d">00</span> 天
								<span class="date-tiem-span h">00</span> 时
								<span class="date-tiem-span m">00</span> 分
								<span class="date-s-span s">00</span> 秒
							</div>
						</div>
					</div>
					<!-- <div class="mui-card-footer">
						
					</div> -->
				</div>
			</div>
			<div class="mui-content-padded">
				<section id="cd-timeline" class="cd-container">
					<div class="cd-timeline-block">
						<div class="cd-timeline-img cd-picture">
							<img src="../img/cd-icon-picture.svg" alt="Picture">
						</div><!-- cd-timeline-img -->
						<div class="cd-timeline-content">
							<h2>C++ 第一课</h2>
							<p>下载免费素材尽在第九站长免费素材网</p>
							<a href="" class="cd-read-more">点我打卡</a>
							<a href="http://www.baidu.com" class="cd-read-more" style="right: 2px;">查看报告</a>
							<span class="cd-date">Jan 14</span>
						</div> 
					</div> 
				</section> 
			</div>
		</div>
		<script src="../js/mui.min.js"></script>
		<script type="text/javascript" charset="utf-8">
			//mui初始化
			mui.init({
				statusBarBackground: '#f7f7f7'
			});
			
			$(function(){
				var $timeline_block = $('.cd-timeline-block');
				//hide timeline blocks which are outside the viewport
				$timeline_block.each(function(){
					if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
						$(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
					}
				});
				//on scolling, show/animate timeline blocks when enter the viewport
				$(window).on('scroll', function(){
					$timeline_block.each(function(){
						if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) {
							$(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
						}
					});
				});
				
				// 请求课程数据
				
				//日期倒计时 
				$.leftTime("2018/10/07 23:45:24",function(d){
					if(d.status){
						var $dateShow1=$("#dateShow1");
						$dateShow1.find(".d").html(d.d);
						$dateShow1.find(".h").html(d.h);
						$dateShow1.find(".m").html(d.m);
						$dateShow1.find(".s").html(d.s);
					}
				});
			});
			
			
			
		</script>
	</body>

</html>