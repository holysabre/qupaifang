<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
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
			上架标的
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
				<div class="basic_info_side shelves">
					<ul>
						<?php if(is_array($List)): $i = 0; $__LIST__ = $List;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
								<div class="shelves_pic">
									<div class="shelves_pic_maxpic">
										<img src="<?php echo (get_img($vo["image"])); ?>" alt="">
									</div>
									<?php if($vo["sale_type"] == 1): ?><div class="col_t_l she_aprice">
											<i  class="iconfont">&#xe79b;</i>一口价
										</div><?php endif; ?>
									<div class="conducts_tip she_atip">
										<?php switch($vo["status"]): case "1": ?><img src="/qupaifang/Tpl/Home/Public/images/soon.png" alt=""><?php break;?>
											<?php case "2": ?><img src="/qupaifang/Tpl/Home/Public/images/conduct.png" alt=""><?php break;?>
											<?php case "3": ?><img src="/qupaifang/Tpl/Home/Public/images/over.png" alt=""><?php break; endswitch;?>
									</div>
								</div>
								<div class="shelves_info">
									<h4><?php echo ($vo["title"]); ?></h4>
									<p><span>当前价</span><b> <?php echo $vo['current_price']?'¥'.number_format($vo['current_price']):'¥'.number_format($vo['evaluate_price']);?></b></p>
									<p><span>评估价</span><?php echo $vo['evaluate_price']?'¥'.number_format($vo['evaluate_price']):尚未评估;?></p>
									<p><span>预 计</span>  <em><?php echo (date("Y-m-d H:i:s",$vo["end_time"])); ?></em>结束</p>
									<a href="<?php echo U('Member/show_sell',array('id'=>$vo['id']));?>">查看详情</a>
									<a href="javascript:;" data-url="<?php echo U('Member/sell2',array('id'=>$vo['id'],'action'=>'edit'));?>" onclick="if_edit(this,<?php echo ($vo["shelves"]); ?>,<?php echo ($vo["status"]); ?>)">修改信息</a>
									<?php if($vo["shelves"] == 1): ?><a href="javascript:;" onclick="shelves(this,'<?php echo U('Member/change_shelves');?>',<?php echo ($vo["id"]); ?>,'shelves',0)" class="more" onmouseover="showTip(this,'提示：点击下架标的')">已上架</a>
										<?php else: ?>
										<a href="javascript:;" onclick="shelves(this,'<?php echo U('Member/change_shelves');?>',<?php echo ($vo["id"]); ?>,'shelves',1)" onmouseover="showTip(this,'提示：点击上架标的')">上架标的</a><?php endif; ?>
									<a href="javascript:;" onclick="delete_subject(this,'<?php echo U('Member/delete_subject',array('id'=>$vo['id']));?>')">删除标的</a>
									<a href="javascript:;" onclick="read_contract('<?php echo U('Contract/bid_contract',array('id'=>$vo['id'],'action'=>'read'));?>')">查看合同</a>
									<div class="state">
										<?php switch($vo["examine"]): case "0": ?><img src="/qupaifang/Tpl/Home/Public/images/notpass.png" alt=""><?php break;?>
											<?php case "1": ?><img src="/qupaifang/Tpl/Home/Public/images/pass.png" alt=""><?php break;?>
											<?php case "2": ?><img src="/qupaifang/Tpl/Home/Public/images/examine.png" alt=""><?php break; endswitch;?>
									</div>
								</div>
								<div class="clear"></div>
							</li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
					<div class="pageNav"><?php echo ($Page); ?></div>
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
	<script type="text/javascript" src="/qupaifang/Tpl/Home/Public/js/member.js"></script>
</body>
</html>