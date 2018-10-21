<?php
	session_start();
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
		<link rel="stylesheet" href="../css/timeline.css" type="text/css" />
		<script type="text/javascript" src="../js/modernizr.js"></script>
		<script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
		<script type="text/javascript" src="../js/leftTime.min.js"></script>
		<style>
			.data-show-box{line-height:30px;}
			.date-tiem-span,.date-s-span{display: inline-block;font-size:18px; width:36px; height:30px;line-height:30px; text-align: center; color:#fff; border-radius:5px;}
			.date-tiem-span{ background:#333;}
			/* .date-s-span{ background:#f00;} */
			.date-s-span{ background:#c03b44;}
			.date-select-a{margin-right:5px;}
			.mui-bar-popover {
				width: 30%;
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
			<a class="mui-tab-item" id="headmaster">班主任：XXX</a>
		</nav>
		<div id="Popover_0" class="mui-popover mui-bar-popover">
			<div class="mui-popover-arrow"></div>
			<ul class="mui-table-view">
				<li class="mui-table-view-cell"><a href="javascript:getList(0)">当前课程</a>
				</li>
				<li class="mui-table-view-cell"><a href="javascript:getList(1)">历史课程</a>
				</li>
				<li class="mui-table-view-cell"><a href="javascript:getList(2)">其他课程</a>
				</li>
			</ul>
		</div>
		<div class="mui-content">
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
				</div>
			</div>
			<div class="mui-content-padded">
				<section id="cd-timeline" class="cd-container">
					<div class="cd-timeline-block">
						<div class="cd-timeline-img cd-picture">
							<img src="../img/cd-icon-picture.svg" alt="Picture">
						</div><!-- cd-timeline-img -->
						<div class="cd-timeline-content">
							<h2>第九站长 1</h2>
							<p>第九站长专注于提供免费素材下载,其内容涵盖设计素材,PSD素材,矢量素材,图片素材,图标素材,设计字体等免费素材.下载免费素材尽在第九站长免费素材网</p>
							<a href="http://www.dijiuzhanzhang.com" class="cd-read-more">阅读更多</a>
							<span class="cd-date">Jan 14</span>
						</div> <!-- cd-timeline-content -->
					</div> <!-- cd-timeline-block -->
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
				// 进入页面立即请求【当前课程数据】
				getList(0);

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
			});
			
			// 请求课程数据
			function getList(classType) {
				console.log(classType);
				mui.ajax('http://116.62.212.85:8082/lesson/list', {
					data:{
						openid:"<?php echo $_SESSION['uid']; ?>",
						//openid: '12345',
						classtype:classType
					},
					dataType: 'json',
					type:'post',//HTTP请求类型
					timeout:10000,//超时时间设置为10秒；
					success:function(data){
						//服务器返回响应，判断是否有课程数据
						console.log(data);
						if (data['success'] == true) {
							// 获取课程数据 刷新页面时间轴
							// 调整班主任名字
							var headteacherHtml = document.getElementById('headmaster');
							headteacherHtml.innerHTML = "班主任： " + data['headteacher']
							
							// 设置计时器时间
							var temp =  data['message'][0]['starttime'];
							// temp = "2018-10-29  00:00:00";
							var leftTimeDate = new Date(temp).format('yyyy-MM-dd hh:mm:ss');
							$.leftTime(leftTimeDate,function(d){
								if(d.status){
									var $dateShow1=$("#dateShow1");
									$dateShow1.find(".d").html(d.d);
									$dateShow1.find(".h").html(d.h);
									$dateShow1.find(".m").html(d.m);
									$dateShow1.find(".s").html(d.s);
								}
							});
							
							// 刷新课程时间轴
							var classlineHtml = document.getElementById('cd-timeline');
							classlineHtml.innerHTML = "";
							classNumber = data['total'];
							classInfoList = data['message'];
							
							//var tempHmtl = "";
							for (var i = 0; i < classNumber; i++) {
								// 建立一堆元素,纯JS方式
								var div1 = document.createElement('div');
								div1.setAttribute('class', 'cd-timeline-block');
								
								var div2 = document.createElement('div');
								div2.setAttribute('class', 'cd-timeline-img');
								
								var div3 = document.createElement('div');
								div3.setAttribute('class', 'cd-timeline-content');
								
								var img1 = document.createElement('img');
								img1.setAttribute('src', '../img/cd-icon-picture.svg');
								
								var title = document.createElement('h2');
								title.innerHTML = classInfoList[i]['classname'];
								
								var desc = document.createElement('p');
								desc.innerHTML = classInfoList[i]['classdesc'];
								
								var a1 = document.createElement('a');
								a1.setAttribute('class', 'cd-read-more');
								a1.setAttribute('href', 'classinfo.php?openid=' + classInfoList[i]['openid'] + '&classid=' + classInfoList[i]['classid']);
								
								var a2 = document.createElement('a');
								a2.setAttribute('class', 'cd-read-more');
								a2.setAttribute('style', 'right: 2px;background: #75ce66;');
								a2.setAttribute('href', classInfoList[i]['reporturl']);
								a2.innerHTML = '查看报告';
								
								var timeSpan = document.createElement('span');
								timeSpan.setAttribute('class', 'cd-date');
								timeSpan.innerHTML = classInfoList[i]['starttime'].split(" ")[0];
								
								// 部分节点修饰
								// 判断是否已完成打卡, 需要调整节点背景色
								if (classInfoList[i]['checked']) {
									// 绿色
									div2.setAttribute('style', 'background: #75ce66;');
									a1.innerHTML = "打卡完成";
									a1.setAttribute('style', 'background: #75ce66;');
								} else {
									// 红色
									div2.setAttribute('style', 'background: #c03b44;');
									//div2.setAttribute('class', 'cd-timeline-img cd-moive');
									a1.innerHTML = "点我打卡";
									a1.setAttribute('style', 'background: #c03b44;');
								}
								
								// 各元素进行拼装，从内到外
								div3.appendChild(title);
								div3.appendChild(desc);
								div3.appendChild(a1);
								div3.appendChild(a2);
								div3.appendChild(timeSpan);
								
								div2.appendChild(img1);
								
								div1.appendChild(div2);
								div1.appendChild(div3);
								
								classlineHtml.appendChild(div1);
							}
						} else {
							// 未绑定跳转登录页
							mui.alert("无课程");
						}
						
					},
					error:function(xhr,type,errorThrown){
						//异常处理；
						console.log(type);
					},
				});
			}
			
			
		</script>
	</body>

</html>