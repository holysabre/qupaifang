<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><!--读取IE最新渲染-->
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title>去拍房</title>
<link href="/qupaifang/Tpl/Home/Public/css/comcss.css" rel="stylesheet" type="text/css" />
<link href="/qupaifang/Tpl/Home/Public/css/css.css" rel="stylesheet" type="text/css" />
<!--add css-->
<script src="/qupaifang/Tpl/Home/Public/js/jquery-1.11.1.min.js"></script>
<!-- Modernizr JS -->
<script src="/qupaifang/Tpl/Home/Public/js/modernizr/modernizr-2.6.2.min.js"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="/qupaifang/Tpl/Home/Public/js/modernizr/respond.min.js"></script>
<![endif]-->
<!--swiper js-->
<link href="/qupaifang/Tpl/Home/Public/css/swiper.min.css" rel="stylesheet" type="text/css" />
<script src="/qupaifang/Tpl/Home/Public/js/swiper.min.js"></script>
<script type="text/javascript" src="/qupaifang/Public/layer/layer.js"></script>
<!--add js-->
<!-- 字体 -->
<script type="text/javascript" src="/qupaifang/Public/plupload/plupload.full.min.js"></script>
<script type="text/javascript">
var pathswf = '/qupaifang/Public/plupload/';
var root_path = '/qupaifang/';
</script>
<script type="text/javascript" src="/qupaifang/Public/plupload/plupload.js"></script>
<link href="/qupaifang/Public/plupload/plupload.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/qupaifang/Public/js/jquery.dragsort-0.5.2.min.js"></script>
<script src="/qupaifang/Public/js/Validform_v5.3.2.js"></script>
<link rel="stylesheet" type="text/css" href="/qupaifang/Tpl/Home/Public/css/cssreset-min.css">
<script type="text/javascript" src="/qupaifang/Tpl/Home/Public/js/jquery.citys.js"></script>
<script type="text/javascript" src="/qupaifang/Tpl/Home/Public/js/common.js"></script>
</head>

<body>
<section class="public_header">
	<div class="in_banner_center">
		<div class="top_line public_top_line">
			<div class="logo">
				<img src="/qupaifang/Tpl/Home/Public/images/logo.png" alt="">
			</div>
			<nav class="nav public_nav">
				<a href="/qupaifang/">
					首页
				</a>
				<a href="evaluation.asp">
					房产估价
				</a>
				<a href="newhome.asp">
					新房
				</a>
				<a href="secondhand.asp">
					二手房
				</a>
				<a href="<?php echo U('News/index');?>">
					资讯
				</a>
				<a href="help.asp">
					帮助
				</a>
				<div class="clear"></div>
			</nav>
			<div class="sign_line public_sign_line">
				<a href="javascript:;">
					关注微信
				</a>
				<?php if(empty($member)): ?><a href="javascript:;" class="sign">
						登录
					</a>
					<a href="javascript:;" class="registered">
						注册
					</a>
				<?php else: ?>
					<a href="<?php echo U('Member/index');?>">个人中心</a>
					<a href="javascript:;" onclick="logout('<?php echo U('Member/logout');?>')">登出</a><?php endif; ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</section>
<section class="sign_side sign_side3">
	<div class="sign_side_center">
		<div class="sign_side_center_left">
		<form action="<?php echo U('Member/reg');?>" method="post" class="member_form">
			<div class="sscl_tit">
				<i class="iconfont">&#xe657;</i>
				<p>会员注册</p>
			</div>
			<ul>
				<li>
					<input name="mobile" type="text" value="请输入手机号码"onfocus="if (value =='请输入手机号码'){value =''}"onblur="if (value ==''){value='请输入手机号码'}"/>
				</li>
				<li class="pls_code">
					<input name="code" type="text" value="请输入验证码"onfocus="if (value =='请输入验证码'){value =''}"onblur="if (value ==''){value='请输入验证码'}"/>
					<div class="please_code">
						<a href="javascript:;" onclick="sendsms(this)">
							获取验证码
						</a>
					</div>
					<div class="clear"></div>
				</li>
			</ul>
			<button type="submit">注册</button>
		</form>
		</div>
		<div class="sign_side_center_right">
			<h3>扫一扫 进入手机端</h3>
			<img src="/qupaifang/Tpl/Home/Public/images/ewm.jpg" alt="">
			<p>卖房信息实时更新，进度随时掌握</p>
			<p>更多贴心房主服务，更多惊喜好礼</p>
		</div>
		<div class="clear"></div>
		<div class="close2">
			<i class="iconfont">&#xe62b;</i>
		</div>
	</div>
</section>

<section class="sign_side sign_side2">
	<div class="sign_side_center">
		<div class="sign_side_center_left">
		<form action="<?php echo U('Member/login_sms');?>" method="post" class="member_form">
			<div class="sscl_tit">
				<i class="iconfont">&#xe602;</i>
				<p>会员登录</p>
			</div>
			<ul>
				<li>
					<input name="mobile" type="text" value="请输入手机号码"onfocus="if (value =='请输入手机号码'){value =''}"onblur="if (value ==''){value='请输入手机号码'}"/>
				</li>
				<li class="pls_code">
					<input name="code" type="text" value="请输入验证码"onfocus="if (value =='请输入验证码'){value =''}"onblur="if (value ==''){value='请输入验证码'}"/>
					<div class="please_code">
						<a href="javascript:;" onclick="sendsms(this)">
							获取验证码
						</a>
					</div>
					<div class="clear"></div>
				</li>
			</ul>
			<button type="submit">登录</button>
		</form>
		</div>
		<div class="sign_side_center_right">
			<h3>扫一扫 进入手机端</h3>
			<img src="/qupaifang/Tpl/Home/Public/images/ewm.jpg" alt="">
			<p>卖房信息实时更新，进度随时掌握</p>
			<p>更多贴心房主服务，更多惊喜好礼</p>
		</div>
		<div class="clear"></div>
		<div class="close2">
			<i class="iconfont">&#xe62b;</i>
		</div>
	</div>
</section>

<script>
	var wait = 60;
    $(function(){
        $('.public_sign_line a.registered').click(function(){
            $('.sign_side3').fadeIn()
        })
         $('.close2 i').click(function(){
            $('.sign_side3').hide()
        })
         $('.public_sign_line a.sign').click(function(){
            $('.sign_side2').fadeIn()
        })
         $('.close2 i').click(function(){
            $('.sign_side2').hide()
        });
    })
    //异步发送短信
   	function sendsms(obj){
   		var mobile = $(obj).closest('ul').find('input[name="mobile"]').val();
    	if(check_mobile(mobile)){
    		//验证码正确
        	time($(obj));
        	//发送短信验证码
        	$.get("<?php echo U('Member/ajax_sendsms');?>",{mobile:mobile},function(data){
				console.log(data);
				if(data.status == 1){
					layer.msg('短信已发送，请注意查收');
				}else{

				}
			},"json");
    	}
		
   	}
   	//发送短信验证码
   	function time(o) {
   		if (wait == 0) {
   			o.attr('onclick','sendsms(this)');
   			o.text('获取验证码');
   			wait = 60;
   		} else {
   			o.removeAttr('onclick');
   			o.text("重新发送(" + wait + ")");
   			wait--; 
   			setTimeout(function() {
   				time(o);
   			},
   			1000)
   		}
   	}
   	//验证手机号码规则
   	function check_mobile(mobile){
   		if(mobile == ''){
   			layer.msg('请输入手机号码');
			return false;
   		}
   		if(!(/^1[34578]\d{9}$/.test(mobile))){  
   			layer.msg('手机号码有误，请重填');
	        return false; 
	    } 
	    return true;
   	}
   	//提交表单
   	$(".member_form").Validform({
	    tiptype:function(msg,o,cssctl){
	        if (o.type == 3)
	        layer.msg(msg, {icon:5});
	    },
	    ajaxPost:true,
	    callback:function(result){
	    	//console.log(result);
	        if(result.status == 1){
	            layer.msg(result.msg, {icon:6}, function(){ 
	                location.href = result.url;
	            });
	        } else {
	            layer.msg(result.msg, {icon:5});
	        }
	    }
	});
</script>

<section class="news_side">
	<div class="news_side_title">
		<ul>
			<?php if(is_array($List)): $i = 0; $__LIST__ = $List;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
					<a href="">
						政策资讯
					</a>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
		<div class="news_date">
			<span id="time"><?php echo date('Y-m-d',time());?></span>
			<span id="time2"><?php echo getTimeWeek(time());?></span>
		</div>
		<div class="clear"></div>
	</div>
	<div class="news_side_list">
		<article class="news_side_list_left">
			<div class="news_banner_scroll">
				<div class="flexslider">
					<ul class="slides">
						<li style="background:url(images/newimg.jpg) 50% 0 no-repeat;">
							<div class="news_describe">
								<p>合景泰富首入台州 囊获临海大田街道两宗地块</p>
							</div>
						</li>
						<li style="background:url(images/newimg.jpg) 50% 0 no-repeat;">
							<div class="news_describe">
								<p>合景泰富首入台州 囊获临海大田街道两宗地块2</p>
							</div>
						</li>
						<li style="background:url(images/newimg.jpg) 50% 0 no-repeat;">
							<div class="news_describe">
								<p>合景泰富首入台州 囊获临海大田街道两宗地块3</p>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<div class="news_list_all">
				<ul>
					<li>
						<a href="news_detail.asp">
							<h3>直播高考那些事儿：他竟然押中了今年的作文题！？</h3>
							<div class="news_list_all_side">
								<div class="news_side_pic">
									<img src="/qupaifang/Tpl/Home/Public/images/news_list_all_sidepic.jpg" alt="">
								</div>
								<div class="news_side_info">
									<div class="news_side_info_t">
										<em>政策资讯</em>
										<span>2017-06-08</span>
										<span>阅读（888）</span>
										<p>
											人民大学商学院在工商管理学科领域里的学术声誉和地位还是比较高的，应该说我们有最好的学科，在2012年教育部的一级学科评估里面我们工商管
										</p>
									</div>
									<div class="news_side_info_b">
										<i class="iconfont">&#xe6bf;</i>	房产    政策   优惠    降价
									</div>
								</div>
								<div class="clear"></div>
							</div>
						</a>
						<div class="news_share_side">
							<a href="">
								<i class="iconfont">&#xe600;</i>
							</a>
						</div>
					</li>
					<li>
						<a href="">
							<h3>直播高考那些事儿：他竟然押中了今年的作文题！？</h3>
							<div class="news_list_all_side">
								<div class="news_side_pic">
									<img src="/qupaifang/Tpl/Home/Public/images/news_list_all_sidepic.jpg" alt="">
								</div>
								<div class="news_side_info">
									<div class="news_side_info_t">
										<em>政策资讯</em>
										<span>2017-06-08</span>
										<span>阅读（888）</span>
										<p>
											人民大学商学院在工商管理学科领域里的学术声誉和地位还是比较高的，应该说我们有最好的学科，在2012年教育部的一级学科评估里面我们工商管
										</p>
									</div>
									<div class="news_side_info_b">
										<i class="iconfont">&#xe6bf;</i>	房产    政策   优惠    降价
									</div>
								</div>
								<div class="clear"></div>
							</div>
						</a>
						<div class="news_share_side">
							<a href="">
								<i class="iconfont">&#xe600;</i>
							</a>
						</div>
					</li>
				</ul>
			</div>
		</article>
		<aside class="news_right_side">
			<div class="valuation_num">
				<h3>8,935,992</h3>
				<p>TA们在去拍房成功买卖</p>
				<input name="textfield" type="text" value="请输入您的手机号码"onfocus="if (value =='请输入您的手机号码'){value =''}"onblur="if (value ==''){value='请输入您的手机号码'}"/>
				<button>免费估价</button>
			</div>
			<div class="deal_list">
				<div class="deal_list_tit">
					<i class="iconfont">&#xe62e;</i>
					<span>最新成交</span>
				</div>
				<ul>
					<li>
						<a href="">
							<figure>
								<img src="/qupaifang/Tpl/Home/Public/images/dealimg.jpg" alt="">
								<figcaption>
									<h3>去拍房小区名称</h3>
									<p>10年房龄  / 120平方米  / 三门</p>
									<span>2017.06.08成交</span>
									<em>120万</em>
									<div class="clear"></div>
								</figcaption>
							</figure>
						</a>
					</li>
				</ul>
			</div>
			<div class="advertising_mould">
				<img src="/qupaifang/Tpl/Home/Public/images/advertising.jpg" alt="">
				<div class="advan_text">
					广告
				</div>
			</div>
			<div class="recommend">
				<div class="deal_list_tit recommend_tit">
					<i class="iconfont">&#xe62e;</i>
					<span>热门推荐</span>
				</div>
				<div class="recommend_list">
					<ul>
						<li>
							<a href="">
								<div class="recommend_pic">
									<img src="/qupaifang/Tpl/Home/Public/images/recommend_pic.jpg" alt="">
									<div class="recommend_pic_num">
										1
									</div>
								</div>
								<div class="recommend_text">
									<div class="recommend_text_t">
										<p><span>政策</span>
										直播高考那些事儿：他竟然押中了今年的作</p>
										<div class="clear"></div>
									</div>
									<div class="recommend_text_b">
										2017-06-31  15:28:48
									</div>
								</div>
								<div class="clear"></div>
							</a>
						</li>
						<li>
							<a href="">
								<div class="recommend_pic">
									<img src="/qupaifang/Tpl/Home/Public/images/recommend_pic.jpg" alt="">
									<div class="recommend_pic_num">
										2
									</div>
								</div>
								<div class="recommend_text">
									<div class="recommend_text_t">
										<p><span>政策</span>
										直播高考那些事儿：他竟然押中了今年的作</p>
										<div class="clear"></div>
									</div>
									<div class="recommend_text_b">
										2017-06-31  15:28:48
									</div>
								</div>
								<div class="clear"></div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</aside>
		<div class="clear"></div>
	</div>
	
</section>

<section class="footer_line_all">
	<div class="footer_line">
		<div class="footer_line_nav">
		<ul>
			<li>
				<span>关于我们</span>
				<a href="">
					公司简介
				</a>
				<a href="">
					联系我们
				</a>
			</li>
			<li>
				<span>服务体系</span>
				<a href="">
					我要充值
				</a>
				<a href="">
					平台服务
				</a>
				<a href="">
					门店服务
				</a>
				<a href="">
					竞买保障
				</a>
				<a href="">
					常见问题
				</a>
			</li>
			<li>
				<span>新闻中心</span>
				<a href="">
					政策资讯
				</a>
				<a href="">
					成功案例
				</a>
				<a href="">
					行业新闻
				</a>
				<a href="">
					公司新闻
				</a>
				<a href="">
					媒体报道
				</a>
			</li>
			<li>
				<span>帮助中心</span>
				<a href="">
					竞买流程
				</a>
			</li>
		</ul>
	</div>
	<div class="in_footer_contact">
		<span>联系我们</span>
		<em>全国统一服务热线</em>
		<h3>0576-83497877</h3>
		<p>地址：三门县海游街道平海路31号</p>
		<p>加盟入驻热线：0576-83497877</p>
	</div>
	<div class="clear"></div>
	</div>
	
</section>

<section class="footer">
	<div class="footer_center">
		<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
	<p>
		Copyright © 2017 三门拍房网 版权所有 All Rights Reserved. ICP:浙ICP备14042137号-1  技术支持：乐环科技
	</p>
	</div>
	
</section>

<section class="gotop">
	<a title="返回顶部" class="top">
		<i class="iconfont">&#xe649;</i>
	</a>
</section>
<script type="text/javascript">
    $(function () {

        $(".top").click(//定义返回顶部点击向上滚动的动画
        function () {
            $('html,body').animate({ scrollTop: 0 }, 700);
        });
        $(".bottom").click(//定义返回顶部点击向上滚动的动画
        function () {
            $('html,body').animate({ scrollTop: document.body.clientHeight }, 700);
        });
    })
</script>
<!--add js-->
<script type="text/javascript" src="/qupaifang/Tpl/Home/Public/js/jquery.flexslider-min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.flexslider').flexslider({
			directionNav: true,
			pauseOnAction: false
		});
	});
</script>
<!--add js-->
</body>
</html>