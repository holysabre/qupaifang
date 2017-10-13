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
<link rel="stylesheet" href="/qupaifang/Public/layui/css/layui.css">
<script type="text/javascript" src="/qupaifang/Public/layui/layui.js"></script>
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
		<a href="<?php echo U('Member/base_info');?>">个人资料</a><i class="iconfont">&#xe60d;</i>
		基本信息
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
						<a href="<?php echo U('Member/base_info');?>">
							基本信息
						</a>
					</li>
					<li>
						<a href="<?php echo U('Member/password');?>">
							修改密码
						</a>
					</li>
					<li>
						<a href="<?php echo U('Member/pay_password');?>">
							支付密码
						</a>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="basic_info_side">
				<div class="basic_info_s_t">
					<div class="basic_info_s_t_photo">
						<figure>
							<img src="<?php echo (get_img($info["head_img"])); ?>" alt="" class="head_pic">
							<figcaption>
								<a href="javascript:;" class="update_img" id="uploadBtn_head_pic" data-id="head_pic" data-url="<?php echo U('Upload/upload');?>" data-ajax="<?php echo U('Member/update_head_img');?>" data-class="head_pic" data-file="head_pic" data-session="<?php echo session_id();?>">更换头像</a>
								<div id="uploadBtn_head_pic-filelist">Your browser doesn\'t have Flash, Silverlight or HTML5 support.</div>
							</figcaption>
						</figure>
					</div>
					<div class="basic_info_s_t_wel">
						<p>
							亲爱的 <span><?php echo ((isset($info["name"]) && ($info["name"] !== ""))?($info["name"]):$info['username ']); ?></span>，您好，欢迎来到去拍房！
						</p>
						<em>登录次数：共<?php echo ($info["login_times"]); ?>次</em>
						<em>上次登录：<?php echo (date("Y-m-d H:i:s",$info["login_time"])); ?></em>
					</div>
					<div class="clear"></div>
				</div>
				<form action="<?php echo U('Member/base_info');?>" method="post" class="layui-form baseinfo_form">
				<?php if($info["is_complete"] == 0): ?><div class="basic_info_s_m">
					<h3>安全设置</h3>
					<div class="basic_info_s_m_side">
						<ul>
							<li>
								<label>
									设置密码：
								</label>
								<input type="password" name="password">
								<span>*登录密码，字母与数字下划线等组合</span>
								<div class="clear"></div>
							</li>
							<li>
								<label>
									确认密码：
								</label>
								<input type="password" name="repassword">
								<span>*请再次输入密码</span>
								<div class="clear"></div>
							</li>
						</ul>
					</div>
				</div>

				<div class="basic_info_s_m">
					<h3>支付设置</h3>
					<div class="basic_info_s_m_side">
						<ul>
							<li>
								<label>
									设置密码：
								</label>
								<input type="password" name="pay_password">
								<span>*登录密码，字母与数字下划线等组合</span>
								<div class="clear"></div>
							</li>
							<li>
								<label>
									确认密码：
								</label>
								<input type="password" name="re_pay_password">
								<span>*请再次输入密码</span>
								<div class="clear"></div>
							</li>
						</ul>
					</div>
				</div><?php endif; ?>

				<div class="basic_info_s_b">
					
					<h3>个人信息</h3>
					<ul>
						<li class="mobile">
							<span>手机号：</span>
							<input type="text" name="mobile" value="<?php echo ($info["mobile"]); ?>" readonly="true">
							<div class="clear"></div>
						</li>
						<li class="name">
							<span>真实姓名：</span>
							<input type="text" name="name" value="<?php echo ($info["name"]); ?>">
							<div class="clear"></div>
						</li>
						<li class="gender">
							<span>性别：</span>
					    	<input type="radio" name="sex" value="男" title="男" <?php echo ($info['sex']=='男'?'checked=""':''); ?>>
					        <input type="radio" name="sex" value="女" title="女" <?php echo ($info['sex']=='女'?'checked=""':''); ?>>
							<div class="clear"></div>
						</li>
						<div class="clear"></div>
						<li class="time">
							<span>生日：</span>
							<input name="birthday" value="<?php echo ($info["birthday"]); ?>" class="layui-input" onclick="layui.laydate({elem: this, istime: true, format: 'YYYY-MM-DD'})">
							<div class="clear"></div>
						</li>
						<li class="residence">
							<span>居住地：</span>
				    		<div class="residence_address">
				    			<select name="province" lay-filter="province">
					    			<option></option>
					    		</select>
				    		</div>
				    		<div class="residence_address">
					    		<select name="city" lay-filter="city">
					    			<option></option>
					    		</select>
					    	</div>
					    	<div class="residence_address">
					    		<select name="area" lay-filter="area">
					    			<option></option>
					    		</select>
				    		</div>
				            <input class="residence_info" name="address" type="text" value="<?php echo ((isset($info["address"]) && ($info["address"] !== ""))?($info["address"]):'详细地址'); ?>" onfocus="if (value =='详细地址'){value =''}"onblur="if (value ==''){value='详细地址'}"/>
							<div class="clear"></div>
						</li>
						<li class="certificates">
							<span>有效证件：</span>
							<div class="certificates_select">
								<select name="certificates_type">
									<option value="身份证" <?php echo ($info['certificates_type']=='身份证'?'selected=""':''); ?>>身份证</option>
									<option value="驾驶证" <?php echo ($info['certificates_type']=='驾驶证'?'selected=""':''); ?>>驾驶证</option>
								</select>
							</div>
							<input class="residence_info" name="certificates_number" type="text" value="<?php echo ((isset($info["certificates_number"]) && ($info["certificates_number"] !== ""))?($info["certificates_number"]):'证件号'); ?>" onfocus="if (value =='证件号'){value =''}"onblur="if (value ==''){value='证件号'}"/>
							<div class="clear"></div>
						</li>
					</ul>
					<div class="button_at">
						<input type="hidden" name="id" value="<?php echo ($info["id"]); ?>"/>
						<button class="preservate" type="submit">保存</button>
						<button class="reset" type="reset">重置</button>
					</div>
					
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
<script type="text/javascript" src="/qupaifang/Tpl/Home/Public/js/citys.js"></script>
<script>
	layui.use(['element', 'form', 'laydate'], function(){
	  var element = layui.element()
	  ,form = layui.form()
	  
	  pca.init('select[name=province]', 'select[name=city]', 'select[name=area]',"浙江","台州","椒江区");
	})
</script>
<script>
	$(".baseinfo_form").Validform({
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
</body>
</html>