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

<section class="news_side home_side">
	<div class="news_side_list">
		<div class="transaction_info">
			<div class="transaction_info_pic">
				<img src="/qupaifang/Tpl/Home/Public/images/home_ban.jpg" alt="">
			</div>
			<div class="transaction_info_option">
				<div class="transaction_i_o_top">
					<img src="/qupaifang/Tpl/Home/Public/images/transaction_i_o_top.jpg" alt="">
				</div>
				<div class="transaction_i_o_bottom">
					<div class="transaction_i_o_b_tit">
						帮助中心
						<a href="">更多></a> 
						<div class="clear"></div>
					</div>
					<div class="transaction_i_o_b_list">
						<ul>
							<?php $help = getPageList(array('pid'=>1)); ?>
							<?php if(is_array($help)): $i = 0; $__LIST__ = $help;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li <?php echo $vo['recommend'] == 1?'class="list_choo"':'';?>>
									<a href="<?php echo U('Page/index',array('id'=>$vo['id']));?>">
										<span><?php echo ($vo["tag"]); ?></span><em><?php echo ($vo["title"]); ?></em>
									</a>
									<div class="clear"></div>
								</li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
						<div class="clear"></div>
					</div>
					<div class="service_cos">
						<a href="">
							客服专线
						</a>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<article class="news_side_list_left  home_auction">
			<div class="auction_tit">
				<div class="auction_t_left">
					正在<span>竞拍</span>
				</div>
				<div class="auction_tit_num">
					<span>1</span>
					<span>8</span>
					<span>8</span>
					<span>8</span>
					<span>8</span>
					<span>8</span>
					<span>8</span>
					<em>次围观</em>
				</div>
				<div class="clear"></div>
			</div>
			<a href="" class="more_num">
				更多
				<span>888 </span>
				件 >
			</a>
			<div class="clear"></div>
			<div class="home_auction_list">
				<ul class="now_list" data-tital="">
					
				</ul>
				<div class="clear"></div>
			</div>
		</article>
		<?php $c_name = CONTROLLER_NAME; ?>
<aside class="news_right_side <?php echo $c_name='Subject'?'news_right_side2':'';?>">
	<div class="valuation_num">
		<h3>8,935,992</h3>
		<p>TA们在去拍房成功买卖</p>
		<form action="<?php echo U('Evaluation/index');?>" method="post" class="evaluation_form">
		<input name="mobile" type="text" value="请输入您的手机号码"onfocus="if (value =='请输入您的手机号码'){value =''}"onblur="if (value ==''){value='请输入您的手机号码'}"/>
		<button type="submit">免费估价</button>
		</form>
	</div>
	<div class="deal_list">
		<div class="deal_list_tit">
			<i class="iconfont">&#xe62e;</i>
			<span>最新成交</span>
		</div>
		<ul>
			<?php $newsest_deal = D('Subject')->getDealList(); ?>
			<?php if(is_array($newsest_deal)): $i = 0; $__LIST__ = array_slice($newsest_deal,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
					<a href="<?php echo U('Subject/detail',array('id'=>$vo['id']));?>">
						<figure>
							<img src="<?php echo (get_img($vo["image"])); ?>" alt="">
							<figcaption>
								<h3><?php echo ($vo["title"]); ?></h3>
								<p><?php echo ($vo["building_area"]); ?>平方米  / <?php echo ($vo["building_address"]); ?>  /  <?php echo ($vo["onlook"]); ?>次围观</p>
								<span><?php echo (date("Y.m.d",$vo["time"])); ?>成交</span>
								<em><?php echo (money_to_wan($vo["deal_price"])); ?>万</em>
								<div class="clear"></div>
							</figcaption>
						</figure>
					</a>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
	<?php if(!$c_name): ?><div class="advertising_mould">
			<img src="/qupaifang/Tpl/Home/Public/images/advertising.jpg" alt="">
			<div class="advan_text">
				广告
			</div>
		</div><?php endif; ?>
	<div class="recommend">
		<div class="deal_list_tit recommend_tit">
			<i class="iconfont">&#xe62e;</i>
			<span>热门推荐</span>
		</div>
		<div class="recommend_list">
			<ul>
				<?php $news = D('Article')->getLimitList(array('catid'=>1,'status'=>1,'limit'=>2)); ?>
				<?php if(is_array($news)): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
					<a href="<?php echo U('Article/detail',array('id'=>$vo['id']));?>">
						<div class="recommend_pic">
							<img src="<?php echo (get_img($vo["img"])); ?>" alt="">
							<div class="recommend_pic_num"><?php echo ($i); ?></div>
						</div>
						<div class="recommend_text">
							<div class="recommend_text_t">
								<p>
									<span><?php echo substr($vo['cate_title'],0,6);?></span>
									<?php echo ($vo["title"]); ?>
								</p>
								<div class="clear"></div>
							</div>
							<div class="recommend_text_b">
								<?php echo ($vo["addtime"]); ?>
							</div>
						</div>
						<div class="clear"></div>
					</a>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>
		</div>
	</div>
</aside>
		<div class="clear"></div>

		<div class="shooting_side">
			<h3><span>即将</span>开拍</h3>
			<div class="shooting_modular">
				<div class="shooting_modular_point">
					<div class="point2">
						
					</div>
				</div>
				<div class="shooting_prompt">
					明天开拍
				</div>
				<div class="home_auction_list_tit">
					<p>
						<b>明天</b>
						6月10日
					</p>
					<a href="">
						更多 <em>888</em> 件 >
					</a>
					<div class="clear"></div>
				</div>
				<ul class="tomorrow_list">
					
				</ul>
				<div class="clear"></div>
			</div>
			
			<div class="shooting_modular">
				<div class="shooting_modular_point">
					<div class="point2 point3">
						
					</div>
				</div>
				<div class="shooting_prompt shooting_prompt2">
					明天开拍
				</div>
				<div class="home_auction_list_tit home_auction_list_tit2">
					<p>
						<b>明天</b>
						6月11日
					</p>
					<a href="">
						更多 <em>888</em> 件 >
					</a>
					<div class="clear"></div>
				</div>
				<ul class="tomorrow2_list" data-total="">
					
				</ul>
				<div class="clear"></div>
			</div>
		</div>

		<div class="ashooting_side_end">
			<div class="ashooting_side_end_tit">
				<h3><span>竞拍</span>已结束</h3>
				<a href="">更多 888 件 ></a>
				<div class="clear"></div>
			</div>
			<div class="shooting_modular ashooting_side_end_list">
				<ul class="end_list" data-total="">
					
				</ul>
				<div class="clear"></div>
			</div>
		</div>

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
<script id="storyTemplate" type="text/html">
    {{each list as value key}}
    <li>
		<a href="{{value.linkurl}}">
			<figure>
				<img src="{{value.image}}" alt="">
				<figcaption>
					<div class="shelves_info home_auction_list_info">
						<h4>{{value.title}}</h4>
						<p><span>当前价</span><b>¥ {{value.current_price}}万</b></p>
						<p><span>评估价</span>  ¥{{value.evaluate_price}} 万 &nbsp;&nbsp;&nbsp;&nbsp; <span>出价数</span>{{value.bid_count}}次</p>
						<p><span>预 计</span>  <em>{{value.endtime_yearmonth}}</em><em>{{value.endtime_time}}</em>结束</p>
					</div>
					<div class="hali_num">
						<dl>
							<dd>
								<span>{{value.onlook}}</span>次围观
							</dd>
							<dd>
								<span>{{value.bond_count}}</span>次报名
							</dd>
							<div class="clear"></div>
						</dl>
					</div>
			</figure>
		</a>
		<div class="home_auction_list_move">
			{{if value.sale_type == 1}}
			<div class="col_t_l col_t_left2">
				<i  class="iconfont">&#xe79b;</i>一口价
			</div>
			{{/if}}
			<div class="collect_auction {{value.is_collection?'current':''}}" data-status="{{value.is_collection}}" onclick="collection(this,{{value.id}})">
				<i class="iconfont">&#xe604;</i>
			</div>
			<div class="clear"></div>
		</div>
		<div class="conducts_tip conducts_tip2">
			{{if value.status == 1}}
				<img src="/qupaifang/Tpl/Home/Public/images/soon.png" alt="">
			{{/if}}
			{{if value.status == 2}}
				<img src="/qupaifang/Tpl/Home/Public/images/conduct.png" alt="">
			{{/if}}
			{{if value.status == 3}}
				<img src="/qupaifang/Tpl/Home/Public/images/over.png" alt="">
			{{/if}}
		</div>
	</li>
    {{/each}}
</script>
<script type="text/javascript">
    var ajax_url = "<?php echo U('Subject/ajax_list');?>";
    loadMore("status:2","now_list");
    loadMore("status:1,start_time:tomorrow","tomorrow_list");
    loadMore("status:1,start_time:tomorrow2","tomorrow2_list");
    loadMore("status:3","end_list");
    function loadMore(data,classname){
    	$.get(ajax_url,{ajax:data},function(result){
    		//console.log(result.data);
    		var count = $("."+classname).data('total',result.data.count);
    		if(result.data.list){
    			$("."+classname).append(template("storyTemplate", {
                    list: result.data.list
                }));
    		}
    	},'json')
    }
    //收藏
	function collection(obj,s_id){
	    var status = $(obj).data('status');
	    console.log(status);
	    $.get("<?php echo U('Subject/turnUrl');?>",{
	        action:'collection',
	        s_id:s_id,
	        status:status
	    },function(result){
	        console.log(result);
	        if(result.status == 1){
	            layer.msg(result.msg,{icon:6},function(){
	                if(status == 0){
	                    $(obj).addClass('current').data('status',1);
	                }else{
	                    $(obj).removeClass('current').data('status',0);
	                }
	            });
	        }else if(result.status == 2){
	        	layer.msg(result.msg,{icon:5},function(){
	        		$('.sign_side3').fadeIn();
	        	});
	    	}else{
	            layer.msg(result.msg,{icon:5});
	        }
	    },'json');
	}
</script>
</body>
</html>