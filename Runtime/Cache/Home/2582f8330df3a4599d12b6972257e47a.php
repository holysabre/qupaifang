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
		<a href="">首页</a> <i class="iconfont">&#xe60d;</i>
		<a href="">我的账户</a><i class="iconfont">&#xe60d;</i>
		<a href="">个人资料</a><i class="iconfont">&#xe60d;</i>
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
					<li>
						<a href="<?php echo U('Member/sell');?>">
							我要出售
						</a>
					</li>
					<li class="basic_sub">
						<a href="<?php echo U('Member/shelves');?>">
							标的列表
						</a>
					</li>
					<li>
						<a href="<?php echo U('Member/deal');?>">
							标的成交
						</a>
					</li>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="basic_info_side sell_side">
				<div class="obligee">
					<div class="obligee_base">
						<div class="obligee_base_tit">
							<h3>权利人基本情况</h3>
						</div>
						<div class="obligee_base_list">
							<ul>
								<li>
									<span>权利人类型：</span>
									<div class="obligee_info"><?php echo ($Info["owner_type"]); ?></div>
									<div class="clear"></div>
								</li>
								<li>
									<span>权利人：</span>
									<div class="obligee_info"><?php echo ($Info["owner_name"]); ?></div>
									<div class="clear"></div>
								</li>
								<li class="sf">
									<span>身份证号：</span>
									<div class="obligee_info"><?php echo ($Info["ID_number"]); ?></div>
									<div class="clear"></div>
								</li>
							</ul>
						</div>
					</div>
					<div class="obligee_base obligee_base2">
						<div class="obligee_base_tit">
							<h3>房屋基本情况</h3>
						</div>
						<div class="obligee_base2_list">
							<ul class="obligee_main" style="display: block;">
								<div class="obligee_title">主房</div>
								<li>
									<span>主房坐落：</span>
									<div class="obligee_info"><?php echo ($Info["building"]["obligee_main"]["province"]); ?> <?php echo ($Info["building"]["obligee_main"]["city"]); ?> <?php echo ($Info["building"]["obligee_main"]["area"]); ?> <?php echo ($Info["building"]["obligee_main"]["address"]); ?></div>
									<div class="clear"></div>
								</li>
								<li>
									<span><?php echo ($Info["building"]["obligee_main"]["certificates_type"]); ?>：</span>
									<div class="obligee_info"><?php echo ($Info["building"]["obligee_main"]["certificates_number"]); ?></div>
									<div class="clear"></div>
								</li>
								<li class="obligee_main_image">
									<?php $images = unserialize($Info['building']['obligee_main']['certificates_image']); ?>
									<?php if(is_array($images)): $i = 0; $__LIST__ = $images;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="certificates">
											<img src="<?php echo (get_img($vo["img"])); ?>" alt="">
										</div><?php endforeach; endif; else: echo "" ;endif; ?>
								</li>
								<div class="clear"></div>
							</ul>
							<ul class="obligee_subsidiary">
								<div class="obligee_title">附属房</div>
								<li>
									<span>附属房坐落：</span>
									<div class="obligee_info"><?php echo ($Info["building"]["obligee_subsidiary"]["province"]); ?> <?php echo ($Info["building"]["obligee_subsidiary"]["city"]); ?> <?php echo ($Info["building"]["obligee_subsidiary"]["area"]); ?> <?php echo ($Info["building"]["obligee_subsidiary"]["address"]); ?></div>
									<div class="clear"></div>
								</li>
								<li>
									<span><?php echo ($Info["building"]["obligee_subsidiary"]["certificates_type"]); ?>：</span>
									<div class="obligee_info"><?php echo ($Info["building"]["obligee_subsidiary"]["certificates_number"]); ?></div>
									<div class="clear"></div>
								</li>
								<li class="obligee_subsidiary_image">
									<?php $images = unserialize($Info['building']['obligee_subsidiary']['certificates_image']); ?>
									<?php if(is_array($images)): $i = 0; $__LIST__ = $images;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="certificates">
											<img src="<?php echo (get_img($vo["img"])); ?>" alt="">
										</div><?php endforeach; endif; else: echo "" ;endif; ?>
								</li>
								<div class="clear"></div>
							</ul>
							<ul class="obligee_subsidiary">
								<div class="obligee_title">附属房</div>
								<li>
									<span>附属房坐落：</span>
									<div class="obligee_info"><?php echo ($Info["building"]["obligee_subsidiary"]["province"]); ?> <?php echo ($Info["building"]["obligee_subsidiary"]["city"]); ?> <?php echo ($Info["building"]["obligee_subsidiary"]["area"]); ?> <?php echo ($Info["building"]["obligee_subsidiary"]["address"]); ?></div>
									<div class="clear"></div>
								</li>
								<li>
									<span><?php echo ($Info["building"]["obligee_subsidiary"]["certificates_type"]); ?>：</span>
									<div class="obligee_info"><?php echo ($Info["building"]["obligee_subsidiary"]["certificates_number"]); ?></div>
									<div class="clear"></div>
								</li>
								<li class="obligee_subsidiary_image">
									<?php $images = unserialize($Info['building']['obligee_subsidiary']['certificates_image']); ?>
									<?php if(is_array($images)): $i = 0; $__LIST__ = $images;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="certificates">
											<img src="<?php echo (get_img($vo["img"])); ?>" alt="">
										</div><?php endforeach; endif; else: echo "" ;endif; ?>
								</li>
								<div class="clear"></div>
							</ul>
							
						</div>
					</div>
					<div class="obligee_base obligee_base3">
						<div class="obligee_base_tit">
							<h3>房地产状况</h3>
						</div>
						<div class="obligee_base_list obligee_base3_list">
							<ul>
								<li>
									<span>总层：</span>
									<div class="obligee_info"><?php echo ($Info["total_floor"]); ?></div>
								</li>
								<li>
									<span>所在层：</span>
									<div class="obligee_info"><?php echo ($Info["seat_floor"]); ?></div>
								</li>
								<li>
									<span>建筑面积：</span>
									<div class="obligee_info"><?php echo ($Info["building_area"]); ?></div>
								</li>
								<li>
									<span>不动产性质：</span>
									<div class="obligee_info"><?php echo ($Info["property_nature"]); ?></div>
								</li>
								<li>
									<span>房屋性质：</span>
									<div class="obligee_info"><?php echo ($Info["building_nature"]); ?></div>
								</li>
								<li>
									<span>土地性质：</span>
									<div class="obligee_info"><?php echo ($Info["land_nature"]); ?></div>
								</li>
							</ul>
						</div>
					</div>
					<div class="obligee_base obligee_base4">
						<div class="obligee_base_tit">
							<h3>出售房地产的方式</h3>
						</div>
						<div class="obligee_info"><?php echo $Info['sale_type']==1?'一口价方式拍售':'竞价方式出售';?></div>
					</div>
					<div class="obligee_base obligee_base5">
						<div class="obligee_base_tit">
							<h3>出售价格</h3>
						</div>
						<div class="obligee_base_list obligee_base5_list">
							 <ul>
							 	<li>
							 		<span>起售价：</span>
							 		<div class="obligee_info"><?php echo (number_format($Info["start_price"])); ?></div>
							 		<div class="obligee_info"><?php echo ($Info["start_price_capital"]); ?></div>
							 	</li>
							 </ul>
						</div>
					</div>
					<div class="obligee_base obligee_base6">
						<div class="obligee_base_tit">
							<h3>保证金/定金</h3>
						</div>
						<div class="obligee_base_list obligee_base6_list">
							 <ul>
							 	<li>
							 		<span>保证金或定金：</span>
							 		<div class="obligee_info"><?php echo ($Info["bond_rate"]); ?></div>
							 		<div class="obligee_info"><?php echo (number_format($Info["bond"])); ?></div>
							 	</li>
							 </ul>
						</div>
					</div>
					<div class="obligee_base obligee_base6 increase_rate" <?php echo $Info['sale_type']==2?'style="display:block"':'';?>>
						<div class="obligee_base_tit">
							<h3>出售人以竞价方式进行出售</h3>
						</div>
						<div class="obligee_info"><?php echo (number_format($Info["increase_rate"])); ?></div>
					</div>
					<div class="obligee_base obligee_base7">
						<div class="obligee_base_tit">
							<h3>交易成功收款方式</h3>
						</div>
						<div class="obligee_base_list obligee_base3_list obligee_base7_list">
							<div class="obligee_base7_choose ">
								<?php echo $Info.payment_method==1?'购买人以全额方式支付购房款':'购买方以分期方式支付购房款（首付20%-60%，尾款由银行贷款支付）';?>
							</div>
							<ul class="installment_payment" <?php echo $Info['payment_method']==2?'style="display:block"':'';?>>
								<li>
									<span>收款方式：</span>
									<div class="obligee_info"><?php echo ($Info["downpayment_percentage"]); ?></div>
									<div class="obligee_info"><?php echo (number_format($Info["downpayment"])); ?></div>
									<div class="clear"></div>
								</li>
							</ul>
						</div>
					</div>
					<div class="obligee_base obligee_base6">
						<div class="obligee_base_tit">
							<h3>出售期限</h3>
						</div>
						<div class="obligee_base_list obligee_base6_list">
							<div>
								起始时间：<?php echo (date("Y-m-d H:i:s",$Info["start_time"])); ?>
							</div>
							<br>
							<div>
								结束时间：<?php echo (date("Y-m-d H:i:s",$Info["end_time"])); ?>
							</div>
						</div>
					</div>
					<div class="obligee_base obligee_base8">
						<div class="obligee_base_tit">
							<h3>标的展示</h3>
						</div>
						<div class="obligee_base_list obligee_base8_list album_image">
							<?php $pos = explode(',',$Config['web_building_position']['value']); ?>
							<?php if(is_array($Info["album"])): $i = 0; $__LIST__ = $Info["album"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="certificates">
									<img src="<?php echo (get_img($vo["img"])); ?>" alt="">
									<select name="pos" id="">
										<?php if(is_array($pos)): $i = 0; $__LIST__ = $pos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$po): $mod = ($i % 2 );++$i; $p = explode(':',$po); ?>
											<option value="<?php echo ($p[1]); ?>" <?php echo $p[1]==$vo['pos']?'selected':'';?>><?php echo ($p[1]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
									</select>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="obligee_base obligee_base8">
						<div class="obligee_base_tit">
							<h3>上传视频</h3>
						</div>
						<div class="obligee_base_list obligee_base8_list">
							<div class="certificates certificates2">
								<img src="/qupaifang/Tpl/Home/Public/images/certificates.png" alt="">
							</div>
							<div class="share_add">
								<textarea name="video" placeholder="分享地址"><?php echo ($Info["video"]); ?></textarea>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<div class="obligee_base obligee_base9">
						<div class="obligee_base_tit">
							<h3>标的物描述</h3>
						</div>
						<div class="obligee_ms">
							<?php echo (get_htmlcode($Info["content"])); ?>
						</div>
					</div>
				</div>
			</div>
		</article>
		<div class="clear"></div>
	</div>
</section>
<?php ?>
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
<script type="text/javascript" src="/qupaifang/Tpl/Home/Public/js/PCASClass.js"></script>
<script>
	layui.use(['laydate'], function(){

	})
	$(".sell2_form").Validform({
	    tiptype:function(msg,o,cssctl){
	        if (o.type == 3)
	        layer.msg(msg, {icon:7});
	    },
	    ajaxPost:true,
	    callback:function(result){
	    	console.log(result);
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
<script>
	form_selected("select","owner_type","<?php echo ($Info["owner_type"]); ?>");
	form_selected("select","obligee[obligee_main][certificates_type]","<?php echo ($Info["building"]["obligee_main"]["certificates_type"]); ?>");
	form_selected("select","obligee[obligee_subsidiary][certificates_type]","<?php echo ($Info["building"]["obligee_subsidiary"]["certificates_type"]); ?>");
	form_selected("select","obligee[obligee_garage][certificates_type]","<?php echo ($Info["building"]["obligee_garage"]["certificates_type"]); ?>");
	form_selected("select","property_nature","<?php echo ($Info["property_nature"]); ?>");
	form_selected("select","building_nature","<?php echo ($Info["building_nature"]); ?>");
	form_selected("select","land_nature","<?php echo ($Info["land_nature"]); ?>");
	form_selected("select","bond_rate","<?php echo ($Info["bond_rate"]); ?>");
	form_selected("select","increase_rate","<?php echo ($Info["increase_rate"]); ?>");
	form_selected("select","downpayment_percentage","<?php echo ($Info["downpayment_percentage"]); ?>");

	form_selected("checkbox","building_type","<?php echo ($Info["building_type"]); ?>");

	form_selected("radio","sale_type","<?php echo ($Info["sale_type"]); ?>");
	form_selected("radio","payment_method","<?php echo ($Info["payment_method"]); ?>");

	

	new PCAS("obligee[obligee_main][province]","obligee[obligee_main][city]","obligee[obligee_main][area]","<?php echo ((isset($Info["building"]["obligee_main"]["province"]) && ($Info["building"]["obligee_main"]["province"] !== ""))?($Info["building"]["obligee_main"]["province"]):'浙江省'); ?>","<?php echo ((isset($Info["building"]["obligee_main"]["city"]) && ($Info["building"]["obligee_main"]["city"] !== ""))?($Info["building"]["obligee_main"]["city"]):'台州市'); ?>","<?php echo ((isset($Info["building"]["obligee_main"]["area"]) && ($Info["building"]["obligee_main"]["area"] !== ""))?($Info["building"]["obligee_main"]["area"]):'椒江区'); ?>");
	new PCAS("obligee[obligee_subsidiary][province]","obligee[obligee_subsidiary][city]","obligee[obligee_subsidiary][area]","<?php echo ((isset($Info["building"]["obligee_subsidiary"]["province"]) && ($Info["building"]["obligee_subsidiary"]["province"] !== ""))?($Info["building"]["obligee_subsidiary"]["province"]):'浙江省'); ?>","<?php echo ((isset($Info["building"]["obligee_subsidiary"]["city"]) && ($Info["building"]["obligee_subsidiary"]["city"] !== ""))?($Info["building"]["obligee_subsidiary"]["city"]):'台州市'); ?>","<?php echo ((isset($Info["building"]["obligee_subsidiary"]["area"]) && ($Info["building"]["obligee_subsidiary"]["area"] !== ""))?($Info["building"]["obligee_subsidiary"]["area"]):'椒江区'); ?>");
	new PCAS("obligee[obligee_garage][province]","obligee[obligee_garage][city]","obligee[obligee_garage][area]","<?php echo ((isset($Info["building"]["obligee_garage"]["province"]) && ($Info["building"]["obligee_garage"]["province"] !== ""))?($Info["building"]["obligee_garage"]["province"]):'浙江省'); ?>","<?php echo ((isset($Info["building"]["obligee_garage"]["city"]) && ($Info["building"]["obligee_garage"]["city"] !== ""))?($Info["building"]["obligee_garage"]["city"]):'台州市'); ?>","<?php echo ((isset($Info["building"]["obligee_garage"]["area"]) && ($Info["building"]["obligee_garage"]["area"] !== ""))?($Info["building"]["obligee_garage"]["area"]):'椒江区'); ?>");
</script>
<script type="text/javascript" src="/qupaifang/Tpl/Home/Public/js/member.js"></script>
</body>
</html>