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
<section class="in_banner">
	<div class="in_banner_center">
		<div class="top_line">
			<div class="logo">
				<img src="/qupaifang/Tpl/Home/Public/images/logo.png" alt="">
			</div>
			<nav class="nav">
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
		<div class="auction">
			<div class="auction_t">
				<h3>去拍房</h3>
				<p>
					房地产直接买卖平台
				</p>
			</div>
			<div class="auction_b_style">
				<a href="">
					<p>新房</p>
					<span>进入大厅</span>
				</a>
				<a href="<?php echo U('Subject/index');?>">
					<p>二手房</p>
					<span>进入大厅</span>
				</a>
			</div>
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

<section class="in_auction_a">
	<div class="in_auction_a_tit">
		<div class="container">
			<div class="demo">
				<span class="counter">8,935,992</span>
			</div>
			<div class="in_auction_a_p">
				<p>TA们在去拍房成功买卖</p>
			</div>
		</div>
	</div>
	<div class="rollBox">
     <div class="LeftBotton" onmousedown="ISL_GoUp()" onmouseup="ISL_StopUp()" onmouseout="ISL_StopUp()"></div>
     <div class="Cont" id="ISL_Cont">
      <div class="ScrCont">
       <div id="List1">

        <!-- 图片列表 begin -->
        <?php $newsest_deal = D('Subject')->getDealList(); ?>
        <?php if(is_array($newsest_deal)): $i = 0; $__LIST__ = $newsest_deal;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="pic">
	          <a href="<?php echo U('Subject/index',array('id'=>$vo['id']));?>" target="_blank">
		          <figure>
		          		<img src="<?php echo (get_img($vo["image"])); ?>" />
		          		<figcaption>
		          			<h3><?php echo ($vo["title"]); ?></h3>
		          			<p><?php echo ($vo["building_area"]); ?>平方米  / <?php echo ($vo["building_address"]); ?>  /  <?php echo ($vo["onlook"]); ?>次围观</p>
		          			<em><?php echo (date("Y.m.d",$vo["time"])); ?> 成交</em>
		          			<span><?php echo (money_to_wan($vo["deal_price"])); ?>万</span>
		          			<div class="clear"></div>
		          		</figcaption>
		          </figure>
	          </a>
         </div><?php endforeach; endif; else: echo "" ;endif; ?>
        <!-- 图片列表 end -->
       </div>
       <div id="List2"></div>
      </div>
     </div>
     <div class="RightBotton" onmousedown="ISL_GoDown()" onmouseup="ISL_StopDown()" onmouseout="ISL_StopDown()"></div>
    </div>
    <a href="" class="more_link">
    	所有案例
    </a>
</section>

<section class="in_transaction_process">
	<div class="in_transaction_p_center">
		<ul>
			<li>
				<figure>
					<img src="/qupaifang/Tpl/Home/Public/images/icon1.jpg" alt="">
					<figcaption>
						<p>
							卖方免费估价
						</p>
						<span>为房主提供专业房地产估价师进行房地产估价</span>
					</figcaption>
				</figure>
			</li>
			<li>
				<figure>
					<img src="/qupaifang/Tpl/Home/Public/images/icon2.jpg" alt="">
					<figcaption>
						<p>
							买方免费询看
						</p>
						<span>为购房者提供专业经纪人进行询看</span>
					</figcaption>
				</figure>
			</li>
			<li>
				<figure>
					<img src="/qupaifang/Tpl/Home/Public/images/icon3.jpg" alt="">
					<figcaption>
						<p>
							双方直接交易
						</p>
						<span>双方在平台直接买卖，公平竞价，合同网上签订达成交易</span>
					</figcaption>
				</figure>
			</li>
			<li>
				<figure>
					<img src="/qupaifang/Tpl/Home/Public/images/icon4.jpg" alt="">
					<figcaption>
						<p>
							卖方免费估价
						</p>
						<span>门店完成过户、贷款等全程交割服务</span>
					</figcaption>
				</figure>
			</li>
		</ul>
		<div class="clear"></div>
		<div class="seller">
			<form action="<?php echo U('Evaluation/index');?>" method="post" class="evaluation_form">
			<input name="mobile" type="text" value="请输入您的手机号码"onfocus="if (value =='请输入您的手机号码'){value =''}"onblur="if (value ==''){value='请输入您的手机号码'}"/>
			<button type="submit">我要卖房</button>
			</form>
		</div>
	</div>
</section>

<section class="in_news">
	<div class="in_news_center">
		<div class="in_news_tit">
			<h3>房地产政策资讯</h3>
		</div>
		<div class="in_news_list">
			<ul>
				<?php $news = D('Article')->getLimitList(array('catid'=>1,'status'=>1,'limit'=>4)); ?>
				<?php if(is_array($news)): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
						<a href="">
							<div class="in_news_pic">
								<img src="<?php echo (get_img($vo["img"])); ?>" alt="">
							</div>
							<div class="in_news_side">
								<h3><?php echo ($vo["title"]); ?></h3>
								<p><?php echo ($vo["introduction"]); ?></p>
								<span><?php echo substr($vo['addtime'],0,10);?></span>
							</div>
							<div class="clear"></div>
						</a>
						<div class="in_news_l_share">
							<a href="javascript:;">
								<i class="iconfont">&#xe636;</i>
							</a>
						</div>
					</li><?php endforeach; endif; else: echo "" ;endif; ?>	
			</ul>
			<div class="clear"></div>
		</div>
		<a href="<?php echo U('Article/index',array('catid'=>1));?>" class="more_link">
	    	所有资讯
	    </a>
	</div>
</section>

<section class="in_convenient">
	<img src="/qupaifang/Tpl/Home/Public/images/convenient.jpg" alt="">
	<div class="in_c_center">
		<div class="in_c_center_pic">
			<img src="/qupaifang/Tpl/Home/Public/images/conven_pic.png" alt="">
		</div>
		<div class="in_c_center_r">
			<div class="in_c_center_tit">
				<h3>手机卖房更方便</h3>
				<p>
					轻松预约；进度实时跟踪；后续服务跟进
				</p>
			</div>
			<div class="ewm">
				<img src="/qupaifang/Tpl/Home/Public/images/ewm.jpg" alt="">
				<p>扫一扫</p>
				<p>关注微信公众号</p>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</section>

<section class="in_policy">
	<div class="in_policy_center">
		<div class="in_news_tit in_policy_tit">
			<h3>媒体报道</h3>
		</div>
		<div class="in_policy_list">
			<ul>
				<?php $news = D('Article')->getLimitList(array('catid'=>12,'status'=>1,'limit'=>3)); ?>
				<volist name="news" id="vo">
					<li>
						<a href="<?php echo U('Article/detail',array('id'=>$vo['id']));?>">
							<figure>
								<img src="<?php echo (get_img($vo["img"])); ?>" alt="">
								<figcaption>
									<h3><?php echo ($vo["title"]); ?></h3>		
									<p><?php echo ($vo["introduction"]); ?></p>
									<span><?php echo substr($vo['addtime'],0,10);?></span>
								</figcaption>
							</figure>
						</a>
						<div class="in_news_l_share">
							<a href="javascript:;">
								<i class="iconfont">&#xe636;</i>
							</a>
						</div>
					</li>
				<volist>
			</ul>
			<div class="clear"></div>
		</div>
		<a href="<?php echo U('Article/index',array('catid'=>12));?>" class="more_link">
	    	所有资讯
	    </a>
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

<!--数字滚动 -->
<script src="/qupaifang/Tpl/Home/Public/js/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="/qupaifang/Tpl/Home/Public/js/jquery.countup.min.js"></script>
<script type="text/javascript">
	$('.counter').countUp();
</script>
<!--数字滚动 -->

<!-- 滚动图 -->
<script>
<!--//--><![CDATA[//><!--
//图片滚动列表
var Speed = 1; //速度(毫秒)
var Space = 5; //每次移动(px)
var PageWidth = 1213; //翻页宽度
var fill = 0; //整体移位
var MoveLock = false;
var MoveTimeObj;
var Comp = 0;
var AutoPlayObj = null;
GetObj("List2").innerHTML = GetObj("List1").innerHTML;
GetObj('ISL_Cont').scrollLeft = fill;
GetObj("ISL_Cont").onmouseover = function(){clearInterval(AutoPlayObj);}
GetObj("ISL_Cont").onmouseout = function(){AutoPlay();}
AutoPlay();
function GetObj(objName){if(document.getElementById){return eval('document.getElementById("'+objName+'")')}else{return eval('document.all.'+objName)}}
function AutoPlay(){ //自动滚动
 clearInterval(AutoPlayObj);
 AutoPlayObj = setInterval('ISL_GoDown();ISL_StopDown();',3000); //间隔时间
}
function ISL_GoUp(){ //上翻开始
 if(MoveLock) return;
 clearInterval(AutoPlayObj);
 MoveLock = true;
 MoveTimeObj = setInterval('ISL_ScrUp();',Speed);
}
function ISL_StopUp(){ //上翻停止
 clearInterval(MoveTimeObj);
 if(GetObj('ISL_Cont').scrollLeft % PageWidth - fill != 0){
  Comp = fill - (GetObj('ISL_Cont').scrollLeft % PageWidth);
  CompScr();
 }else{
  MoveLock = false;
 }
 AutoPlay();
}
function ISL_ScrUp(){ //上翻动作
 if(GetObj('ISL_Cont').scrollLeft <= 0){GetObj('ISL_Cont').scrollLeft = GetObj('ISL_Cont').scrollLeft + GetObj('List1').offsetWidth}
 GetObj('ISL_Cont').scrollLeft -= Space ;
}
function ISL_GoDown(){ //下翻
 clearInterval(MoveTimeObj);
 if(MoveLock) return;
 clearInterval(AutoPlayObj);
 MoveLock = true;
 ISL_ScrDown();
 MoveTimeObj = setInterval('ISL_ScrDown()',Speed);
}
function ISL_StopDown(){ //下翻停止
 clearInterval(MoveTimeObj);
 if(GetObj('ISL_Cont').scrollLeft % PageWidth - fill != 0 ){
  Comp = PageWidth - GetObj('ISL_Cont').scrollLeft % PageWidth + fill;
  CompScr();
 }else{
  MoveLock = false;
 }
 AutoPlay();
}
function ISL_ScrDown(){ //下翻动作
 if(GetObj('ISL_Cont').scrollLeft >= GetObj('List1').scrollWidth){GetObj('ISL_Cont').scrollLeft = GetObj('ISL_Cont').scrollLeft - GetObj('List1').scrollWidth;}
 GetObj('ISL_Cont').scrollLeft += Space ;
}
function CompScr(){
 var num;
 if(Comp == 0){MoveLock = false;return;}
 if(Comp < 0){ //上翻
  if(Comp < -Space){
   Comp += Space;
   num = Space;
  }else{
   num = -Comp;
   Comp = 0;
  }
  GetObj('ISL_Cont').scrollLeft -= num;
  setTimeout('CompScr()',Speed);
 }else{ //下翻
  if(Comp > Space){
   Comp -= Space;
   num = Space;
  }else{
   num = Comp;
   Comp = 0;
  }
  GetObj('ISL_Cont').scrollLeft += num;
  setTimeout('CompScr()',Speed);
 }
}
//--><!]]>
</script>
<!--  -->
<!--add js-->
</body>
</html>