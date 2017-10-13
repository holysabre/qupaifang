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
    <!-- 放大镜 -->
    <liNK rel=stylesheet type=text/css href="/qupaifang/Tpl/Home/Public/css/lanrenzhijia.css">
    <script type=text/javascript src="/qupaifang/Tpl/Home/Public/js/jquery.jqzoom.js"></script>
    <script type=text/javascript src="/qupaifang/Tpl/Home/Public/js/jquery.livequery.js"></script>
    <link rel="stylesheet" href="http://cache.amap.com/lbs/static/main1119.css"/>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=5dacabfc3bd5924cdb6373195dcf68a0&plugin=AMap.PlaceSearch"></script>
    <!-- 字体 -->
    <script type=text/javascript>
        $(function(){

            /* 鼠标移动小图，小图对应大图显示在大图上，并替换放大镜中的图*/
            $("#specList ul li img").livequery("mouseover",function(){ 
                var imgSrc = $(this).attr("src");
                var i = imgSrc.lastIndexOf(".");
                var unit = imgSrc.substring(i);
                imgSrc = imgSrc.substring(0,i);
                var imgSrc_small = $(this).attr("src_D");
                var imgSrc_big = $(this).attr("src_H");
                $("#bigImg").attr({"src": imgSrc_small ,"jqimg": imgSrc_big });
                $(this).css({"border":"2px solid #3399cc","padding":"1px"});
            });

            $("#specList ul li img").livequery("mouseout",function(){ 
                $(this).css({"border":"1px solid #ddd","padding":"2px"});
            });

    //使用jqzoom
    // $(".jqzoom").jqueryzoom({
    //     xzoom: 300, //放大图的宽度(默认是 200)
    //     yzoom: 300, //放大图的高度(默认是 200)
    //     offset: 10, //离原图的距离(默认是 10)
    //     position: "right", //放大图的定位(默认是 "right")
    //     preload:1   
    // });
    
    /*如果小图过多，则出现滚动条在一行展示*/
    var btnNext = $('#specRight');
    var btnPrev = $('#specLeft')
    var ul = btnPrev.next().find('ul');

    var len = ul.find('li').length;
    var i = 0 ;
    if (len > 4) {
        $("#specRight").addClass("specRightF").removeClass("specRightT");
        ul.css("width", 106 * len)
        btnNext.click(function(e) {
            if(i>=len-4){

                return;
            }
            i++;
            if(i == len-4){
                $("#specRight").addClass("specRightT").removeClass("specRightF");
            }
            $("#specLeft").addClass("specLeftF").removeClass("specLeftT");
            moveS(i);
        })
        btnPrev.click(function(e) {
            if(i<=0){
                return;
            }
            i--;
            if(i==0){
                $("#specLeft").addClass("specLeftT").removeClass("specLeftF");
            }
            $("#specRight").addClass("specRightF").removeClass("specRightT");
            moveS(i);
        })
    }
    function moveS(i) {
        ul.animate({left:-106* i}, 500)
    }
    function picAuto(){
      if ($(".listImg li").size()<=4) {
        $("#specLeft,#specRight").hide();
    }
}
picAuto();
});
</script>
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
    <section class="price_side">
       <div class="price_brand">
          <i class="iconfont">&#xe603;</i>
          <a href="/qupaifang/">首页  > </a>
          <a href="<?php echo U('Subject/index');?>">二手房  >  </a>
          竞拍区
      </div>
      <?php echo 1507862599 - time() ?>
      <article class="price_maxpic_help">
          <div class="price_maxpic">
             <div class="price_maxpic_left">
                <h3>[去拍房]<?php echo ($info["title"]); ?></h3>
                <div class="price_maxpic_left_side">
                    <div id="preview">
                        <div class=jqzoom>
                            <img id=bigImg src="<?php echo (get_img($info["image"])); ?>" jqimg="<?php echo (get_img($info["image"])); ?>" width="450" height="335">
                        </div>
                        <div id=spec>
                            <div id=specLeft class="control specLeftT"></div>
                            <div id=specList>
                                <ul class=listImg>
                                    <?php if(is_array($info["album"])): $i = 0; $__LIST__ = $info["album"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                            <img id=smallPicOne src="<?php echo (get_img($vo["img"])); ?>" src_H="<?php echo (get_img($vo["img"])); ?>" src_D="<?php echo (get_img($vo["img"])); ?>">
                                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                </ul>
                            </div>
                            <div id=specRight class="control specRightT"></div>
                        </div>
                    </div>
                    <div class="hot_data">
                        <ul>
                            <!-- <li>
                                <span>11</span>人报名
                            </li>
                            <li>
                                <span>110</span>人设置提醒
                            </li> -->
                            <li>
                                <span><?php echo ($info["onlook"]); ?> </span>次围观
                            </li>
                        </ul>
                        <div class="clear"></div>
                    </div>
                    <div class="price_share">
                        <a href="javascript:;">
                          <i class="iconfont">&#xe636;</i>  分享给好友
                      </a>
                  </div>
                  <div class="price_share collect_icon">
                    <a href="javascript:;" class="<?php echo $info['is_collection']?'current':'';?>" data-status="<?php echo ($info["is_collection"]); ?>" onclick="collection(this,<?php echo ($info["id"]); ?>)">
                      <i class="iconfont">&#xe667;</i>  收藏
                  </a>
              </div>
              <!-- <div class="price_share collect_icon remind">
                <a href="javascript:;">
                    <i class="iconfont">&#xe62c;</i>  提醒
                </a>
            </div> -->
            <div class="clear"></div>
        </div>
        <div class="price_maxpic_right_side">
            <div class="pmrs_price">
                <p>
                    当前价<span id="current_price">0,000</span> <em>元</em>
                </p>
                <div class="office_peo">
                    出价人：<span></span>
                </div>
                <div class="endtime" id="endtime">距离结束 <span><b>0</b>天<b>00</b>时<b>00</b>分<b>00.0</b>秒</span></div>
                <div class="notice">
                    <div class="gw_num">
                        <button id="add" name="" type="button" value="+" onclick="addcutPrice(this,<?php echo ($info["increase_rate"]); ?>)" <?php echo empty($member)?'disabled':'';?>>+</button>
                        <input id="increase_price" name="increase_price" type="text" value="<?php echo ((isset($info["current_price"]) && ($info["current_price"] !== ""))?($info["current_price"]):$info['start_price']); ?>" <?php echo empty($member)?'readonly':'';?> />
                        <button id="cut" name="" type="button" value="-" onclick="addcutPrice(this,<?php echo ($info["increase_rate"]); ?>)" <?php echo empty($member)?'disabled':'';?>>-</button>
                    </div>
                    <?php if(($info["sale_type"] == 1) AND ($info["status"] != 3)): ?><a href="javascript:;" class="oneprice post_bond">一口拍</a>
                    <?php elseif(($info["sale_type"] == 2) AND ($info["is_bond"] == 1) AND ($info["status"] != 3)): ?>
                        <a href="javascript:;" class="oneprice" onclick="auction(<?php echo ($info["id"]); ?>)">竞拍</a>
                    <?php elseif($info["status"] != 3): ?>
                        <a href="javascript:;" class="oneprice post_bond">报名交保证金</a>
                    <?php else: ?>
                        <a href="javascript:;" class="oneprice end">已结束</a><?php endif; ?>
                    <div class="tipic">
                     <a href="">
                         <i class="iconfont">&#xe613;</i>购买须知
                     </a>
                 </div>
                 <div class="clear"></div>
                 <div class="tishidown tishidown2">
                     <?php if(empty($member)): ?><p>提醒：先报名教保证金再出价。如果您已经交付保证金，请先<a href="javascript:;" class="detail_login">登录</a></p><?php endif; ?>
                 </div>
             </div>
             <div class="deposit">
                 <ul>
                    <li>
                        <?php if($info["sale_type"] == 2): ?><p>起 拍 价 : ¥<?php echo (number_format($info["start_price"])); ?></p><?php endif; ?>
                        <p>保 证 金 : ¥<?php echo (number_format($info["bond"])); ?></p>
                        <p>评 估 价 : ¥<?php echo (number_format($info["evaluate_price"])); ?></p>
                    </li>
                    <?php if($info["sale_type"] == 2): ?><li>
                            <p>加价幅度 : ¥<?php echo (number_format($info["increase_rate"])); ?></p>
                            <p>竞价周期 : 1天</p>
                            <p>延时周期 : <?php echo ($info["delay_period"]); ?>分钟/次</p>
                        </li><?php endif; ?>
                </ul>
                <div class="clear"></div>         
            </div>
            <div class="grade">
             <div class="grade_left">
                 <span>房产综合评级</span>
                 <?php for($i = 0;$i<$info['rate'];$i++){ echo '<img src="/qupaifang/Tpl/Home/Public/images/guan.jpg" alt="">'; } ?>
             </div>
             <div class="grade_right">
                 <a href="">
                     担保交易  
                 </a>
                 <a href="">
                     实名认证
                 </a>
                 <div class="clear"></div>
             </div>
             <div class="clear"></div>
         </div>

     </div>
 </div>
 <div class="clear"></div>
</div>

</div>
<div class="price_right">
    <div class="price_right_side">
        <div class="price_right_side_tit">
            <i class="iconfont">&#xe615;</i>竞买帮助
            <span>></span>
            <div class="clear"></div>
        </div>
        <div class="price_right_side_list">
            <a href="">
                <em>竞拍</em><span>如何参加拍卖（视频）</span>
                <div class="clear"></div>
            </a>
            <a href="">
                <em>交保</em><span>如何缴纳保证金</span><div class="clear"></div>
            </a>
            <a href="">
                <em>交保</em><span>拍卖开始后可以交保</span><div class="clear"></div>
            </a>
            <a href="">
                <em>交保</em><span>拍卖开始后可以交保</span><div class="clear"></div>
            </a>
        </div>
        <div class="price_right_side_tit price_right_side_tit2">
            <i class="iconfont">&#xe640;</i>资产交易服务
            <span>></span>
            <div class="clear"></div>
        </div>
        <div class="price_right_side_list price_right_side_list2">
            <ul>
                <li>
                    <a href="">
                        <i class="iconfont">&#xe64e;</i>实地看样
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="iconfont">&#xe6a2;</i>过户办证
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="iconfont">&#xe6ef;</i>金融服务
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="iconfont">&#xe616;</i>拍卖咨询
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="iconfont">&#xe686;</i>交易保障
                    </a>
                </li>
            </ul>
            <div class="clear"></div>
        </div>
        <div class="price_right_side_tit price_right_side_tit2">
            <i class="iconfont">&#xe640;</i>去拍房客服中心
            <span>></span>
            <div class="clear"></div>
        </div>
        <div class="price_right_side_list price_right_side_list2 price_right_side_list3">
            <span>工作时间：</span>
            <p>周一至周日：8：00-24：00</p>
            <a href="">卖方留言</a>
            <a href="">联系客服</a>
            <div class="clear"></div>
        </div>
        <div class="ewm2">
            <span>扫码出价：</span><img src="/qupaifang/Tpl/Home/Public/images/ewm2.jpg" alt="">
            <div class="clear"></div>
        </div>
    </div>
</div>
<div class="clear"></div>
</article>
<aside class="price_side_info">
    <div class="price_side_info_tit">
        <a href="javascript:;" class="price_tit_sub">
            基本情况
        </a>
        <a href="javascript:;">
            标的展示
        </a>
        <a href="javascript:;">
            地理位置
        </a>
        <a href="javascript:;">
            竞买记录<span id="bid_log_count">（0）</span>
        </a>
        <div class="clear"></div>
    </div>
    <div class="price_side_info_list">
        <div class="price_side_info_list_div current">
            <div class="psils_tit">
                竞买公告
            </div>
            <div class="psils_info">
                <?php echo (get_htmlcode($info["notice"])); ?>
            </div>
        </div>
        <div class="price_side_info_list_div">
            <div class="psils_tit">
                标的物介绍
            </div>
            <div class="psils_info">
                <?php echo (get_htmlcode($info["introduction"])); ?>
            </div>
        </div>
        <div class="price_side_info_list_div">
            <div class="detail_map" id="map"></div>
        </div>
        <div class="price_side_info_list_div">
            <div class="psils_tit">
                竞买记录
            </div>
            <div class="psils_info psils_info2" id="bid_log">
                <table width="800" border="1">
                  <!-- <tr>
                    <td width="134"><div align="center"><strong>状态</strong></div></td>
                    <td width="184"><div align="center"><strong>竞买号</strong></div></td>
                    <td width="196"><div align="center"><strong>价格</strong></div></td>
                    <td width="258"><div align="center"><strong>时间</strong></div></td>
                </tr>
                <tr class="child_info">
                    <td><div align="center" class="child_info_sub"><span>领先</span></div></td>
                    <td><div align="center">K6678</div></td>
                    <td><div align="center">690,000</div></td>
                    <td><div align="center">2017年06月12日 14:03:15</div></td>
                </tr> -->
            </table>

        </div>
    </div>
</div>
</aside>
</section>

<section class="sign_in subject_login">
    <div class="sign_in_center">
        <h3>会员登陆</h3>
        <div class="sign_in_center_line">
            <form action="<?php echo U('Member/login');?>" method="post" class="detail_login">
                <ul>
                    <li>
                        <i class="iconfont">&#xe62a;</i>
                        <input name="username" type="text" placeholder="请输入您的帐号" />
                        <div class="clear"></div>
                    </li>
                    <li>
                        <i class="iconfont">&#xe6d1;</i>
                        <input name="password" type="password" placeholder="请输入您的密码" />
                        <div class="clear"></div>
                    </li>
                    <li class="condein">
                        <i class="iconfont">&#xe6e6;</i>
                        <input name="verifycode" type="text" placeholder="请输入右侧验证码" />
                        <div class="code">
                            <img src="<?php echo U('verify',array('verifyid'=>'login'));?>" class="verify_img" onclick="reloadVerify('.verify_img')">
                            <a href="javascript:;" onclick="reloadVerify('.verify_img')">
                                看不清
                            </a>
                        </div>
                        <div class="clear"></div>
                    </li>
                </ul>
                <div class="button_in">
                    <button type="submit">登陆</button>
                    <button type="reset" class="button2">取消</button>
                    <div class="clear"></div>
                </div>
            </form>
            <p class="tip"><span>提示：</span>如果您还没有账号，<a href="javascript:;" class="detail_reg">请先注册！</a></p>
        </div>
        <div class="close">
            <i class="iconfont">&#xe62b;</i>
        </div>
    </div>
</section>
<section class="sign_in payment">
    <div class="sign_in_center payment_center">
        <form action="<?php echo U('Subject/post_bond');?>" method="post" class="pay_form">
            <h2>确认支付保证金</h2>
            <div class="sign_in_center_line payment">
              <h4><?php echo (number_format($info["bond"])); ?></h4>
              <div class="payment_mode">
                <span>支付方式</span>
                <em>余额支付</em>
                <div class="clear"></div>
            </div>
            <div class="pay_code">
                <p>输入支付密码</p>
                <input type="password" name="pay_password"/>
                <input type="hidden" name="s_id" value="<?php echo ($info["id"]); ?>">
                <button type="submit">确认支付</button>
            </div>
        </div>
    </form>
    <div class="close">
      <i class="iconfont">&#xe62b;</i>
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
<script>
    var subject_url = "<?php echo U('Subject/turnUrl');?>";
    var s_id = "<?php echo ($info["id"]); ?>";
    var subject_status = "<?php echo ($info["status"]); ?>";
</script>
<script src="/qupaifang/Tpl/Home/Public/js/subject.js"></script>
<script>
    //重新获取验证码
    function reloadVerify(obj) { 
        var src = "<?php echo U('verify',array('verifyid'=>'login'));?>?temp="+Math.floor(Math.random() * 100);
        $(obj).attr('src', src).fadeIn();
    }
</script>
<script type="text/javascript">
    $(function(){
        map.setLang("cn");
    })
    var map = new AMap.Map("map", {
        resizeEnable: true,
        zoom:15,
        center: [<?php echo ($info["longitude"]); ?>,<?php echo ($info["latitude"]); ?>] ,
    });
    var placeSearch = new AMap.PlaceSearch();  //构造地点查询类
    // 详情查询
    placeSearch.getDetails("B000A83U0P", function(status, result) {
        if (status === 'complete' && result.info === 'OK') {
            placeSearch_CallBack(result);
        }
    });
    var infoWindow = new AMap.InfoWindow({
        autoMove: true,
        offset: {x: 0, y: -30}
    });
    // 回调函数
    function placeSearch_CallBack(data) {
        var poiArr = data.poiList.pois;
        //添加marker
        var marker = new AMap.Marker({
            map: map,
            position: [<?php echo ($info["longitude"]); ?>,<?php echo ($info["latitude"]); ?>],
        });
        map.setCenter(marker.getPosition()); 
        infoWindow.setContent(createContent(poiArr[0]));
        infoWindow.open(map, marker.getPosition());
    }

    function createContent(poi) {  //信息窗体内容
        //构建信息窗体中显示的内容
        var info = [];
        info.push("<div><div><img style=\"float:left;\" src=\"http://webapi.amap.com/images/autonavi.png\"/></div> ");
        info.push("<div style=\"padding:0;line-height:25px\"><b><?php echo ($info["position_title"]); ?></b>");
        return info.join("<br/>"); //使用默认信息窗体框样式，显示信息内容
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