<?php if (!defined('THINK_PATH')) exit();?>﻿<!doctype html>
<html class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /><!--读取IE最新渲染-->
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<title>去拍房</title>
<link href="/qupaifang/Tpl/Home/Public/css/comcss.css" rel="stylesheet" type="text/css" />
<link href="/qupaifang/Tpl/Home/Public/css/css.css" rel="stylesheet" type="text/css" />
<link href="/qupaifang/Tpl/Home/Public/css/font.css" rel="stylesheet" type="text/css" />
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
<script src="/qupaifang/Public/js/template.js"></script>
<script type="text/javascript" src="/qupaifang/Tpl/Home/Public/js/common.js"></script>
</head>

<body class="public_color">
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
				<a href="<?php echo U('Evaluation/index');?>">
					房产估价
				</a>
				<a href="<?php echo U('Subject/index');?>">
					新房
				</a>
				<a href="<?php echo U('Subject/index');?>">
					二手房
				</a>
				<a href="<?php echo U('Article/index');?>">
					资讯
				</a>
				<a href="<?php echo U('Page/index');?>">
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
<section class="secondhand_side">
	<div class="secondhand_tit">
		<i class="iconfont">&#xe69e;</i>
		<a href="<?php echo U('Index/index');?>">首页</a> <i class="iconfont">&#xe60d;</i>
		<a href="<?php echo U('Member/index');?>">我的账户</a><i class="iconfont">&#xe60d;</i>
		<a href="<?php echo U('Member/shelves');?>">拍售</a><i class="iconfont">&#xe60d;</i>
		我要出售
	</div>
	<div class="secondhand_side_info">
		<aside class="basic_nav">
	<h3>
		<i class="iconfont">&#xe602;</i>我的账户
	</h3>
	<ul>
		<li>
			<span>
				<i class="iconfont">&#xe60e;</i>个人资料
			</span>
			<a href="<?php echo U('Member/base_info');?>">
				基本信息
			</a>
			<a href="<?php echo U('Member/password');?>">
				修改密码
			</a>
		</li>
		<li>
			<span>
				<i class="iconfont">&#xe617;</i>个人账户
			</span>
			<a href="<?php echo U('Member/account');?>">
				我的账户信息
			</a>
			<a href="<?php echo U('Member/recharge');?>">
				我要充值
			</a>
			<a href="<?php echo U('Member/withdrawals');?>">
				我要提现
			</a>
			<a href="<?php echo U('Member/bond');?>">
				保证金
			</a>
		</li>
		<li>
			<span>
				<i class="iconfont">&#xe79b;</i>拍购
			</span>
			<a href="<?php echo U('Member/collection');?>">
				我的收藏
			</a>
			<a href="<?php echo U('Member/buy_lists');?>">
				报名标的
			</a>
			<a href="<?php echo U('Member/buy_deal');?>">
				成交标的
			</a>
		</li>
		<li>
			<span>
				<i class="iconfont">&#xe6bf;</i>拍售
			</span>
			<a href="<?php echo U('Member/sell');?>">
				我要出售
			</a>
			<a href="<?php echo U('Member/shelves');?>">
				上架标的
			</a>
			<a href="<?php echo U('Member/sell_deal');?>">
				成交标的
			</a>
		</li>
		<!-- <li>
			<span>
				<i class="iconfont">&#xe679;</i>围观
			</span>
		</li> -->
	</ul>
</aside>
		<article class="basic_info_right">
			<div class="basic_info_right_tit">
				<ul>
					<li class="basic_sub">
						<a href="<?php echo U('Member/sell');?>">
							我要出售
						</a>
					</li>
					<li>
						<a href="<?php echo U('Member/shelves');?>">
							上架标的
						</a>
					</li>
					<li>
						<a href="<?php echo U('Member/sell_deal');?>">
							标的成交
						</a>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="basic_info_side sell_side">
				<div class="sell_s_tit">
					<ul>
						<li class="sell_click">
							<a href="javascript:;">
								<div class="sell_sst_icon">
									<i class="iconfont">&#xe60a;</i>
								</div>
								<p>1.阅读并同意服务协议</p>
							</a>
						</li>
						<li>
							<a href="javascript:;">
								<div class="sell_sst_icon">
									<i class="iconfont">&#xe610;</i>
								</div>
								<p>2.填写房屋基本信息</p>
							</a>
						</li>
						<li>
							<a href="javascript:;">
								<div class="sell_sst_icon">
									<i class="iconfont">&#xe64b;</i>
								</div>
								<p>3.核对出售合同</p>
							</a>
						</li>
						<li>
							<a href="javascript:;">
								<div class="sell_sst_icon">
									<i class="iconfont">&#xe634;</i>
								</div>
								<p>4.提交平台审核</p>
							</a>
						</li>
					</ul>
				</div>	
				<form action="<?php echo U('Member/sell');?>" method="post" class="agreement_form">
				<div class="agreement">
					<div class="agreement_tit">
						<h3>服务协议</h3>
					</div>
					<div class="agreement_info">
						<p>
							一、本须知遵循公平、公正、公开原则，竞买人应认真仔细阅读，了解本须知的全部内容，并对自己的行为承担法律责任。
							<p>二、凡具备完全民事行为能力的公民、法人和其他组织均可参加竞买。</p>
							<p>三、本次拍卖活动设置延时出价功能，在竞买活动结束前，最后5分钟之内如果有竞买人出价，就自动延迟5分钟。（重要提示：在手机站或PC站参与竞拍的竞买人在拍品竞拍结束前最后五分钟内请多刷新页面，以防止其他竞买人触发延时功能而错失成功竞拍。）</p>
							<p>四、保证金：竞买人需在竞买结束前完成报名缴纳保证金。保证金缴纳户名：三门银城房产销售代理有限公司；开户银行：中国邮政储蓄银行股份有限公司三门县支行；账号：《933005010018978888》。保证金缴纳台头请注明拍品编号（编号：PFC***）</p>
							<p>五、锁定期限：如果竞买成功，竞买成功的竞买人保证金将转为购房定金，抵扣购房款，其余竞价不成功的竞买人保证金在3个工作日内予以返还。如果流拍或无人出价，则所有竞买人保证金在3个工作日内予以返还。保证金不计息。
							<p>六、保证金适用：保证金适用《中华人民共和国合同法》定金罚则。对成功买卖的房地产保证金即时转为履约定金，如违约，竞买人不得索取已经支付的定金。</p>
							<p>七、三门拍房网对拍卖标的物所作的说明和提供的资料、图片等，仅供竞买人参考，不构成对标的物的任何担保。所以请竞买人在竞买之前必须仔细审查拍卖标的物，调查是否存在瑕疵，认真研究查看所竞买标的物的实际情况，并请亲临现场实地查看，未实地查看的竞买人视为对本标的实物现状的确认，慎重决定竞买行为，竞买人一旦作出竞买决定，即表明已完全了解，并接受标的物的现状和一切已知及未知的瑕疵。</p>
							<p>八、本次竞买活动计价货币为人民币，起拍价、成交价均不含买受人在竞买标的物交割、过户时所发生的全部费用和税费。</p>
							<p>九、本标的物是设起拍价的增价竞买方式，竞买者在限定时间内出价高于(不低于)起拍价方可成交。成交后，出卖人和竞买人必须于5个工作日内到平台指定地点（三门县海游街道平海路31号）签订《房地产（不动产）买卖合同》，其后，按照合同约定办理购房款支付与房地产（不动产）交割事宜。标的支持贷款支付尾款。</p>
							<p>十、标的物交割、过户时所发生的税费、过户所需费等，竞买人只需承担自已部分。</p>
							<p>十一、违约责任，拍品成交之后，竞买人不得反悔，竞买人如反悔，三门拍房网平台有权将保证金（定金）没收，若拍品再行上架拍卖，原竞买人禁止参加。</p>
							<p>十二、参加竞买的人应当遵守拍卖须知的规定，不得阻挠其他竞买人竞拍，不得操纵、垄断竞拍价格，严禁竞买人恶意串标，上述行为一经发现，将取消其竞买资格，并追究相关的法律责任。
							本规则其他未尽事宜，请向三门拍房网客服咨询。
							咨询电话：0576-83497877
						</p>
					</div>
					
				</div>
				<div class="sell_button">
					<input type="hidden" name="is_agreement" value="1"/>
					<button type="submit">已阅读并同意协议</button>
				</div>
				</form>
			</div>
		</article>
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
<script>
	$(".evaluation_form").Validform({
	    tiptype:function(msg,o,cssctl){
	        if (o.type == 3)
	        layer.msg(msg, {icon:5});
	    },
	    ajaxPost:true,
	    callback:function(result){
	    	//console.log(result);
	        if(result.status == 1){
	            layer.msg(result.msg, {icon:6}, function(){ 
	                location.reload();
	            });
	        } else {
	            layer.msg(result.msg, {icon:5});
	        }
	    }
	});
</script>
<script>
	$(".agreement_form").Validform({
	    tiptype:function(msg,o,cssctl){
	        if (o.type == 3)
	        layer.msg(msg, {icon:5});
	    },
	    ajaxPost:true,
	    callback:function(result){
	    	//console.log(result);
	        if(result.status == 1){
	            layer.msg(result.msg, {icon:6}, function(){ 
	                location.href=result.url;
	            });
	        } else {
	            layer.msg(result.msg, {icon:5});
	        }
	    }
	});
</script>

</body>
</html>