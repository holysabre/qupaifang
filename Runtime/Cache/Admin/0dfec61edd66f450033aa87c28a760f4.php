<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand"><!--读取IE最新渲染-->
<title><?php echo ($sitetitle); ?></title>
<link href="/qupaifang/Public/login/css/css.css" rel="stylesheet" type="text/css" />
<link href="/qupaifang/Public/login/css/comcss.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 9]>
<script language="javascript" type="text/javascript">
self.location='<?php echo U('login/browser');?>';
</script>
<![endif]-->
<!--[if IE 8]>
<script language="javascript" type="text/javascript">
self.location='<?php echo U('login/browser');?>';
</script>
<![endif]-->
<script type="text/javascript" src="/qupaifang/Public/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/qupaifang/Public/login/js/css3/selectivizr.js"></script>
<script type="text/javascript" src="/qupaifang/Public/login/js/three.min.js"></script>
<script type="text/javascript" src="/qupaifang/Public/login/js/memoryDesign.js"></script>
<script type="text/javascript" src="/qupaifang/Public/layer/layer.js"></script>
<script type="text/javascript" src="/qupaifang/Public/js/Validform_v5.3.2.js"></script>
</head>

<body class="home-body">
<div class="mask hide"></div>
<footer class="copyright">
	<p class="txt1">LEHUAN DATA SOLUTIONS</p>
	<p class="txt2"><a href="http://www.eglobe.cn" target="_blank">乐环科技</a> 版权所有. © 2016 .All Rightsreserved &nbsp;&nbsp; 乐环产品：&nbsp;<a href="http://www.eglobe.cn" target="_blank">企业官网定制</a>&nbsp;<a href="http://www.eglobe.cn" target="_blank">营销网站&优化</a>&nbsp;<a href="http://www.eglobe.cn" target="_blank">企业邮箱</a>&nbsp;<a href="http://www.eglobe.cn" target="_blank">微活动</a>&nbsp;<a href="http://www.eglobe.cn" target="_blank">公众号营销</a>
	</p>
</footer>

<div class="logo_font">
	<img src="/qupaifang/Public/login/images/login_03.png" alt="">
</div>
<div class="login">
	<div class="login_con">
    <h3>系统登录 | System Login </h3>
    <form action="<?php echo U();?>" method="post" id="form">
    <ul>
        <li><div><img src="/qupaifang/Public/login/images/login_icon14.png" alt=""></div><input type="text" value="用户名" onfocus="this.value=''" onfocusout="this.value=(this.value==''?'用户名':this.value)" name="username" datatype="s2-18" nullmsg="请输入账户" errormsg="输入的账户不正确" ></li>
        <li><div><img src="/qupaifang/Public/login/images/login_icon18.png" alt=""></div><input type="text" value="密码" onfocus="this.value='';this.type='password'" onfocusout="if(this.value==''){this.value='密码';this.type='text'}" name="password" datatype="s6-18" nullmsg="请输入密码" errormsg="输入的密码不正确"></li>
        <li style="border:none; background:none;"><input class="sdm code" type="text" value="验证码" onclick="this.value=''" onfocusout="this.value=(this.value==''?'验证码':this.value)" name="yzcode" maxlength="4" datatype="/^[\d]{4}$/" nullmsg="请输入验证码" errormsg="输入的验证码不正确"/><img name="codeimg" src="<?php echo U('verify');?>" class="codeimg" style="display:inline-block;margin-left:14px;width: 100px;height: 45px;" title="看不清，换一张" onclick="reloadImage(this);"/>
        </li>
        <li class="login_end"><a style="background:url(/qupaifang/Public/login/images/login_19.jpg) no-repeat center top;" class="btn_login" href="javascript:;" onclick="submit_form()">登  录</a><!--<input class="login_button" type="submit" name="submit" value=""> huanpic--><span id="msg"></span></li>
    </ul>
    </form>
	</div>
</div>
<div class="container">
	<section id="page-1" class="section content_current" style="background-image: url(/qupaifang/Public/login/images/banner-bg.jpg);">
    <div id="banner-rotate" class="banner-rotate">
        <div class="banner-img">
            <div class="item rotate1"></div>
            <div class="item rotate2"></div>
            <div class="item rotate3"></div>
            <div class="item rotate4"></div>
        </div>
        <div id="move"></div>
        <div class="center-txt txtLong"></div>
    </div>
	</section>
</div>
<script type="text/javascript">
function submit_form(){
    $('#form').submit();
}
if (self != top) {
    top.location = self.location;
}

function reloadImage(obj) {
    var src = "<?php echo U('verify');?>&temp=" + Math.floor(Math.random() * 100);
    $(obj).attr('src', src).fadeIn();
}
$(function() {
    $.Tipmsg.r = '';
    $("#form").Validform({
        tiptype: function(msg, o, cssctl, result) {
            if (!o.obj.is("form") && msg) {
                layer.msg(msg, {icon:5, offset:280, shift:6});
            }
        },
        callback: function(result) {
            if (result.status == 1) {
                var _btn = $('.btn_login');
                _btn.text('验证通过 登录中.');
                setTimeout(function(){
                    _btn.text('验证通过 登录中..');
                },1000);
                setTimeout(function(){
                    _btn.text('验证通过 登录中...');
                },2000);
                setTimeout(function(){
                    window.location.href = "<?php echo U('index/index');?>";
                }, 3000);
                //	layer.msg(result.msg, {
                //icon: 6,
                //offset: 280
                //	}, function() {
                //window.location.href = "<?php echo U('index/index');?>";
                //	});
            } else {
                reloadImage('.codeimg');
                $('.code').val('').focus();
                layer.msg(result.msg, {icon:5, offset:280, shift:6});
            }
        },
        ajaxPost: true,
        tipSweep: true
    });
})
</script>
</body>
</html>